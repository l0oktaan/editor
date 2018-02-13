<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataViewer;

class Editor extends Model
{
    use DataViewer;
    public static $columns = [
        'id','fname','depart_id','job','user_id'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }
    public function Depart(){
        return $this->belongsTo('App\Depart');
    }

    //public $sortable = ['workgroup_id'];
}
