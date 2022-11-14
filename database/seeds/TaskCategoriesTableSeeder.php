<?php

use Illuminate\Database\Seeder;

class TaskCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('task_categories')->insert([
            [
                'category_name'=>'仕事'
            ],
            [
                'category_name'=>'学校'
            ],
            [
                'category_name'=>'家事'
            ],
            [
                'category_name'=>'買い物'
            ],
            [
                'category_name'=>'その他'
            ],
        ]);
    }
}
