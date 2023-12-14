<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
     * All psychologist's clients
     *
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'treatment_plans',
            'psychologist_id',
            'client_id',
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

    public function clientTreatmentPlan(): HasOne
    {
        return $this->hasOne(TreatmentPlan::class, 'client_id');
    }
    public function school(): HasOne
    {
        return $this->hasOne(School::class, 'client_id');
    }

    public function parent(): HasManyThrough
    {
        return $this->hasManyThrough(
            TreatmentPlan::class,
            User::class,
            'id',
            'client_id'
        );
    }

    //TODO Actually implement this
    public function getParentId(): int
    {
        return 0;
    }
}
