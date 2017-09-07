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

    //List of enabled cities that belong to a party with number of approved places by service
    public function getCitiesByParty($pid, $service){

        $ciudades = DB::table('ciudad')
                ->select('ciudad.id', 'ciudad.nombre_ciudad', DB::raw('COUNT(places.idCiudad) as cantidadEstablecimientos'))
                ->leftJoin('places', 'ciudad.id' ,'=', 'places.idCiudad', 'AND', 'places.'.$service, '=', 1, 'AND', 'places.aprobado', "=", 1)
                ->where('ciudad.habilitado', '=', 1)
                ->where('ciudad.idPartido', '=', $pid)
                ->groupBy('ciudad.id')
                ->get();

        return $ciudades;

    }

}
