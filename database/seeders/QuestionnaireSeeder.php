<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    private array $questionnaires = [
        ['Gevoel', 'Een questionnaire over gevoel.'],
    ];

    // title, description, asset location
    private array $questions = [
        [
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
        ]
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->questionnaires as $key => $questionnaireData) {
            $questionnaire = Questionnaire::factory()
                ->create([
                    'name' => $questionnaireData[0],
                    'description' => $questionnaireData[1],
                    'user_id' => 1,
                ]);

            foreach ($this->questions[$key] as $questionData) {
                $questionnaire->questions()->save(
                    Question::factory()
                        ->create([
                            'title' => $questionData[0],
                            'description' => $questionData[1],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ])
                );
            }
        }
    }
}
