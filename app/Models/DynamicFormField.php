<?php

namespace App\Models;


// use Illuminate\Database\Eloquent\Model;

class DynamicFormField // extends Model
{
    public int $key;
    public string $name;
    public int $order;
    public string $type;
    public string $label;
    public string $className;
    public string $id;
    public string $style;
    public ?array $rules;
    public  $customAttributes;
    public ?string $placeholder;
    public ?array $options;

    public function __construct($data)
    {
        // dd($data);
        $this->key              = $data['key'];
        $this->name             = $data['name'];
        $this->type             = $data['type'];
        $this->label            = $data['label'];
        $this->className        = $data['class'];
        $this->id               = $data['id'];
        $this->style            = $data['style'];
        $this->rules            = $this->setRules($data['rules']);
        $this->customAttributes = $data['custom_attributes'] ?? [];
        $this->placeholder      = $data['placeholder'] ?? null;
        $this->options          = $data['options'] ?? [];
    }


    private function setRules(array $rules) :array
    {
        if (!$rules) {
            return [];
        }

        return array_filter($rules);
    }
}
