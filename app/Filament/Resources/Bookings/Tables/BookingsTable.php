<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('package.name')
                    ->label('Package')
                    ->sortable(),
                TextColumn::make('client1_name')
                    ->label('Client')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone_mobile1')
                    ->label('Phone'),
                TextColumn::make('start_date')
                    ->label('Arrival')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Return')
                    ->date()
                    ->sortable(),
                TextColumn::make('adults_count')
                    ->label('Adults'),
                TextColumn::make('children_count')
                    ->label('Children'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending_confirmation' => 'gray',
                        'initiated'            => 'warning',
                        'confirmed'            => 'success',
                        'in_progress'          => 'info',
                        'completed'            => 'success',
                        'cancelled'            => 'danger',
                        default                => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending_confirmation' => 'Pending confirmation',
                        'initiated'            => 'Initiated',
                        'confirmed'            => 'Confirmed',
                        'in_progress'          => 'In progress',
                        'completed'            => 'Completed',
                        'cancelled'            => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
