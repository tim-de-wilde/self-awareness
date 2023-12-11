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

    private $questionnaire = [['Gevoel','Een questionnaire over gevoel.']];
    // title, description, asset location
    private $moodQuestionnaire = [
        ['Hoe voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe je je voelt vandaag.','asset_loc'],
        ['Hoe boos voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe boos je je voelt vandaag.','asstet_loc'],
        ['Hoe bang voel je je vandaag?  ','Geef aan op een schaal van 1 tot 10 hoe bang je je voelt vandaag.','asset_loc'],
        ['Hoe verdrietig voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe verdrietig je je voelt vandaag.', 'asset_loc'],
        ['Hoe gespannen voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe gespannen je je voelt vandaag.', 'asset_loc'],
        ['Hoe paniekerig voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe paniekerig je je voelt vandaag.','asset_loc'],
        ['Hoe geïrriteerd voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe geirriteerd je je voelt vandaag.','asset_loc'],
        ['Hoe blij voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe blij je je voelt vandaag. ', 'asset_loc'],
        ['Hoe nieuwschierig voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe nieuwschierig je je voelt vandaag.', 'asset_loc'],
        ['Hoe trots voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe verrast je je voelt vandaag.','asset_loc'],
        ['Hoe gelukkig voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe gelukkig je je voelt vandaag.','asset_loc']
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //////////////////////////////////

        foreach ($this->questionnaire as $element){
            DB::table('questionnaires')->insert([
                'name' => $element[0],
                'user_id'=>1,                                   //set to 1, everything is created by the default user
                'description'=> $element[1]
            ]);
        }
        $id=1;
        foreach ($this->moodQuestionnaire as $element){
            DB::table('questions')->insert(
                [
                    "id"=> $id,
                    'title'=>$element[0],
                    'description'=>$element[1],
                    'asset_location'=>$element[2],
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            DB::table('question_questionnaire')->insert([
                'questionnaire_id'=> 1,
                'question_id'=>$id
            ]);
            $id++;
        }


        /////////////////////////////

         $psychologist = User::factory()
             ->role(Role::Psychologist)
             ->create([
                 'name' => 'Test User',
                 'email' => 'user@example.com',
             ]);

         $parent = User::factory()
             ->role(Role::Parent)
             ->create();

         $client = User::factory()
             ->role(Role::Client)
             ->has(School::factory())
             ->create([
                 'email' => 'client@example.com'
             ]);

         $treatmentPlan = $client->clientTreatmentPlan()->save(
             TreatmentPlan::factory()->create([
                 'client_id' => $client->id,
                 'psychologist_id' => $psychologist->id,
                 'parent_id' => $parent->id,
             ])
         );

         $treatmentPlan->questionnaires()->saveMany(
             Questionnaire::factory(3)
                 ->has(Question::factory(5))
                 ->create()
         );

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


             //$treatmentPlan->questionnaires()->saveMany($questionnaires);

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
