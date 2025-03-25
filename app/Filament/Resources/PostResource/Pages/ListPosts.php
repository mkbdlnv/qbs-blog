<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Tag;
use App\Services\OpenRouterService;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Str;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('generatePost')
                ->label('Сгенерировать пост')
                ->icon('heroicon-o-light-bulb')
                ->form([
                    Select::make('tags')
                        ->label('Выберите теги')
                        ->options(Tag::pluck('name', 'id')->toArray())
                        ->multiple()
                        ->required(),
                ])
                ->action(function (array $data) {
                    $selectedTags = Tag::whereIn('id', $data['tags'])->pluck('name')->toArray();

                    $postData = (new OpenRouterService())->generatePost($selectedTags);

                    $post = \App\Models\Post::create([
                        'title'   => $postData['title'],
                        'slug'    => Str::slug($postData['title']),
                        'content' => $postData['content'],
                    ]);

                    $post->tags()->attach($data['tags']);
                }),
        ];
    }
}
