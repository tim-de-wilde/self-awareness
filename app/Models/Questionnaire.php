<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }

    public function treatmentPlans(): BelongsToMany
    {
        return $this->belongsToMany(TreatmentPlan::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function isCompletedForUser(User $user, TreatmentPlan $treatmentPlan): bool
    {
        $latestAnswer = Answer::query()
            ->whereQuestionnaireId($this->id)
            ->whereTreatmentPlanId($treatmentPlan->id)
            ->whereUserId($user->id)
            ->latest()
            ->first();

        return ($latestAnswer instanceof Answer) && ($latestAnswer->created_at->isToday());
    }
}
