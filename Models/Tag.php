<?php

namespace App\Modules\Knowledgebase\Models;

use Zofe\Rapyd\Traits\SSearch;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\KnowledgeBase\Models\Article[] $articles
 * @property-read int|null $articles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag dArticles()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Query\Builder|Tag onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Tag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Tag withoutTrashed()
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use SoftDeletes, Sluggable;
    use SSearch;

    public $table = 'tags';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
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

        $allowed  = ['id','name','created_at'];
        $filtered = array_filter(
            $fields,
            fn ($key) => in_array($key, $allowed),
            ARRAY_FILTER_USE_KEY
        );

        return $filtered;
    }

    public static function ssearchFallback($query)
    {
        return empty($query) ? static::query()
            : static::query()->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            });
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class,'article_tag');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
