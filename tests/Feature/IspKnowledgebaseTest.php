<?php

namespace App\Modules\Knowledgebase\tests\Feature;


use App\Models\Company;
use App\Models\User;
use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\tests\TestCase;

/**
 * @group kb
 *
 * Class IspKnowledgebaseTest
 * @package App\Modules\Knowledgebase\tests\Feature
 */
class IspKnowledgebaseTest extends TestCase
{
    protected Company $company_isp;
    protected User $admin;
    protected User $isp;

    protected function setUp(): void
    {
        parent::setUp();

        $this->company_isp = Company::find('22222222-2222-2222-2222-222222222222');
        $this->isp = User::find('22222222-2222-0000-2222-222222222222');
        $this->admin = User::find('11111111-1111-0000-1111-111111111111');
    }

    public function test_admin_can_see_articles()
    {
        $this->actingAs($this->isp)
            ->get(route_lang('kbp.kb'))
            ->assertSuccessful()
            ->assertSee(Article::all()->last()->title);

    }

    public function test_can_see_article_detail()
    {
        $this->be($this->isp);

        $article = Article::orderBy('views_count', 'desc')->take(1)->get()->first();

        $link = route_lang('kbp.articles.show',['slug'=>$article->slug,'article'=>$article->id]);
        $url = parse_url($link, PHP_URL_PATH);

        $this->actingAs($this->isp)
            ->get(route_lang('kbp.kb'))
            ->assertSuccessful()
            ->assertSee($article->title)
        ;

        $this->actingAs($this->isp)
            ->get($url)
            ->assertSuccessful()
            ->assertSee($article->title)
        ;

    }

}
