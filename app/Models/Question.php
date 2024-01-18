<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(QuestionAsset::class);
    }

    public function exportAssets(): array
    {
        return $this->assets()
            ->orderByPivot('order')
            ->get()
            ->map(fn (QuestionAsset $asset) => [
                'location' => asset($asset->location),
                'order' => $asset->order,
            ])
            ->toArray();
    }
}
