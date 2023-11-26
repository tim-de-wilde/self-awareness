<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\TreatmentPlan;
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

             TreatmentPlan::create([
                 'patient_id' => $patient->id,
                 'psychologist_id' => $psychologist->id,
                 'parent_id' => $parent->id,
             ]);
         }

    }
}
