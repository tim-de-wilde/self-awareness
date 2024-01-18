<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionAsset;
use App\Models\Questionnaire;
use Database\Factories\QuestionAssetFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class QuestionnaireSeeder extends Seeder
{
    private const ROOT_ASSET_DIR = 'images/mascots/panda';

    private function getQuestions(): array
    {
       $happyAssets = $this->getHappyAssets();
       $angryAssets = $this->getAngryAssets();
       $sadAssets = $this->getSadAssets();
       $scaredAssets = $this->getScaredAssets();

       return [
           [
               ['Hoe voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe je je voelt vandaag.', $happyAssets],
               ['Hoe boos voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe boos je je voelt vandaag.', $angryAssets],
               ['Hoe bang voel je je vandaag?  ','Geef aan op een schaal van 1 tot 10 hoe bang je je voelt vandaag.', $scaredAssets],
               ['Hoe verdrietig voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe verdrietig je je voelt vandaag.', $sadAssets],
               ['Hoe gespannen voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe gespannen je je voelt vandaag.', $angryAssets],
               ['Hoe paniekerig voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe paniekerig je je voelt vandaag.', $scaredAssets],
               ['Hoe geïrriteerd voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe geirriteerd je je voelt vandaag.', $angryAssets],
               ['Hoe blij voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe blij je je voelt vandaag. ', $happyAssets],
               ['Hoe nieuwschierig voel je je vandaag?', 'Geef aan op een schaal van 1 tot 10 hoe nieuwschierig je je voelt vandaag.', $happyAssets],
               ['Hoe trots voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe verrast je je voelt vandaag.', $happyAssets],
               ['Hoe gelukkig voel je je vandaag?','Geef aan op een schaal van 1 tot 10 hoe gelukkig je je voelt vandaag.', $happyAssets]
           ],
        ];
    }

    private function getQuestionnaires(): array
    {
        return [
            ['Gevoel', 'Een questionnaire over gevoel.']
        ];
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $questions = $this->getQuestions();

        foreach ($this->getQuestionnaires() as $key => $questionnaireData) {
            $questionnaire = Questionnaire::factory()
                ->create([
                    'name' => $questionnaireData[0],
                    'description' => $questionnaireData[1],
                    'user_id' => 1,
                ]);

            foreach ($questions[$key] as $questionData) {
                /** @var Question $question */
                $question = $questionnaire->questions()->save(
                    Question::factory()
                        ->create([
                            'title' => $questionData[0],
                            'description' => $questionData[1],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ])
                );

                /**
                 * @var int $key
                 * @var QuestionAsset $record
                 */
                foreach ($questionData[2] as $key => $record) {
                    $question->assets()->save($record, ['order' => $key]);
                }
            }
        }
    }

    private function getAngryAssets(): array
    {
        return $this->getAssets('angry');
    }

    private function getHappyAssets(): array
    {
        return $this->getAssets('happy');
    }

    private function getSadAssets(): array
    {
        return $this->getAssets('sad');
    }

    private function getScaredAssets(): array
    {
        return $this->getAssets('scared');
    }

    /**
     * @return QuestionAsset[]
     */
    private function getAssets(string $subDir): array
    {
        return Arr::map(range(0, 4), fn (int $i) => QuestionAsset::factory()
            ->create([
                'location' => sprintf('%s/%s/%s.png', self::ROOT_ASSET_DIR, $subDir, $i)
            ])
        );
    }
}
