<?php

namespace Modules\Itest\Entities;

use Illuminate\Database\Eloquent\Model;

class ResultTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['description'];
    protected $table = 'itest__result_translations';
}
