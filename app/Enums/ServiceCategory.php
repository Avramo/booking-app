<?php

namespace App\Enums;

enum ServiceCategory: string
{
    case AirportTransfer   = 'airport_transfer';
    case Transportation    = 'transportation';
    case Accommodation     = 'accommodation';
    case ApartmentStocking = 'apartment_stocking';
    case Breakfast         = 'breakfast';
    case ShabbatFood       = 'shabbat_food';
    case Activities        = 'activities';
    case Events            = 'events';
    case Extras            = 'extras';

    public function label(): string
    {
        return match($this) {
            self::AirportTransfer   => 'Airport Transfer',
            self::Transportation    => 'Transportation',
            self::Accommodation     => 'Accommodation',
            self::ApartmentStocking => 'Apartment Stocking',
            self::Breakfast         => 'Breakfast',
            self::ShabbatFood       => 'Shabbat Food',
            self::Activities        => 'Activities',
            self::Events            => 'Events',
            self::Extras            => 'Extras',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn($case) => [$case->value => $case->label()]
        )->all();
    }
}
