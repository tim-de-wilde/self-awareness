<?php

namespace App\Enums;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';

    public static function labels(): array
    {
        return [
            'male' => __('Male'),
            'female' => __('Female'),
        ];
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}
