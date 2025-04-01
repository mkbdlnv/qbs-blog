<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationLabel(): string
    {
        return __('admin.users');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.users');
    }

    public static function getModelLabel(): string
    {
        return __('admin.user');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label(__('admin.user.name'))
                ->required()
                ->maxLength(255),

            TextInput::make(__('admin.user.email'))
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true), // Уникальный email при редактировании

            TextInput::make('password')
                ->label(__('admin.user.password'))
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => !empty($state) ? bcrypt($state) : null) // Hash only if provided
                ->nullable()
                ->dehydrated(fn ($state) => !empty($state)) // Only update if a new password is provided
                ->required(fn ($record) => $record === null), // Required only for new records



            Select::make('role')
                ->label(__('admin.user.role'))
                ->options([
                    'admin' => 'Admin',
                    'user' => 'Reader',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('name')->label(__('admin.user.name'))->sortable()->searchable(),
            TextColumn::make('email')->label(__('admin.user.email'))->sortable()->searchable(),
            TextColumn::make('role')->label(__('admin.user.role'))->sortable()->searchable(), // Добавлено
            TextColumn::make('created_at')
                ->label(__('admin.user.registered'))
                ->dateTime('d.m.Y H:i'),
        ])
            ->filters([
                Filter::make('created_at')
                    ->label('Дата регистрации')
                    ->form([
                        DateTimePicker::make('created_from')->label('С'),
                        DateTimePicker::make('created_until')->label('До'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['created_from'] ?? null, fn($q) => $q->where('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'] ?? null, fn($q) => $q->where('created_at', '<=', $data['created_until']));
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
