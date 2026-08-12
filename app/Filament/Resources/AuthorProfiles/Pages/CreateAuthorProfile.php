<?php

namespace App\Filament\Resources\AuthorProfiles\Pages;

use App\Filament\Resources\AuthorProfiles\AuthorProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuthorProfile extends CreateRecord
{
    protected static string $resource = AuthorProfileResource::class;
}
