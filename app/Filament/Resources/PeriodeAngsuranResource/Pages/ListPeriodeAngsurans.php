<?php

namespace App\Filament\Resources\PeriodeAngsuranResource\Pages;

use App\Filament\Resources\PeriodeAngsuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeriodeAngsurans extends ListRecords
{
    protected static string $resource = PeriodeAngsuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
