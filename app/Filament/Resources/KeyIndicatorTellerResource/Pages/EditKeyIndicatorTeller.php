<?php

namespace App\Filament\Resources\KeyIndicatorTellerResource\Pages;

use App\Filament\Resources\KeyIndicatorTellerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKeyIndicatorTeller extends EditRecord
{
    protected static string $resource = KeyIndicatorTellerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
