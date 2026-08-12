<?php

namespace App\Filament\Resources\AuthorProfiles;

use App\Filament\Resources\AuthorProfiles\Pages\CreateAuthorProfile;
use App\Filament\Resources\AuthorProfiles\Pages\EditAuthorProfile;
use App\Filament\Resources\AuthorProfiles\Pages\ListAuthorProfiles;
use App\Filament\Resources\AuthorProfiles\Schemas\AuthorProfileForm;
use App\Filament\Resources\AuthorProfiles\Tables\AuthorProfilesTable;
use App\Models\AuthorProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AuthorProfileResource extends Resource
{
    protected static ?string $model = AuthorProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'display_name';

    public static function form(Schema $schema): Schema
    {
        return AuthorProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuthorProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuthorProfiles::route('/'),
            'create' => CreateAuthorProfile::route('/create'),
            'edit' => EditAuthorProfile::route('/{record}/edit'),
        ];
    }
}
