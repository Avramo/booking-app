<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Package;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking')
                    ->schema([
                        Select::make('package_id')
                            ->label('Package')
                            ->options(Package::pluck('name', 'id'))
                            ->required()
                            ->columnSpanFull(),
                        Select::make('status')
                            ->options([
                                'pending_confirmation' => 'Pending confirmation',
                                'initiated'            => 'Initiated',
                                'confirmed'            => 'Confirmed',
                                'in_progress'          => 'In progress',
                                'completed'            => 'Completed',
                                'cancelled'            => 'Cancelled',
                            ])
                            ->default('initiated')
                            ->required(),
                        Textarea::make('notes')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Customer')
                    ->schema([
                        TextInput::make('client1_name')->label('Client 1 name') ->required(),
                        TextInput::make('client2_name')->label('Client 2 name'),
                        TextInput::make('family_name')->label('Family name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('phone_mobile1')->label('Mobile 1')->required(),
                        TextInput::make('phone_mobile2')->label('Mobile 2'),
                    ])
                    ->columns(2),

                Section::make('Trip')
                    ->schema([
                        DatePicker::make('start_date')->label('Arrival')->required()
                            ->live()
                            ->minDate(now())
                            ->beforeOrEqual('end_date'),
                        DatePicker::make('end_date')->label('Return')->required()
                            ->live()
                            ->minDate(now())
                            ->afterOrEqual('start_date'),
                        TextInput::make('adults_count')->label('Adults')->numeric(),
                        TextInput::make('children_count')->label('Children')->numeric(),
                    ])
                    ->columns(2),

                Section::make('Preferences')
                    ->schema([
                        Select::make('language')
                            ->options([
                                'english_yiddish' => 'English & Yiddish',
                                'english_hebrew'  => 'English & Hebrew',
                                'english'         => 'English only',
                                'all'             => 'All languages',
                            ]),
                        Select::make('sector')
                            ->label('Community')
                            ->options([
                                'hasidic'        => 'Hasidic',
                                'litvish'        => 'Litvish',
                                'modern_american'=> 'Modern American',
                                'frummers'       => 'Frummers',
                            ]),
                        Select::make('kashrut')
                            ->options([
                                'all'      => 'All kosher',
                                'mehadrin' => 'Mehadrin only',
                            ]),
                        Select::make('trip_purpose')
                            ->label('Trip purpose')
                            ->options([
                                'trip'         => 'Vacation / Tourism',
                                'business'     => 'Business',
                                'family_event' => 'Family event',
                            ]),
                        Select::make('payment_method')
                            ->label('Payment method')
                            ->options([
                                'quickpay' => 'QuickPay',
                                'credit'   => 'Credit Card',
                                'cash'     => 'Cash',
                                'check'    => 'Check',
                                'transfer' => 'Bank Transfer',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
