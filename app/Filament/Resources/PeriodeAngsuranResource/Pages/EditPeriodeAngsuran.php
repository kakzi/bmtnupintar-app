<?php

namespace App\Filament\Resources\PeriodeAngsuranResource\Pages;

use App\Filament\Resources\PeriodeAngsuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeriodeAngsuran extends EditRecord
{
    protected static string $resource = PeriodeAngsuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
