<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\TreatmentPlan;
use App\Models\School;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $psychologist = User::factory()
             ->role(Role::Psychologist)
             ->create([
                 'name' => 'Test User',
                 'email' => 'user@example.com',
             ]);

         $parent = User::factory()
             ->role(Role::Parent)
             ->create();

         for ($i = 0; $i < 10; $i++) {
             $patient = User::factory()
                 ->role(Role::Patient)
                 ->create();


             $treatmentPlan = TreatmentPlan::factory()->create([
                 'patient_id' => $patient->id,
                 'psychologist_id' => $psychologist->id,
                 'parent_id' => $parent->id,
             ]);

             $school = School::factory()
                 ->create(['patient_id' => $patient->id]);

             $questionnaires = Questionnaire::factory(3)
                 ->has(Question::factory(5))
                 ->create();
             $treatmentPlan->questionnaires()->saveMany($questionnaires);
         }
    }
}
