<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => Role::class,
        'gender' => Gender::class,
        'birth_date' => 'date',
    ];

    /**
     * All psychologist's patients.
     *
     * @return BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'treatment_plans',
            'psychologist_id',
            'patient_id',
        );
    }

    /**
     * All questionnaires which are created by this user.
     *
     * @return HasMany
     */
    public function ownedQuestionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function patientTreatmentPlans(): BelongsTo
    {
        return $this->belongsTo(TreatmentPlan::class, 'patient_id');
    }
}
