<?php

namespace Wallo\FilamentCompanies\Pages\User;

use Exception;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Wallo\FilamentCompanies\FilamentCompanies;

class PersonalAccessTokens extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    /**
     * The plain text token value.
     */
    public ?string $plainTextToken;

    /**
     * Indicates if the plain text token is being displayed to the user.
     */
    public bool $displayingToken = false;

    protected static string $view = 'filament-companies::filament.pages.user.personal-access-tokens';

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.tokens');
    }

    public static function getSlug(): string
    {
        return 'personal-access-tokens';
    }

    protected function getTableQuery(): Builder
    {
        $auth = Filament::auth();

        return PersonalAccessToken::whereTokenableId($auth->user()?->getAuthIdentifier())
            ->whereTokenableType(FilamentCompanies::userModel());
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns($this->getTableColumns())
            ->defaultSort('id', 'desc')
            ->heading(__('filament-companies::default.grid_section_titles.create_token'))
            ->description(__('filament-companies::default.grid_section_descriptions.create_token'))
            ->actions($this->getTableActions())
            ->headerActions($this->getTableHeaderActions())
            ->bulkActions($this->getTableBulkActions());
    }

    protected function getTableColumns(): array
    {
        return [
            Split::make([
                TextColumn::make('name')
                    ->label(__('filament-companies::default.labels.token_name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('abilities')
                    ->badge()
                    ->label(__('filament-companies::default.labels.permissions')),
            ]),
            Panel::make([
                Stack::make([
                    TextColumn::make('created_at')
                        ->label(__('filament-companies::default.labels.created_at'))
                        ->icon('heroicon-o-calendar-days')
                        ->formatStateUsing(static function ($state) {
                            return new HtmlString(
                                '<div>'
                                . __('filament-companies::default.descriptions.token_created_state', [
                                    'time_ago' => '<span class="font-bold text-sm text-primary-600 dark:text-primary-400">' . __($state->diffForHumans()) . '</span>',
                                    'user_name' => '<a target="_blank" href="' . url(Profile::getUrl()) . '" class="font-bold text-sm text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300" style="text-decoration: underline;">' . __(Auth::user()?->name) . '</a>',
                                ]) .
                                '</div>'
                            );
                        })
                        ->fontFamily('serif')
                        ->sortable(),
                    TextColumn::make('updated_at')
                        ->label(__('filament-companies::default.labels.updated_at'))
                        ->icon('heroicon-o-clock')
                        ->formatStateUsing(static function ($state) {
                            return __('filament-companies::default.descriptions.token_updated_state', ['time_ago' => $state->diffForHumans()]);
                        })
                        ->fontFamily('serif')
                        ->sortable(),
                    TextColumn::make('last_used_at')
                        ->label(__('filament-companies::default.labels.last_used_at'))
                        ->formatStateUsing(static function ($state) {
                            if ($state) {
                                return __('filament-companies::default.descriptions.token_last_used_state', ['time_ago' => $state->diffForHumans()]);
                            }

                            return __('filament-companies::default.descriptions.token_never_used');
                        })
                        ->fontFamily('serif')
                        ->sortable(),
                ]),
            ])->collapsible(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableHeaderActions(): array
    {
        $permissions = FilamentCompanies::$permissions;
        $defaultPermissions = FilamentCompanies::$defaultPermissions;

        return [
            Tables\Actions\Action::make('create')
                ->label(__('filament-companies::default.buttons.create_token'))
                ->modalWidth(FilamentCompanies::getModals()['width'])
                ->action(function (array $data) use ($permissions) {
                    $name = $data['name'];
                    $abilities = array_values($data['abilities']);
                    $selected = array_intersect_key($permissions, array_flip($abilities));
                    $this->displayTokenValue(Auth::user()?->createToken($name, FilamentCompanies::validPermissions($selected)));
                    $this->tokenCreatedNotification($name);
                })
                ->mountUsing(static function (Form $form) use ($permissions) {
                    $selected = array_intersect($permissions, FilamentCompanies::$defaultPermissions);
                    $form->fill([
                        'abilities' => array_keys($selected),
                    ]);
                })
                ->form([
                    TextInput::make('name')
                        ->label(__('filament-companies::default.labels.token_name'))
                        ->required(),
                    CheckboxList::make('abilities')
                        ->label(__('filament-companies::default.labels.permissions'))
                        ->required()
                        ->options($permissions)
                        ->columns()
                        ->default($defaultPermissions),
                ]),
        ];
    }

    protected function displayTokenValue($token): void
    {
        $this->dispatch('open-modal', id: 'displayingToken');
        $this->plainTextToken = explode('|', $token->plainTextToken, 2)[1];
        $this->dispatch('showing-token-modal');
    }

    /**
     * Cancel displaying the token value to the user.
     */
    public function cancelDisplayingToken(): void
    {
        $this->dispatch('close-modal', id: 'displayingToken');
    }

    protected function tokenCreatedNotification($name): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.token_created.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-companies::default.notifications.token_created.body', compact('name'))))
            ->send();
    }

    /**
     * @throws Exception
     */
    protected function getTableActions(): array
    {
        $permissions = FilamentCompanies::$permissions;

        return [
            Tables\Actions\Action::make('edit')
                ->label(__('filament-companies::default.buttons.edit'))
                ->icon('heroicon-o-pencil')
                ->modalWidth(FilamentCompanies::getModals()['width'])
                ->mountUsing(static function ($form, $record) use ($permissions) {
                    $selected = array_intersect($permissions, $record->abilities);

                    $form->fill([
                        'name' => $record->name,
                        'abilities' => array_keys($selected),
                    ]);
                })
                ->action(function ($record, array $data) use ($permissions) {
                    $name = $data['name'];
                    $abilities = array_values($data['abilities']);
                    $selected = array_intersect_key($permissions, array_flip($abilities));
                    $record->update([
                        'name' => $name,
                        'abilities' => $selected,
                    ]);
                    $this->tokenUpdated();
                })
                ->form([
                    TextInput::make('name')
                        ->label(__('filament-companies::default.labels.token_name'))
                        ->required(),
                    CheckboxList::make('abilities')
                        ->label(__('filament-companies::default.labels.permissions'))
                        ->required()
                        ->options($permissions)
                        ->columns(),
                ]),
        ];
    }

    /**
     * Send the token updated notification to the user.
     */
    protected function tokenUpdated(): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.token_updated.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.token_updated.body'))
            ->send();
    }

    /**
     * Require the user to enter their password before revoking the token(s).
     *
     * @throws Exception
     */
    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('revoke')
                ->label(__('filament-companies::default.buttons.revoke'))
                ->action(static function (Collection $records): void {
                    $records->each(static fn ($record) => $record->delete());
                })
                ->requiresConfirmation()
                ->modalWidth(FilamentCompanies::getModals()['width'])
                ->modalHeading(__('filament-companies::default.modal_titles.revoke_tokens'))
                ->modalDescription(__('filament-companies::default.modal_descriptions.revoke_tokens'))
                ->modalSubmitActionLabel(__('filament-companies::default.buttons.revoke'))
                ->deselectRecordsAfterCompletion()
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->form([
                    TextInput::make('password')
                        ->hiddenLabel()
                        ->password()
                        ->placeholder(__('filament-companies::default.fields.password'))
                        ->currentPassword()
                        ->required(),
                ]),
        ];
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }
}
