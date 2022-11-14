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
                'question_category_id'=>1,
            ],
            [   'question'=>"correct",
                'correct'=>"正解、現在の",
                'question_category_id'=>1,
            ],
            [   'question'=>"science",
                'correct'=>"理科、科学",
                'question_category_id'=>1,
            ],
            [   'question'=>"chemistory",
                'correct'=>"化学",
                'question_category_id'=>1,
            ],
            [   'question'=>"english",
                'correct'=>"英語",
                'question_category_id'=>1,
            ],
            [   'question'=>"geoglaphy",
                'correct'=>"地理",
                'question_category_id'=>1,
            ],
            [   'question'=>"mathmatics",
                'correct'=>"数学",
                'question_category_id'=>1,
            ],
            [   'question'=>"physiorogy",
                'correct'=>"物理",
                'question_category_id'=>1,
            ],
            [   'question'=>"pylosoqhy",
                'correct'=>"心理学",
                'question_category_id'=>1,
            ],
            [   'question'=>"pycology",
                'correct'=>"経済学",
                'question_category_id'=>1,
            ],
        ]);
    }
}
