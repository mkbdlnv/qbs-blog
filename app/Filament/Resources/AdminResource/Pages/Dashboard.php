<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use App\Filament\Resources\AdminResource\Widgets\PostsActivityChart;
use App\Filament\Resources\AdminResource\Widgets\UsersChart;


class Dashboard extends \Filament\Pages\Dashboard
{

    public function getHeaderWidgets(): array
    {
        return [
            UsersChart::class,
            PostsActivityChart::class,
        ];
    }
}
