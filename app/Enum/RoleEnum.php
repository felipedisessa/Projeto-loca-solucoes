<?php

namespace App\Enum;

enum RoleEnum: string
{
    case admin    = 'admin';
    case landlord = 'landlord';
    case tenant   = 'tenant';
    case visitor  = 'visitor';

    public function label(): string
    {
        return match ($this) {
            self::admin    => 'Administrador',
            self::landlord => 'Proprietário',
            self::tenant   => 'Morador',
            self::visitor  => 'Visitante',
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
