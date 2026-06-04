<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Enums\ServiceCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) =>
                                $set('slug', str($state)->slug())
                            ),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('category')
                            ->options(ServiceCategory::options())
                            ->required(),
                        TextInput::make('tier')
                            ->placeholder('e.g. fattal, regular, economy')
                            ->nullable(),
                        TextInput::make('price')
                            ->numeric()
                            ->prefix('$')
                            ->required(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->default(true),
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }
}
