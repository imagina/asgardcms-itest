<?php

namespace Modules\Itest\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;


class Category extends Model
{
    use Translatable,  MediaRelation, PresentableTrait, NamespacedEntity;

    protected $table = 'itest__categories';
    public $translatedAttributes = ['title','slug','description','meta_title','meta_description','meta_keywords','translatable_options'];
    protected $fillable = ['title','slug','description','meta_title','meta_description','meta_keywords','translatable_options','user_id','options','status','order'];

    protected $fakeColumns = ['options'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array'
    ];

    public function questions(){
        return $this->belongsToMany(Question::class,'itest__category_question');
    }
    public function results(){
        return $this->hasMany(Result::class);
    }

    public function getOptionsAttribute($value) {
        $options=json_decode($value);
        return $options;

    }
    public function getMainImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'mainimage')->first();
        if ($thumbnail === null) {
            $thumbnail = (object)['path' => null, 'main-type' => 'image/jpeg'];
            $thumbnail->path = 'modules/itets/img/default.jpg';
        }
        return $thumbnail;
    }
}
