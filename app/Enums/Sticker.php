<?php

namespace App\Enums;

enum Sticker: string
{
    case DINO = 'dino';
    case OTTER = 'otter';
    case PANDA = 'panda';
    case SHARK = 'shark';

    public function image(): string
    {
        return self::images()[$this->value];
    }

    public static function images(): array
    {
        return [
            'dino' => asset('images/stickers/dino.png'),
            'otter' => asset('images/stickers/otter.png'),
            'panda' => asset('images/stickers/panda.png'),
            'shark' => asset('images/stickers/shark.png'),
        ];
    }
}
