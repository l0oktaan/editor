<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataViewer;

class Depart extends Model
{
    use DataViewer;
    protected $fillable = ['id', 'departname'];
    public function editors(){
        return $this->hasMany('App\Editor');
    }
}
