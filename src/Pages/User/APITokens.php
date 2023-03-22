<?php

namespace Wallo\FilamentCompanies\Pages\User;

use App\Models\User;
use Exception;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Wallo\FilamentCompanies\FilamentCompanies;

class APITokens extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public User $user;

    /**
     * The plain text token value.
     */
    public string $plainTextToken;

    /**
     * The token name.
     */
    public string $name = '';

    /**
     * The token permissions.
     */
    public array $permissions = [];

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

    public function mount(): void
    {
        $this->permissions = FilamentCompanies::$defaultPermissions;
        $this->user = Auth::user();
        abort_unless(FilamentCompanies::hasApiFeatures(), 403);
    }

    protected function getTableQuery(): Builder
    {
        return app(Sanctum::$personalAccessTokenModel)->where([
            ['tokenable_id', '=', Auth::user()->id],
            ['tokenable_type', '=', FilamentCompanies::$userModel],
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
            Tables\Columns\TextColumn::make('name')
                ->label(__('filament-companies::default.labels.token_name'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TagsColumn::make('abilities')
                ->label(__('filament-companies::default.labels.permissions')),
            Tables\Columns\TextColumn::make('last_used_at')
                ->label(__('filament-companies::default.labels.last_used_at'))
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label(__('filament-companies::default.labels.created_at'))
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label(__('filament-companies::default.labels.updated_at'))
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Action::make('create')
                ->label(trans('Create Token'))
                ->modalWidth('2xl')
                ->action(function (array $data) {
                    $name = $data['name'];
                    $indexes = $data['abilities'];
                    $abilities = FilamentCompanies::$permissions;
                    $selected = collect($abilities)->filter(function ($item, $key) use (
                        $indexes
                    ) {
                        return in_array($key, $indexes);
                    })->toArray();
                    $this->displayTokenValue(Auth::user()?->createToken($name, FilamentCompanies::validPermissions(array_values($selected))));
                    $this->tokenCreatedNotification($name);
                    $this->reset(['name']);
                })
                ->form([
                    TextInput::make('name')
                        ->label(__('filament-companies::default.labels.token_name'))
                        ->required(),
                    CheckboxList::make('abilities')
                        ->label(__('filament-companies::default.labels.permissions'))
                        ->required()
                        ->options(FilamentCompanies::$permissions)
                        ->columns()
                        ->default(FilamentCompanies::$defaultPermissions)
                        ->afterStateHydrated(function ($component, $state) {
                            $abilities = FilamentCompanies::$permissions;
                            $selected = collect($abilities)->filter(function ($item) use ($state) {
                                return in_array($item, $state);
                            })
                                ->keys()
                                ->toArray();
                            $component->state($selected);
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
            ->body(__('filament-companies::default.notifications.api_token_created.body', ['name' => $name]))
            ->send();
    }

    /**
     * @throws Exception
     */
    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('edit')
                ->label(trans('Edit'))
                ->icon('heroicon-o-pencil-alt')
                ->modalWidth('2xl')
                ->mountUsing(
                    fn ($form, $record) => $form->fill($record->toArray())
                )
                ->action(function ($record, array $data) {
                    $name = $data['name'];
                    $indexes = $data['abilities'];
                    $abilities = FilamentCompanies::$permissions;
                    $selected = collect($abilities)->filter(function ($item, $key) use (
                        $indexes
                    ) {
                        return in_array($key, $indexes);
                    })->toArray();
                    $record->update([
                        'name' => $name,
                        'abilities' => array_values($selected),
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
                        ->options(FilamentCompanies::$permissions)
                        ->columns()
                        ->afterStateHydrated(function ($component, $state) {
                            $abilities = FilamentCompanies::$permissions;
                            $selected = collect($abilities)->filter(function ($item) use ($state) {
                                return in_array($item, $state);
                            })
                                ->keys()
                                ->toArray();
                            $component->state($selected);
                        }),
                ]),
        ];
    }

    protected function tokenUpdated(): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.api_token_updated.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.api_token_updated.body'))
            ->send();
    }

    /**
     * @throws Exception
     */
    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('revoke')
                ->label(trans('Revoke'))
                ->action(fn (Collection $records) => $records->each->delete())
                ->deselectRecordsAfterCompletion()
                ->requiresConfirmation()
                ->color('danger')
                ->icon('heroicon-o-trash'),
        ];
    }
}
