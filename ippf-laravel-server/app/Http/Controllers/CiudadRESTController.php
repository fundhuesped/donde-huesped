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

       /* $ciudades = DB::table('ciudad')
                ->select('ciudad.id', 'ciudad.nombre_ciudad', DB::raw('COUNT(places.idCiudad) as cantidadEstablecimientos'))
                //->leftJoin('places', 'places.idCiudad' ,'=', 'ciudad.id', 'AND', 'places.condones', '=', 1, 'AND', 'places.habilitado', "=", 1)
                ->leftJoin('places', function($join) use ($service){
                     $join->on('places.idCiudad', '=', 'ciudad.id')
                          ->where('places.'.$service, '=', 1)
                          ->where('places.habilitado', "=", 1);
                })

                ->where('ciudad.habilitado', '=', 1)
                ->where('ciudad.idPartido', '=', $pid)
                ->groupBy('ciudad.id')
                ->get();*/

        $placesByParty = DB::table('places')
                ->select('partido.id', 'partido.nombre_partido', '')

        return $placesByParty;

    }

}
