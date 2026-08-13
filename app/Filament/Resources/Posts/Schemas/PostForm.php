<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Post')
                    ->columnSpanFull()
                    ->tabs([

                        Tab::make('Content')
                            ->schema([
                                TextInput::make('title')
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

                                Textarea::make('excerpt')
                                    ->rows(2)
                                    ->maxLength(500)
                                    ->columnSpanFull(),

                                RichEditor::make('body')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('post-attachments'),

                               FileUpload::make('featured_image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('post-images')
                                    ->visibility('public')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Organization')
                            ->schema([
                                Select::make('type')
                                    ->options([
                                        'article' => 'Article',
                                        'review' => 'Review',
                                        'news' => 'News',
                                        'buying_guide' => 'Buying Guide',
                                        'tutorial' => 'Tutorial',
                                        'comparison' => 'Comparison',
                                    ])
                                    ->required()
                                    ->default('article'),

                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'scheduled' => 'Scheduled',
                                    ])
                                    ->required()
                                    ->default('draft')
                                    ->live(),

                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('author_id')
                                    ->label('Author')
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),

                                DateTimePicker::make('published_at')
                                    ->visible(fn (callable $get) => $get('status') !== 'draft'),
                            ]),

                        Tab::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Textarea::make('meta_description')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpanFull(),

                                TextInput::make('canonical_url')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Select::make('schema_type')
                                    ->options([
                                        'Article' => 'Article',
                                        'Review' => 'Review',
                                        'NewsArticle' => 'News Article',
                                        'HowTo' => 'How-To',
                                        'FAQPage' => 'FAQ Page',
                                    ])
                                    ->default('Article'),
                            ]),
                    ]),
            ]);
    }
}