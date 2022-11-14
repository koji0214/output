<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            QuestionCategoriesTableSeeder::class,
            TaskCategoriesTableSeeder::class,
            QuestionsTableSeeder::class,
            SleepsTableSeeder::class,
        ]);
    }
}
