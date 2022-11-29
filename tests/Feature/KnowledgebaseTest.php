<?php

namespace App\Modules\Knowledgebase\tests\Feature;



use App\Models\Company;
use App\Models\CompanyRole;
use App\Models\User;
use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use App\Modules\Knowledgebase\Models\Tag;
use App\Modules\Knowledgebase\tests\TestCase;
use Livewire\Livewire;

/**
 * @group kb
 *
 * Class KnowledgebaseTest
 * @package App\Modules\Knowledgebase\tests\Feature
 */
class KnowledgebaseTest extends TestCase
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
        $this->actingAs($this->admin)
            ->get(route_lang('kbp.kb'))
            ->assertSuccessful()
            ->assertSee(Article::all()->last()->title);
    }

    public function test_admin_can_edit_articles()
    {
        $this->actingAs($this->admin)
            ->withoutExceptionHandling()
            ->get(route_lang('kb.articles.edit',1 ))
            ->assertSuccessful()
            ->assertSee(Article::find(1)->title);

        $article = Article::orderBy('views_count', 'desc')->get()->first();

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::articles-edit',['article'=>$article])
            ->set('article.short_text','modified article')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route_lang('kb.articles.table'))
        ;
        $article->refresh();

        $this->assertEquals($article->short_text, 'modified article');
    }

    public function test_admin_can_add_article()
    {
        $this->be($this->admin);

        $category  = Category::all()->first();
        $roles = CompanyRole::query()->get()->pluck('id')->toArray();

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::articles-edit')
            ->set('article.title', 'Titolo nuovo articolo')
            //->set('article.slug' , 'titolo-nuovo-articolo')
            ->set('article.short_text'   , 'short text nuovo articolo')
            ->set('article.full_text'    , 'full text nuovo articolo')
            ->set('article.category_id'  , $category->id)
            ->set('roles'                , $roles)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route_lang('kb.articles.table'))
        ;

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::articles-table')
            ->set('search','Titolo nuovo articolo')
            ->assertSee('tot.1')
        ;
    }


    public function test_admin_can_edit_tags()
    {
        $tag = Tag::all()->first();

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::tags-edit',['tag'=>$tag])
            ->set('tag.name','modified tag')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route_lang('kb.tags.table'))
        ;
        $tag->refresh();

        $this->assertEquals($tag->name, 'modified tag');

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::tags-table')
            ->set('search','modified')
            ->assertSee('modified tag')
        ;
    }

    public function test_admin_can_edit_categories()
    {
        $category = Category::all()->first();

        $roles = CompanyRole::query()->get()->pluck('id')->toArray();

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::categories-edit',['category'=>$category])
            ->set('category.name','modified category')
            ->set('roles', $roles)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route_lang('kb.categories.table'))
        ;
        $category->refresh();

        $this->assertEquals($category->name, 'modified category');

        Livewire::actingAs($this->admin)
            ->test('knowledgebase::categories-table')
            ->set('search','modified')
            ->assertSee('modified category')
        ;
    }

}
