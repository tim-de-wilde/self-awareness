<?php

namespace App\Enums;

enum Role: string
{
    case Patient = 'patient';
    case Psychologist = 'psychologist';
    case Parent = 'parent';

    public static function labels(): array
    {
        return [
            'patient' => __('Patient'),
            'psychologist' => __('Psychologist'),
            'parent' => __('Parent'),
        ];
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}
