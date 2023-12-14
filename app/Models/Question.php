<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPreviewImage(): string
    {
        return self::getDefaultPreviewImage();
    }

    public static function getDefaultPreviewImage(): string
    {
        return asset('images/question-preview-image.png');
    }
}
