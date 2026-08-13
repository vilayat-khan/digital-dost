<?php

namespace App\Filament\Resources\AuthorProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AuthorProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Select::make('user_id')
                    ->label('User')
                    ->options(\App\Models\User::pluck('name', 'id')->toArray())
                    ->native(true)
                    ->searchable(false)
                    ->required(),

                TextInput::make('display_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('designation')
                    ->placeholder('e.g. Tech Editor, AI Specialist')
                    ->maxLength(255),

                FileUpload::make('avatar')
                    ->image()
                    ->disk('public')
                    ->directory('author-avatars')
                    ->visibility('public')
                    ->imageEditor()
                    ->avatar(),

                Textarea::make('bio')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('twitter_url')
                    ->url()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-link'),

                TextInput::make('linkedin_url')
                    ->url()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-link'),

                TextInput::make('instagram_url')
                    ->url()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-link'),

                TextInput::make('website_url')
                    ->url()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-link'),
            ]);
    }
}