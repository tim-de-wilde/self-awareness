<?php

namespace App\Enums;

enum GraphType: string
{
    case Line = 'line';
    case Radar = 'radar';

    public function label(): string
    {
        return self::labels()[$this->value];
    }

    public static function labels(): array
    {
        return [
            'line' => __('Line'),
            'radar' => __('Radar'),
        ];
    }

    public static function values(): array
    {
        return array_map(fn (self $type) => $type->value, self::cases());
    }
}
