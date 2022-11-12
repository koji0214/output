<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questions')->insert([
            [   'question'=>"question",
                'correct'=>"問題",
            ],
            [   'question'=>"correct",
                'correct'=>"正解、現在の",
            ],
            [   'question'=>"science",
                'correct'=>"理科、科学",
            ],
            [   'question'=>"chemistory",
                'correct'=>"化学",
            ],
            [   'question'=>"english",
                'correct'=>"英語",
            ],
            [   'question'=>"geoglaphy",
                'correct'=>"地理",
            ],
            [   'question'=>"mathmatics",
                'correct'=>"数学",
            ],
            [   'question'=>"physiorogy",
                'correct'=>"物理",
            ],
            [   'question'=>"pylosoqhy",
                'correct'=>"心理学",
            ],
            [   'question'=>"pycology",
                'correct'=>"経済学",
            ],
        ]);
    }
}
