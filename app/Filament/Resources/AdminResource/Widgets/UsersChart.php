<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UsersChart extends ChartWidget
{
    protected static ?string $heading = 'Новые пользователи';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $users = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Пользователи',
                    'data' => $users->pluck('count'),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#1e40af',
                    'pointRadius' => 4,
                    'fill' => true,
                ],
            ],
            'labels' => $users->pluck('date')->map(fn ($date) => date('d.m', strtotime($date))),
        ];
    }

    protected function getType(): string
    {
        return 'line';
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
