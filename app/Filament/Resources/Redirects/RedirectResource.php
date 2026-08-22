<?php

namespace App\Filament\Resources\Redirects;

use App\Filament\Resources\Redirects\Pages\CreateRedirect;
use App\Filament\Resources\Redirects\Pages\EditRedirect;
use App\Filament\Resources\Redirects\Pages\ListRedirects;
use App\Models\Redirect;
use BackedEnum;
use Closure;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-uturn-right';

    protected static string|UnitEnum|null $navigationGroup = 'SEO';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'from_path';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('from_path')
                ->label('From path')
                ->placeholder('/old-post-slug')
                ->helperText('Relative path only, starting with /. Example: /old-review')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->rule('regex:/^\//')
                ->columnSpanFull(),

            Forms\Components\TextInput::make('to_url')
                ->label('To URL')
                ->placeholder('/new-post-slug or https://example.com/new-page')
                ->helperText('Use a relative path or full absolute URL.')
                ->required()
                ->maxLength(2048)
                ->columnSpanFull()
                ->rule(function (callable $get) {
                    return function (string $attribute, $value, Closure $fail) use ($get) {
                        if ($get('from_path') === $value) {
                            $fail('From path and To URL cannot be the same.');
                        }
                    };
                }),

            Forms\Components\Select::make('status_code')
                ->label('Status code')
                ->options([
                    301 => '301 Permanent Redirect',
                    302 => '302 Temporary Redirect',
                    307 => '307 Temporary Redirect',
                    308 => '308 Permanent Redirect',
                    410 => '410 Gone',
                ])
                ->default(301)
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),

            Forms\Components\Textarea::make('notes')
                ->rows(4)
                ->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('from_path')
                    ->label('From')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('to_url')
                    ->label('To')
                    ->searchable()
                    ->copyable()
                    ->wrap()
                    ->limit(60),

                Tables\Columns\TextColumn::make('status_code')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        301, 308 => 'success',
                        302, 307 => 'warning',
                        410 => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Active'),

                Tables\Filters\SelectFilter::make('status_code')
                    ->options([
                        301 => '301',
                        302 => '302',
                        307 => '307',
                        308 => '308',
                        410 => '410',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRedirects::route('/'),
            'create' => CreateRedirect::route('/create'),
            'edit' => EditRedirect::route('/{record}/edit'),
        ];
    }
}