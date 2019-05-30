<?php

namespace Modules\Itest\Entities;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'itest__question_translations';
}
