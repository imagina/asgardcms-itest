<?php

namespace Modules\Itest\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Translatable;

    protected $table = 'itest__questions';
    public $translatedAttributes = ['title'];
    protected $fillable = ['title','value','order','status','user_id','options'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array'
    ];

    public function Categories(){
        return $this->belongsToMany(Category::class,'itest__category_question');
    }

}
