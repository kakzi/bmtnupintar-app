<?php

namespace App\Filament\Resources\JenisPembiayaanResource\Pages;

use App\Filament\Resources\JenisPembiayaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPembiayaans extends ListRecords
{
    protected static string $resource = JenisPembiayaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
