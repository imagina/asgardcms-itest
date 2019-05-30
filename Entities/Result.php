<?php

namespace Modules\Itest\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use Translatable;

    protected $table = 'itest__results';
    public $translatedAttributes = ['description'];
    protected $fillable = ['description','category_id','value'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
