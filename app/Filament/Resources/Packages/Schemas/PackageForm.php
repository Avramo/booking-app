<?php

namespace App\Filament\Resources\Packages\Schemas;

use App\Enums\ServiceCategory;
use App\Models\Service;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Package')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required(),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('concierge_fee')
                            ->label('Concierge fee ($)')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        Toggle::make('is_active'),
                    ])
                    ->columns(2),

                Section::make('Services')
                    ->schema([
                        Select::make('services')
                            ->label('Included services')
                            ->multiple()
                            ->relationship('services', 'name')
                            ->options(
                                Service::where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->get()
                                    ->mapWithKeys(fn ($s) => [
                                        $s->id => $s->category->label() . ' — ' . $s->name . ($s->tier ? ' (' . $s->tier . ')' : ''),
                                    ])
                            )
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
