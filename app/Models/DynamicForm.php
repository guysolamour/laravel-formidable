<?php

namespace App\Models;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * App\Models\DynamicForm
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $short_code
 * @property string|null $title
 * @property int $active
 * @property Collection $fields
 * @property Collection $entries
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_url
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm findByUrl($url)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereEntries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicForm whereUrl($value)
 * @mixin \Eloquent
 */
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
    protected $fillable = ['title', 'fields', 'online', 'url', 'short_code', 'entries'];

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
        'entries' => 'collection',
    ];

    public function getFieldsAttribute($value) :Collection
    {
        $data = json_decode($value, true);

        if (!$data) {
            return collect();
        }

        return  collect($data)->mapInto(DynamicFormField::class);
    }

    public function getFields(bool $withSubmit = true)
    {
        $fields = $this->fields;

        if (!$withSubmit){
            $fields = $fields->filter(fn(DynamicFormField $field) => $field->type != 'submit');
        }

        return $fields;
    }

    public function pluckFieldsAttribute(string $value = 'name') :Collection
    {
        return $this->fields->pluck($value);
    }

    private function sanitizeData(array $data) :array
    {
        $fields = $this->pluckFieldsAttribute();

        return collect($data)
                    ->map(fn ($value, $key) => $fields->contains($key) ? $value : null)
                    ->filter()
                    ->put($this->getCreatedAtColumn(), Date::now()->format('d/m/Y H:i:s'))
                    ->all();
    }

    public function saveEntries(array $data)
    {
        $data = $this->sanitizeData($data);

        /** @var \Illuminate\Support\Collection */
        $entries = $this->entries ?? collect();

        $entries->push([
            'id' => $entries->count() + 1,
            ...$data
        ]);

        $this->updateQuietly(['entries' => $entries]);
    }

    public function removeEntry(int $id) :bool
    {
        $entries = $this->entries->filter(fn($item) => $item['id'] != $id);

        return $this->updateQuietly(['entries' => $entries]);
    }

    public function getRules() :array
    {
        $rules = [];

        foreach ($this->fields as $field) {
            /** @var DynamicFormField $field */
            $rule = [];

            foreach ($field->rules as $item) {
                $name = Arr::get($item, 'name', '');
                $arg  = Arr::get($item, 'arg');

                $rule[] = $arg ? $name . ":" .$arg : $name;

            }

            $rules[$field->name] = $rule;
        }

        return array_filter($rules);
    }

    /**
     * Get the
     *
     * @param  string  $value
     * @return string
     */
    public function getFullUrlAttribute($value)
    {
        return route('formidable.show', ['url' => $this->url]);
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
