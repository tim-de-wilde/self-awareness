<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TreatmentPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questionnaires(): BelongsToMany
    {
        return $this->belongsToMany(Questionnaire::class);
    }
}
