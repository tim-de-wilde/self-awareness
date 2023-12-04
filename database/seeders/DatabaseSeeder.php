<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Answer;
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
             $client = User::factory()
                 ->role(Role::Client)
                 ->create();

             $treatmentPlan = TreatmentPlan::factory()->create([
                 'client_id' => $client->id,
                 'psychologist_id' => $psychologist->id,
                 'parent_id' => $parent->id,
             ]);

             $questionnaires = Questionnaire::factory(3)
                 ->has(Question::factory(5))
                 ->create();

             $treatmentPlan->questionnaires()->saveMany($questionnaires);

             foreach ($questionnaires[0]->questions()->get() as $question) {
                 Answer::factory()
                     ->create([
                         'user_id' => $client->id,
                         'questionnaire_id' => $questionnaires[0]->id,
                         'question_id' => $question->id,
                         'treatment_plan_id' => $treatmentPlan->id,
                     ]);
             }

             $school = School::factory()
                 ->create(['client_id' => $client->id]);
         }
    }
}
