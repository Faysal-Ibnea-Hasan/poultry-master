<?php

namespace App\Enum;

enum ExpenseType: string
{
    case FOOD = 'food';
    case MEDICINE = 'medicine';
    case TRANSPORT = 'transport';
    case LABOUR = 'labour';
    case LITTER = 'litter';
    case ELECTRICITY = 'electricity';
    case COST_PER_CHICK = 'cost_per_chick';
    case OTHER = 'other';

    // Get all expense types as an array
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    // Get human-readable labels
    public static function labels(): array
    {
        return [
            self::FOOD->value => 'Food',
            self::MEDICINE->value => 'Medicine',
            self::TRANSPORT->value => 'Transport',
            self::LABOUR->value => 'Labour',
            self::LITTER->value => 'Litter',
            self::ELECTRICITY->value => 'Electricity',
            self::COST_PER_CHICK->value => 'Cost Per Chick',
            self::OTHER->value => 'Other',
        ];
    }
}
