<?php

namespace App\Filament\Resources\AuthorProfiles\Pages;

use App\Filament\Resources\AuthorProfiles\AuthorProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuthorProfile extends EditRecord
{
    protected static string $resource = AuthorProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
