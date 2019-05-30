<?php

namespace Modules\Itest\Entities;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

    protected $table = 'itest__tests';
    protected $fillable = ['question_id','email','key','category_id','value'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
