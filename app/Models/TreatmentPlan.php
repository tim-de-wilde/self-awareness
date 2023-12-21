<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TreatmentPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questionnaires(): BelongsToMany
    {
        return $this->belongsToMany(Questionnaire::class);
    }
    public function answers(): HasMany
    {
        return $this->HasMany(Answer::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
