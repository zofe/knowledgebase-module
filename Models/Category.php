<?php

namespace App\Modules\Knowledgebase\Models;


use Zofe\Rapyd\Traits\SSearch;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $slug
 * @property int $is_internal
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\KnowledgeBase\Models\Article[] $articles
 * @property-read int|null $articles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Category isInternal($isInternal = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use SoftDeletes, Sluggable;
    use SSearch;

    public $table = 'categories';

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
        return static::query()->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        });
    }

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('id', 'desc');
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
