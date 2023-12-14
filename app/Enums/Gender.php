<?php

namespace App\Enums;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';

    public static function labels(): array
    {
        return [
            'male' => __('Male'),
            'female' => __('Female'),
            'other' => __('Other'),
        ];
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}
