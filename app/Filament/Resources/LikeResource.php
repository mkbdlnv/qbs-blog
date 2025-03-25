<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikeResource\Pages;
use App\Models\Like;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class LikeResource extends Resource
{
    protected static ?string $model = Like::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-up';

    protected static ?string $navigationLabel = 'Лайки';
    protected static ?string $pluralLabel = 'Лайки';
    protected static ?string $label = 'Лайк';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Пользователь')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('post_id')
                    ->label('Пост')
                    ->relationship('post', 'title')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Если админ — показываем все
        if ($user->isAdmin()) {
            return parent::getEloquentQuery();
        }

        // Иначе — только свои комментарии
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Пользователь')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('post.title')
                    ->label('Пост')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Дата лайка')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Фильтр по дате')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('С'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('По'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q) => $q->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'], fn ($q) => $q->whereDate('created_at', '<=', $data['created_until']));
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(10)
            ->actions([
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
            'index' => Pages\ListLikes::route('/'),
        ];
    }
}
