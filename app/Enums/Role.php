<?php

namespace App\Enums;

enum Role: string
{
    case Client = 'client';
    case Psychologist = 'psychologist';
    case Parent = 'parent';

    public static function labels(): array
    {
        return [
            'client' => __('Client'),
            'psychologist' => __('Psychologist'),
            'parent' => __('Parent'),
        ];
    }

    public static function landingPages(): array
    {
        return [
            'client' => 'client.dashboard',
            'psychologist' => 'psychologist.dashboard',
            'parent' => 'parent.dashboard',
        ];
    }

    public function landingPage(): string
    {
        return self::landingPages()[$this->value];
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}
