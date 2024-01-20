<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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

    public function getAnswerQuery(
        TreatmentPlan $treatmentPlan,
        Role $submittedBy,
    ): HasMany {
        return $this->answers()
            ->where('treatment_plan_id', $treatmentPlan->id)
            ->whereHas('user', fn (Builder $q) => $q->where('role', $submittedBy));
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
