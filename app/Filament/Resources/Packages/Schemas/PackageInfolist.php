<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PackageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('concierge_fee')
                    ->label('Concierge fee')
                    ->money('USD'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                RepeatableEntry::make('services')
                    ->label('Included Services')
                    ->schema([
                        TextEntry::make('name')->label('Service'),
                        TextEntry::make('category')
                            ->label('Category')
                            ->formatStateUsing(fn ($state) => $state->label()),
                        TextEntry::make('tier')->placeholder('—'),
                        TextEntry::make('price')->money('USD'),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
