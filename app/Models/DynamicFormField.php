<?php

namespace App\Models;

use Illuminate\Support\Arr;


// use Illuminate\Database\Eloquent\Model;

class DynamicFormField // extends Model
{
    public int $key;
    public string $name;
    public ?int $order;
    public string $type;
    public string $label;
    public string $className;
    public string $id;
    public string $style;
    public ?string $value;
    public ?array $rules;
    public $customAttributes;
    public bool $multiple;
    public ?string $placeholder;
    public ?array $options;

    public function __construct($data)
    {
        $this->key              = $data['key'];
        $this->name             = $data['name'];
        $this->order            = Arr::get($data, 'order');
        $this->type             = $data['type'];
        $this->label            = $data['label'];
        $this->className        = $data['class'];
        $this->id               = $data['id'];
        $this->style            = $data['style'];
        $this->value            = Arr::get($data, 'value', '');
        $this->multiple         = (bool) Arr::get($data, 'multiple');
        $this->rules            = $this->setRules($data['rules']);
        $this->customAttributes = Arr::get($data, 'custom_attributes', []);
        $this->placeholder      = Arr::get($data, 'placeholder');
        $this->options          = Arr::get($data, 'options', []);
    }


    private function setRules(array $rules) :array
    {
        return  $rules ? array_filter($rules) : [];
    }
}
