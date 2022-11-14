<?php

use Illuminate\Database\Seeder;

class QuestionCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('question_categories')->insert([
            [
                'category_name'=>'英語'
            ],
            [
                'category_name'=>'プログラミング'
            ],
            [
                'category_name'=>'研究'
            ],
        ]);
    }
}
