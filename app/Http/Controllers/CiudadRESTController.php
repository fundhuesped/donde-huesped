<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pais;
use App\Provincia;
use App\Partido;
use App\Ciudad;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CiudadRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getAll(){

          return Ciudad::all();

    }

    //List of enabled places that belong to a party by service

    public function getpPlacesByParty($pid, $service){

        $placesByParty = DB::table('places')
                ->select('partido.id', 'partido.nombre_partido', '');

        return $placesByParty;

    }


    public function showCitiespp($per_page, $q = '')
    {
      $keys = explode(" ", $q);

      $cities = DB::table('ciudad')
      ->join('partido', 'partido.id', '=', 'ciudad.idPartido')
      ->join('provincia', 'provincia.id', '=', 'ciudad.idProvincia')
      ->join('pais', 'pais.id', '=', 'ciudad.idPais')
      ->leftJoin('places', function($join){
        $join->on('places.idCiudad', '=', 'ciudad.id')->where('places.aprobado','=','1');
      })
      ->select('ciudad.nombre_ciudad', 'ciudad.id', 'partido.nombre_partido','provincia.nombre_provincia','pais.nombre_pais','ciudad.habilitado', DB::raw("COUNT(places.idCiudad) as countPlaces"))
      ->where(function ($query) use ($keys) {
            foreach ($keys as $eachQueryString) {
                $query->orWhere('ciudad.nombre_ciudad', 'LIKE', '%'.$eachQueryString .'%');
                $query->orWhere('provincia.nombre_provincia', 'LIKE', '%'.$eachQueryString .'%');
                $query->orWhere('pais.nombre_pais', 'LIKE', '%'.$eachQueryString .'%');
            }
        })
      ->groupBy('ciudad.id')
      ->orderBy('countPlaces')
      ->paginate($per_page);

      return $cities;
    }

    public function showCities()
    {
      $cities = DB::table('ciudad')
      ->join('partido', 'partido.id', '=', 'ciudad.idPartido')
      ->join('provincia', 'provincia.id', '=', 'ciudad.idProvincia')
      ->join('pais', 'pais.id', '=', 'ciudad.idPais')
      ->leftJoin('places', function($join){
        $join->on('places.idCiudad', '=', 'ciudad.id')->where('places.aprobado','=','1');
      })
      ->select('ciudad.nombre_ciudad', 'ciudad.id', 'partido.nombre_partido','provincia.nombre_provincia','pais.nombre_pais','ciudad.habilitado', DB::raw("COUNT(places.idCiudad) as countPlaces"))
      ->groupBy('ciudad.id')
      ->orderBy('countPlaces')
      ->paginate($per_page);

      return $cities;
    }

    public function updateHabilitado(Request $request, $id)
    {
        $request_params = $request->all();
        $ciudad = Ciudad::find($id);

        if($request->has('habilitado')){
          $ciudad->habilitado = $request_params['habilitado'] ? 1 : 0;
          $ciudad->updated_at = date("Y-m-d H:i:s");
          $ciudad->save();
        }
          return [];

    }

    public function showCity($pais,$provincia, $partido)
    {
        $ciudades = DB::table('ciudad')
          ->join('partido', 'partido.id', '=', 'ciudad.idPartido')
          ->join('provincia', 'provincia.id', '=', 'partido.idProvincia')
          ->join('pais', 'pais.id', '=', 'partido.idPais')
          ->where('nombre_pais',$pais)
          ->where('nombre_provincia',$provincia)
          ->where('nombre_partido',$partido)
          ->orderBy('nombre_ciudad')
          ->get();
          
        return view('seo.ciudades',compact('ciudades','partido','provincia','pais'));
    }


    public function showCitiesByIdPartido($id)
    {
        $ciudades = DB::table('ciudad')
          ->join('partido', 'partido.id', '=', 'ciudad.idPartido')
          ->where('ciudad.idPartido',$id)
          ->orderBy('nombre_ciudad')
          ->get();
          
        return $ciudades;
    }    

}
