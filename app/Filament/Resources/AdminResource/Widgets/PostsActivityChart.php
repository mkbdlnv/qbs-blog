<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostsActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Активность по постам';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        // Загружаем посты с лайками и комментариями
        $posts = Post::withCount(['likes', 'comments'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $grouped = $posts->groupBy(fn($post) => $post->created_at->format('Y-m-d'));

        $dates = collect();
        $postCounts = collect();
        $likeCounts = collect();
        $commentCounts = collect();

        foreach (range(0, 6) as $i) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates->prepend($date);

            $dailyPosts = $grouped[$date] ?? collect();

            $postCounts->prepend($dailyPosts->count());
            $likeCounts->prepend($dailyPosts->sum('likes_count'));
            $commentCounts->prepend($dailyPosts->sum('comments_count'));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Посты',
                    'data' => $postCounts,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'tension' => 0.4,
                    'pointRadius' => 4,
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Лайки',
                    'data' => $likeCounts,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'tension' => 0.4,
                    'pointRadius' => 4,
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Комментарии',
                    'data' => $commentCounts,
                    'borderColor' => '#f97316',
                    'backgroundColor' => 'rgba(249, 115, 22, 0.2)',
                    'tension' => 0.4,
                    'pointRadius' => 4,
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $dates->map(fn ($d) => \Carbon\Carbon::parse($d)->format('d.m')),
        ];
    }


    protected function getType(): string
    {
        return 'line'; // можно заменить на bar
    }

    protected function getOptions(): ?array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                        'color' => '#6b7280',
                    ],
                ],
                'x' => [
                    'ticks' => [
                        'color' => '#6b7280',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'color' => '#111827',
                        'font' => [
                            'size' => 14,
                        ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'backgroundColor' => '#1f2937',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#e5e7eb',
                ],
            ],
        ];
    }
}
