<?php

namespace App\Modules\Knowledgebase\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class KnowledgeBaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('db:seed', ['--class' => CategoriesTableSeeder::class, '--no-interaction' => true]);
        Artisan::call('db:seed', ['--class' => TagsTableSeeder::class, '--no-interaction' => true]);
        Artisan::call('db:seed', ['--class' => ArticlesTableSeeder::class, '--no-interaction' => true]);
    }
}
