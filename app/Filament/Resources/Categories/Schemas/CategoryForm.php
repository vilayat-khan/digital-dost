<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, callable $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Select::make('parent_id')
                    ->label('Parent Category')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('icon')
                    ->maxLength(255)
                    ->helperText('Optional icon class or name for menus'),

                TextInput::make('meta_title')
                    ->maxLength(255),

                Textarea::make('meta_description')
                    ->rows(2)
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}