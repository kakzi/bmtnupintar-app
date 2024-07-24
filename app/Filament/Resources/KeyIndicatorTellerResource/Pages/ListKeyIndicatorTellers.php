<?php

namespace App\Filament\Resources\KeyIndicatorTellerResource\Pages;

use App\Filament\Resources\KeyIndicatorTellerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeyIndicatorTellers extends ListRecords
{
    protected static string $resource = KeyIndicatorTellerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
