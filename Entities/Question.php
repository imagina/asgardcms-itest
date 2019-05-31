<?php

namespace Modules\Itest\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Itest\Presenters\TestPresenter;

class Question extends Model
{
    use Translatable, PresentableTrait, NamespacedEntity;

    protected static $entityNamespace = 'asgardcms/itest-question';
    protected $table = 'itest__questions';
    public $translatedAttributes = ['title'];
    protected $fillable = ['title','value','order','status','user_id','options'];
    protected $presenter = TestPresenter::class;
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
