<?php

namespace App\Models;

use Guysolamour\Administrable\Traits\SluggableTrait;

use Guysolamour\Administrable\Models\BaseModel;
use Guysolamour\Administrable\Traits\ModelTrait;
use Guysolamour\Administrable\Traits\DraftableTrait;

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
