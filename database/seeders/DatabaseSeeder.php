<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Role;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\TreatmentPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

             TreatmentPlan::create([
                 'patient_id' => $patient->id,
                 'psychologist_id' => $psychologist->id,
                 'parent_id' => $parent->id,
             ]);
         }

         Questionnaire::factory(5)
             ->has(Question::factory(5))
             ->create(['user_id' => $psychologist->id]);
    }
}
