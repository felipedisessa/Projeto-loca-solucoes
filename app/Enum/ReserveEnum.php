<?php

namespace App\Enum;

enum ReserveEnum: string
{
    case pending   = 'pending';
    case confirmed = 'confirmed';
    case canceled  = 'canceled';

    public function label(): string
    {
        return match ($this) {
            self::pending   => 'Pendente',
            self::confirmed => 'Confirmada',
            self::canceled  => 'Cancelada',
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
