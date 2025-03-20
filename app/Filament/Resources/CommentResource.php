<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;


class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';

//    public static function form(Form $form): Form
//    {
//        return $form->schema([
//            Select::make('user_id')
//                ->label('Автор')
//                ->relationship('user', 'name')
//                ->searchable()
//                ->required(),
//
//            Select::make('post_id')
//                ->label('Пост')
//                ->relationship('post', 'title')
//                ->searchable()
//                ->required(),
//
//            TextInput::make('content')
//                ->label('Комментарий')
//                ->required()
//                ->maxLength(1000),
//
//            DateTimePicker::make('created_at')
//                ->label('Дата создания')
//                ->disabled()
//                ->default(now()),
//        ]);
//    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')
                    ->label('Автор')
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) => url("/admin/users/{$record->user_id}/edit"))
                    ->openUrlInNewTab(), // Opens in a new tab
                TextColumn::make('post.title')
                    ->label('Название поста')
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) => url("/admin/posts/{$record->post_id}/edit"))
                    ->openUrlInNewTab(), // Opens in a new tab
                TextColumn::make('content')->label('Комментарий')->limit(50)->searchable(),
                TextColumn::make('created_at')->label('Дата создания')->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Дата создания')
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
            'index' => Pages\ListComments::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
