<?php

namespace App\Filament\Resources\Potentials\Pages;

use App\Filament\Resources\Potentials\PotentialResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPotential extends EditRecord
{
    protected static string $resource = PotentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
