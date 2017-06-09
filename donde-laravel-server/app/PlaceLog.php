<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceLog extends Model {

  protected $table = 'places_log';
  public $timestamps = false;

  public function places()
  {
    return $this->hasMany('App\Places', 'place_id');
  }

}
