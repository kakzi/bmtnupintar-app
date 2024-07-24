<?php

namespace App\Filament\Resources\JenisPembiayaanResource\Pages;

use App\Filament\Resources\JenisPembiayaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisPembiayaan extends EditRecord
{
    protected static string $resource = JenisPembiayaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
