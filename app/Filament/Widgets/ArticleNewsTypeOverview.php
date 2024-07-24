<?php

namespace App\Filament\Widgets;

use App\Models\ArticleNews;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArticleNewsTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cats', ArticleNews::query()->count()),
            Stat::make('Dogs', ArticleNews::query()->count())
        ];
    }
}
