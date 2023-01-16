<?php

namespace App\Models;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class DynamicForm extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formidable';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'fields', 'online', 'url', 'short_code'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_url'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'fields' => 'collection',
    ];


    public function getFieldsAttribute($value)
    {
        $data = json_decode($value, true);

        if (!$data) {
            return collect();
        }

        return  collect($data)->mapInto(DynamicFormField::class);
    }

    /**
     * Get the 
     *
     * @param  string  $value
     * @return string
     */
    public function getFullUrlAttribute($value)
    {
        return route('formidable.url', ['url' => $this->url]);
    }

 

    private function generateUrl() :string
    {
        return Str::upper(Str::random(20));
    }

    private function generateShortCode() :string
    {
        return "[formidable url='{$this->url}' title='{$this->title}']";
    }

    public function getRouteKeyName(): string
    {
        return  'url';
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByUrl($query, $url)
    {
        return $query->where('url', $url);
    }


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::creating(function (DynamicForm $model) {
            $model->setAttribute('url', $model->generateUrl());
            $model->setAttribute('short_code', $model->generateShortCode());
        });
    }

}
