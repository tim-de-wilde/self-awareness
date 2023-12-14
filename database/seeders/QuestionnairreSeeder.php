<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnairreSeeder extends Seeder
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
    }
}
