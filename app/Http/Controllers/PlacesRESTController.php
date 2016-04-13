<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LocalidadRESTController;
use App\Http\Controllers\ProvinciaRESTController;
use App\Provincia;
use App\Places;
use Validator;
use DB;

class PlacesRESTController extends Controller
{
  

  static public function getAll(){

      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.aprobado', '=', 1)
      ->select()
      ->get();

  }
  static public function showApproved(){

      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.aprobado', '=', 1)
      ->select()
      ->get();

  }
  

  static public function showDreprecated(){

    return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.aprobado', '=', -1)
      ->select()
      ->get();

    }
      static public function showPending(){

    return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.aprobado', '=', 0)
      ->select()
      ->get();

    }


  public function showPanel($id)
   {
     return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.placeId', '=', $id)
      ->select()
      ->get();

   }

    public function block(Request $request, $id){

        $request_params = $request->all();

       $place = Places::find($id);

       $place->aprobado = -1;

       $place->updated_at = date("Y-m-d H:i:s");
       $place->save();

        return [];
   }

      public function approve(Request $request, $id){

        $request_params = $request->all();

       $place = Places::find($id);

       $place->aprobado = 1;

       $place->updated_at = date("Y-m-d H:i:s");
       $place->save();

        return [];
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $request_params = $request->all();

      $rules = array(
          'establecimiento' => 'required|max:150|min:4',
          'nombre_partido' => 'required|max:50|min:4',
          'nombre_provincia' => 'required|max:50|min:4',
          'nombre_pais' => 'required|max:50|min:4',
      );

      $messages = array(
          'required'    => 'El :attribute es requerido.',
          'max'    => 'El :attribute debe poseer un maximo de :max caracteres.',
        'min'    => 'El :attribute debe poseer un minimo de :min caracteres.');

      $validator = Validator::make($request_params,$rules,$messages);

      if ($validator->passes ()){
        $place = Places::find($id);


        $place->establecimiento = $request_params['establecimiento'];
        $place->calle = $request_params['calle'];
        $place->altura = $request_params['altura'];
        $place->cruce = $request_params['cruce'];
        $place->latitude = $request_params['latitude'];
        $place->longitude = $request_params['longitude'];


        // //Updating localidad
        // $localidad_tmp = LocalidadRESTController::showByNombre($request_params['nombre_localidad']);
        // if(is_null($localidad_tmp)){
        //     $localidad = new Localidad;
        //     $localidad->nombre_localidad = $request_params['nombre_localidad'];
        //     $localidad->idProvincia = $place->idProvincia;
        //     $localidad->updated_at = date("Y-m-d H:i:s");
        //     $localidad->created_at = date("Y-m-d H:i:s");
        //     $localidad->save();
        //     $place->idLocalidad = $localidad->id;
        // }else{
        //     $place->idLocalidad = $localidad_tmp->id;
        // }

        $place->updated_at = date("Y-m-d H:i:s");
        $place->save();
      }

      return $validator->messages();
    }



}
