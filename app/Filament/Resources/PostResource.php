<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\Tag;
use App\Services\OpenRouterService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('admin.posts');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.posts');
    }

    public static function getModelLabel(): string
    {
        return __('admin.post');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->label(__('admin.name.ru'))->required(),
            TextInput::make('title_en')->label(__('admin.name.en'))->required(),
            TextInput::make('slug')->label(__('admin.slug'))->unique(ignoreRecord: true)->columnSpanFull(),
            TinyEditor::make('content')->label(__('admin.content.ru'))->required(),
            TinyEditor::make('content_en')->label(__('admin.content.en'))->required(),
            Select::make('tags')
                ->label(__('admin.tags'))
                ->multiple()
                ->relationship('tags', 'name') // Подгружаем теги из БД
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->translated_name)

                ->preload(),
            FileUpload::make('image')
                ->label(__('admin.image'))
                ->image()
                ->directory('posts')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('admin.name.ru'))->sortable()->searchable(),
                TextColumn::make('title_en')->label(__('admin.name.en'))->sortable()->searchable(),
                TextColumn::make('slug')->label("Slug")->searchable()->sortable(),
                TextColumn::make('created_at')->label(__('admin.created.at'))->sortable()->searchable()->dateTime(),
                TextColumn::make('tags.translated_name')->label(__('admin.tags'))->badge()->separator(', '),
                ImageColumn::make('image'),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Дата публикации')
                    ->form([
                        DateTimePicker::make('created_from')->label('С'),
                        DateTimePicker::make('created_until')->label('До'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['created_from'] ?? null, fn($q) => $q->where('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'] ?? null, fn($q) => $q->where('created_at', '<=', $data['created_until']));
                    }),
                TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
        ];
    }
}
