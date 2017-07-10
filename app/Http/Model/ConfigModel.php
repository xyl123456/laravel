<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    protected $table = "config";
    protected $primaryKey = 'conf_id';
    public $timestamps= false;
    protected $guarded=[];

}
