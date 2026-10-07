<?php

namespace App\Filament\Resources\Potentials\Pages;

use App\Filament\Resources\Potentials\PotentialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPotentials extends ListRecords
{
    protected static string $resource = PotentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
