<?php

namespace Wallo\FilamentCompanies\Pages\User;

use Exception;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Laravel\Sanctum\Sanctum;
use Wallo\FilamentCompanies\FilamentCompanies;

class APITokens extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    /**
     * The plain text token value.
     */
    public string|null $plainTextToken;

    /**
     * Indicates if the plain text token is being displayed to the user.
     */
    public bool $displayingToken = false;

    protected static string $view = 'filament-companies::filament.pages.user.api-tokens';

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return __('filament-companies::default.grid_section_titles.create_api_token');
    }

    protected function getSubHeading(): string
    {
        return __('filament-companies::default.grid_section_descriptions.create_api_token');
    }

    public static function getSlug(): string
    {
        return 'user/api-tokens';
    }

    protected function getTableQuery(): Builder
    {
        return app(Sanctum::$personalAccessTokenModel)->where([
            ['tokenable_id', '=', Auth::user()?->getAuthIdentifier()],
            ['tokenable_type', '=', FilamentCompanies::userModel()],
        ]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'id';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableColumns(): array
    {
        return [
            Split::make([
                TextColumn::make('name')
                    ->label(__('filament-companies::default.labels.token_name'))
                    ->sortable()
                    ->searchable(),
                TagsColumn::make('abilities')
                    ->label(__('filament-companies::default.labels.permissions')),
            ]),
            Panel::make([
                Stack::make([
                    TextColumn::make('created_at')
                        ->label(__('filament-companies::default.labels.created_at'))
                        ->formatStateUsing(static function ($state) {
                            return new HtmlString(
                                '<div>'
                                . __('filament-companies::default.descriptions.token_created_state', [
                                    'time_ago' => '<span class="font-bold text-sm text-primary-600 dark:text-primary-400">' . __($state->diffForHumans()) . '</span>',
                                    'user_name' => '<a target="_blank" href="' . url(Profile::getUrl()) . '" class="font-bold text-sm text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300" style="text-decoration: underline;">' . __(Auth::user()?->name) . '</a>',
                                    ]) .
                                '</div>');
                        })
                        ->fontFamily('serif')
                        ->sortable(),
                    TextColumn::make('updated_at')
                        ->label(__('filament-companies::default.labels.updated_at'))
                        ->formatStateUsing(static function ($state) {
                            return __('filament-companies::default.descriptions.token_updated_state', ['time_ago' => $state->diffForHumans()]);
                        })
                        ->fontFamily('serif')
                        ->sortable(),
                    TextColumn::make('last_used_at')
                        ->label(__('filament-companies::default.labels.last_used_at'))
                        ->formatStateUsing(static function ($state) {
                            return $state ? __('filament-companies::default.descriptions.token_last_used_state', ['time_ago' => $state->diffForHumans()]) : __('filament-companies::default.descriptions.token_never_used');
                        })
                        ->fontFamily('serif')
                        ->sortable(),
                ])
            ])->collapsible(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        $permissions = FilamentCompanies::$permissions;
        $defaultPermissions = FilamentCompanies::$defaultPermissions;

        return [
            Action::make('create')
                ->label(__('filament-companies::default.buttons.create_token'))
                ->modalWidth(config('filament-companies.layout.modals.api_tokens.create_modal_width'))
                ->action(function (array $data) use ($permissions) {
                    $name = $data['name'];
                    $abilities = array_values($data['abilities']);
                    $selected = array_intersect_key($permissions, array_flip($abilities));
                    $this->displayTokenValue(Auth::user()?->createToken($name, FilamentCompanies::validPermissions($selected)));
                    $this->tokenCreatedNotification($name);
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
                        ->default($defaultPermissions)
                        ->afterStateHydrated(static function ($component, $state) use ($permissions) {
                            $selected = array_intersect($permissions, $state);
                            $component->state(array_keys($selected));
                        }),
                ]),
        ];
    }

    protected function displayTokenValue($token): void
    {
        $this->displayingToken = true;
        $this->plainTextToken = explode('|', $token->plainTextToken, 2)[1];
        $this->dispatchBrowserEvent('showing-token-modal');
    }

    protected function tokenCreatedNotification($name): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.api_token_created.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.api_token_created.body', compact('name')))
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
                ->icon('heroicon-o-pencil-alt')
                ->modalWidth(config('filament-companies.layout.modals.api_tokens.edit_modal_width'))
                ->mountUsing(static function ($form, $record) {
                    $form->fill($record->toArray());
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
                        ->columns()
                        ->afterStateHydrated(static function ($component, $state) use ($permissions) {
                            $selected = array_intersect($permissions, $state);
                            $component->state(array_keys($selected));
                        }),
                ]),
        ];
    }

    /**
     * Send the token updated notification to the user.
     */
    protected function tokenUpdated(): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.api_token_updated.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.api_token_updated.body'))
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
                ->modalWidth(config('filament-companies.layout.modals.api_tokens.revoke_modal_width'))
                ->modalHeading(__('filament-companies::default.modal_titles.revoke_api_tokens'))
                ->modalSubheading(__('filament-companies::default.modal_descriptions.revoke_api_tokens'))
                ->modalButton(__('filament-companies::default.buttons.revoke'))
                ->deselectRecordsAfterCompletion()
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->form([
                    TextInput::make('password')
                        ->disableLabel()
                        ->password()
                        ->placeholder(__('filament-companies::default.fields.password'))
                        ->currentPassword()
                        ->required(),
                ])
        ];
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): Authenticatable|null
    {
        return Auth::user();
    }
}
