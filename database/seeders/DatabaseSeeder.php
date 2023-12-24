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
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            QuestionnaireSeeder::class
        ]);

        $questionnaire = Questionnaire::query()->first();

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
             $email = sprintf('client%s@example.com', ($i === 0) ? '' : $i);
             $client = User::factory()
                 ->role(Role::Client)
                 ->has(School::factory())
                 ->create([
                     'email' => $email
                 ]);

             $treatmentPlan = TreatmentPlan::factory()->create([
                 'client_id' => $client->id,
                 'psychologist_id' => $psychologist->id,
                 'parent_id' => $parent->id,
             ]);

             $treatmentPlan->questionnaires()->save($questionnaire);

             $school = School::factory()
                 ->create(['client_id' => $client->id]);
         }
    }
}
