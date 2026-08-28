<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image'),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge(),

                TextColumn::make('author.display_name')
                    ->label('Author'),

                BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'article',
                        'success' => 'review',
                        'warning' => 'news',
                        'info' => 'buying_guide',
                        'purple' => 'tutorial',
                        'pink' => 'comparison',
                    ]),

                BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                        'warning' => 'scheduled',
                    ]),

                TextColumn::make('views_count')
                    ->label('Views')
                    ->sortable(),

                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                    ]),
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->visible(fn () => auth()->user()->isAdmin()),
            ])
            ->defaultSort('created_at', 'desc');
    }
}