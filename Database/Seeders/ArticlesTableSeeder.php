<?php

namespace App\Modules\Knowledgebase\Database\Seeders;

use App\Models\CompanyRole;
use Faker\Factory;
use Illuminate\Database\Seeder;

use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use App\Modules\Knowledgebase\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $categories = Category::pluck('id');
        $tags = Tag::pluck('id');
        //$roles = CompanyRole::query()->get()->pluck('id')->toArray();

        foreach(range(1,25) as $id)
        {
            $article = new Article;
            $article->title = $faker->sentence;
            $article->slug = SlugService::createSlug(Article::class, 'slug', $article->title);
            $article->short_text = $faker->paragraph;
            $article->full_text = $faker->paragraph(9);
            $article->views_count = rand(0, 1000);
            $article->category_id = $categories->random();
            $article->is_internal = 0;
            $article->save();

            //$article->roles()->sync(array_filter($roles));
            $article->tags()->sync($tags->random(rand(1, $tags->count())));
        }
    }
}
