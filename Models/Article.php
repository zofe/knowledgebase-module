<?php

namespace App\Modules\Knowledgebase\Models;

use App\Models\CompanyRole;
use App\Traits\SSearch;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_text
 * @property string|null $full_text
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $views_count
 * @property string $slug
 * @property int $is_internal
 * @property string|null $attachment
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Article findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Article isInternal($isInternal = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Query\Builder|Article onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFullText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShortText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereViewsCount($value)
 * @method static \Illuminate\Database\Query\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Article withoutTrashed()
 * @mixin \Eloquent
 */
class Article extends Model
{
    use SoftDeletes, Sluggable;
    use Searchable, SSearch;

    public $table = 'articles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'full_text',
        'short_text',
        'views_count',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @codeCoverageIgnore
     */
    public function toSearchableArray()
    {
        $fields = $this->toArray();

        $allowed  = ['id','title','short_text','full_text', 'created_at'];
        $filtered = array_filter(
            $fields,
            fn ($key) => in_array($key, $allowed),
            ARRAY_FILTER_USE_KEY
        );

        return $filtered;
    }

    public static function ssearchFallback($query)
    {
        return static::query()->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%');
            });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function roles()
    {
        return $this->belongsToMany(CompanyRole::class,'role_has_articles','article_id','role_id');
    }

    public function scopeIsInternal($query, $isInternal=false, $excludeRole=false)
    {
        $query = $query->where('is_internal','=',$isInternal);

        if(!$isInternal && !$excludeRole) {
            if(auth()->user()) {
                $query = $query->whereHas('roles', function($q) {
                    $q->where('id', '=',auth()->user()->company->company_role_id);
                });
            } else {
                $query = $query->where('id','=',0); //escludo tutti i non loggati
            }

        }

        return $query;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
