<?php

namespace App\Filament\Resources\AuthorProfiles\Pages;

use App\Filament\Resources\AuthorProfiles\AuthorProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuthorProfiles extends ListRecords
{
    protected static string $resource = AuthorProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
