<?php

namespace App\Models;

use Guysolamour\Administrable\Traits\SluggableTrait;

use Guysolamour\Administrable\Models\BaseModel;
use Guysolamour\Administrable\Traits\ModelTrait;
use Guysolamour\Administrable\Traits\DraftableTrait;

/**
 * App\Models\Note
 *
 * @property int $id
 * @property bool $online
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $form_name
 * @property-read string $formated_date
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|Note draft()
 * @method static \Illuminate\Database\Eloquent\Builder|Note findAllBySlug(array $slugs)
 * @method static \Illuminate\Database\Eloquent\Builder|Note findBySlug(string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Note findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel last(?int $limit = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note online()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withCacheCooldownSeconds(?int $seconds = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Note withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Note extends BaseModel
{
    use ModelTrait;
    use SluggableTrait;
    use DraftableTrait;

    

    // The attributes that are mass assignable.
    public $fillable = ['online', 'title', 'description', 'slug'];

    // The attributes that should be cast to native types.
    protected $casts = [
        'online' => 'boolean',
    ];

    

    

    
    protected $sluggablefield = 'title';



    // add relation methods below



}
