<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

  static public function getScalar($pid,$cid,$bid){

      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.idPais',  $pid)
      ->where('places.idProvincia', $cid)
      ->where('places.idPartido', $bid)
      ->where('places.aprobado', '=', 1)
      ->select()
      ->get();

  }
  static public function getScalarLatLon($lat,$lng){

      return 
              DB::table('places')->select(DB::raw('*,round( 3959 * acos( cos( radians('.$lat.') ) 
              * cos( radians( places.latitude ) ) 
              * cos( radians( places.longitude ) - radians('.$lng.') ) 
              + sin( radians('.$lat.') ) 
              * sin( radians( places.latitude ) ) ) ,2) * 22 AS distance'))
                     ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
                     ->join('partido', 'places.idPartido', '=', 'partido.id')
                     ->join('pais', 'places.idPais', '=', 'pais.id')
                     ->where('places.aprobado', '=', 1)
                     ->having('distance','<', 50000)
                     ->orderBy('distance')
                     ->take(30)
                     ->get();


  }
 

   static public function getScalarServices($pid,$cid,$bid,$service){

      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where($service,'=',1)
      ->where('places.idProvincia', $cid)
      ->where('places.idPartido', $bid)
      ->where('places.aprobado', '=', 1)
      ->select()
      ->get();

  }
  static function scopeIsLike($query, $q)
  {
      foreach($q as $eachQueryString)
      {    
          $query->orWhere('establecimiento', 'LIKE', '%'.$eachQueryString .'%');
          $query->orWhere('calle', 'LIKE', '%'.$eachQueryString .'%');
          $query->orWhere('altura', 'LIKE', '%'.$eachQueryString .'%');
      }
      return $query;
  }

  static public function search($q){

      $keys = explode(" ", $q);
 
      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where(function($query) use ( $keys )
            {
                foreach($keys as $eachQueryString)
                {    
                    $query->orWhere('establecimiento', 'LIKE', '%'.$eachQueryString .'%');
                    $query->orWhere('calle', 'LIKE', '%'.$eachQueryString .'%');
                    $query->orWhere('altura', 'LIKE', '%'.$eachQueryString .'%');
                }

            })
      ->where('places.aprobado', '=', 1)
      ->select()
      ->get();

  }


  
  static public function showApproved($pid,$cid,$bid){

      return DB::table('places')
      ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
      ->join('partido', 'places.idPartido', '=', 'partido.id')
      ->join('pais', 'places.idPais', '=', 'pais.id')
      ->where('places.idPais',  $pid)
      ->where('places.idProvincia', $cid)
      ->where('places.idPartido', $bid)
      ->where('places.aprobado', '=', 1)
      ->select()
      ->get();


  }


  static public function getCitiRanking(){

      return 
              DB::table('places')
                     ->select(DB::raw('count(*) as lugares, nombre_pais, 
                        nombre_provincia, nombre_partido'))
                     ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
                     ->join('partido', 'places.idPartido', '=', 'partido.id')
                     ->join('pais', 'places.idPais', '=', 'pais.id')
                     ->orderBy('lugares', 'desc')
                     ->groupBy('idPartido')
                     ->get();


  }
    static public function getNonGeo(){

      return 
              DB::table('places')
                     ->select(DB::raw('count(*) as lugares, nombre_pais, 
                        nombre_provincia, nombre_partido'))
                     ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
                     ->join('partido', 'places.idPartido', '=', 'partido.id')
                     ->join('pais', 'places.idPais', '=', 'pais.id')
                     ->whereNull('latitude')
                     ->orderBy('lugares', 'desc')
                     ->groupBy('idPartido')
                     ->get();


  }
    static public function getBadGeo(){

      return 
              DB::table('places')
                     ->select(DB::raw('count(*) as lugares, nombre_pais, 
                        nombre_provincia, nombre_partido'))
                     ->join('provincia', 'places.idProvincia', '=', 'provincia.id')
                     ->join('partido', 'places.idPartido', '=', 'partido.id')
                     ->join('pais', 'places.idPais', '=', 'pais.id')
                     ->where('confidence','=',0.5)
                     ->orderBy('lugares', 'desc')
                     ->groupBy('idPartido')
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
        $place->tipo = $request_params['tipo'];
        $place->altura = $request_params['altura'];
        $place->piso_dpto = $request_params['piso_dpto'];
        $place->observacion = $request_params['observacion'];
        $place->cruce = $request_params['cruce'];
        $place->latitude = $request_params['latitude'];
        $place->longitude = $request_params['longitude'];
        $place->barrio_localidad = $request_params['barrio_localidad'];


        $place->prueba = $request_params['prueba'];
        $place->responsable_testeo = $request_params['responsable_testeo'];
        $place->ubicacion_testeo = $request_params['ubicacion_testeo'];
        $place->horario_testeo = $request_params['horario_testeo'];
        $place->mail_testeo = $request_params['mail_testeo'];
        $place->tel_testeo = $request_params['tel_testeo'];
        $place->web_testeo = $request_params['web_testeo'];
        $place->observaciones_testeo = $request_params['observaciones_testeo'];

        $place->condones = $request_params['condones'];
        $place->responsable_distrib = $request_params['responsable_distrib'];
        $place->ubicacion_distrib = $request_params['ubicacion_distrib'];
        $place->horario_distrib = $request_params['horario_distrib'];
        $place->mail_distrib = $request_params['mail_distrib'];
        $place->tel_distrib = $request_params['tel_distrib'];
        $place->web_distrib = $request_params['web_distrib'];
        $place->comentarios_distrib = $request_params['comentarios_distrib'];

        $place->infectologia = $request_params['infectologia'];
        $place->responsable_infectologia = $request_params['responsable_infectologia'];
        $place->ubicacion_infectologia = $request_params['ubicacion_infectologia'];
        $place->horario_infectologia = $request_params['horario_infectologia'];
        $place->mail_infectologia = $request_params['mail_infectologia'];
        $place->tel_infectologia = $request_params['tel_infectologia'];
        $place->web_infectologia = $request_params['web_infectologia'];
        $place->comentarios_infectologia = $request_params['comentarios_infectologia'];

        $place->vacunatorio = $request_params['vacunatorio'];
               
        $place->responsable_vac = $request_params['responsable_vac'];
        $place->ubicacion_vac = $request_params['ubicacion_vac'];
        $place->horario_vac = $request_params['horario_vac'];
        $place->mail_vac = $request_params['mail_vac'];
        $place->tel_vac = $request_params['tel_vac'];
        $place->web_vac = $request_params['web_vac'];
        $place->comentarios_vac = $request_params['comentarios_vac'];




        // //Updating localidad
        // $localidad_tmp = LocalidadRESTController::showByNombre($request_params['nombre_localidad']);
        // if(is_null($localidad_tmp)){
        //     $localidad = new Localidad;
        //     $localidad->nombre_localidad = 
        //       $request_params['nombre_localidad'];
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
