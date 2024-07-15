<?php

namespace App\Enum;

enum RentalItemEnum: string
{
    case maintenance = 'maintenance';
    case available   = 'available';
    case reserved    = 'reserved';

    public function label(): string
    {
        return match ($this) {
            self::maintenance => 'Manutenção',
            self::available   => 'Disponível',
            self::reserved    => 'Reservado',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->value, 'label' => $case->label()],
            self::cases()
        );
    }
}
