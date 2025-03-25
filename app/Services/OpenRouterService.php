<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    protected string $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENROUTER_API_KEY');
    }

    public function generatePost(array $tags): array
    {
        $prompt = "Создай заголовок и короткий пост (3-4 предложения) на тему: " . implode(', ', $tags) . ".

Ответ верни строго в следующем формате:
Заголовок: [твой заголовок]
Пост: [текст поста]

Пример:
Заголовок: Как сохранить мотивацию зимой
Пост: Зимой сложно держать привычный ритм, особенно когда за окном холод и темно. Найди тёплые поводы радоваться — чашка кофе, любимая музыка, прогулка на свежем воздухе. Важно сохранять движение и вдохновение даже в короткие дни.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => 'http://localhost',
                'X-Title' => 'MyBlogApp',
            ])->post($this->apiUrl, [
                'model' => 'openchat/openchat-7b:free',
                'messages' => [
                    ['role' => 'system', 'content' => 'Ты профессиональный копирайтер.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
                'max_tokens' => 200,
            ]);

            $data = $response->json();
            Log::info($data);

            $text = $data['choices'][0]['message']['content'] ?? '';

            // Парсинг
            $title = 'Без названия';
            $content = 'Без контента';

            if (preg_match('/Заголовок:\s*(.+)/ui', $text, $matchesTitle)) {
                $title = trim($matchesTitle[1]);
            }

            if (preg_match('/Пост:\s*(.+)/uis', $text, $matchesContent)) {
                $content = trim($matchesContent[1]);
            } else {
                $content = trim($text);
            }

            return [
                'title' => $title,
                'content' => $content,
            ];

        } catch (\Exception $e) {
            Log::error('OpenRouter Error: ' . $e->getMessage());

            return [
                'title' => 'Ошибка',
                'content' => 'Произошла ошибка при обращении к OpenRouter: ' . $e->getMessage(),
            ];
        }
    }
}
