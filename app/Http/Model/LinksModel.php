<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class LinksModel extends Model
{
    protected $table = "links";
    protected $primaryKey = 'links_id';
    public $timestamps= false;
    protected $guarded=[];

}
