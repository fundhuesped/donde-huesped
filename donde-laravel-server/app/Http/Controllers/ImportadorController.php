<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Excel;
use Input;
use Storage;
use DB;
use Config;
use App\Pais;
use App\Provincia;
use App\Partido;
use App\Places;

use League\Csv\Writer;
use League\Csv\Reader;

use Image;
use ImageServiceProvider;   

use SplTempFileObject;
use SplFileObject;

class ImportadorController extends Controller {

	public function index()
	{
		return view('panel.importer.index');
	}

	public function picker() //llamo a la vista
	{
		return view('panel.importer.picker');
	}
//==============================================================================================================

	public function exportar(){ //en base a una tabla, creo un CVS.

        $places = DB::table('places')
        	->join('pais','pais.id','=','places.idPais')
        	->join('provincia','provincia.id','=','places.idProvincia')
        	->join('partido','partido.id','=','places.idPartido')
        	->get();

		$csv = Writer::createFromFileObject(new SplTempFileObject());

        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,latitude,longitude,preservativos,vacunatorio,infectologia,tel_testeo,horario_testeo,web_testeo,mail_testeo,responsable_testeo,observaciones_testeo,tel_distrib,horario_distrib,responsable_distrib,web_distrib,mail_distrib,ubicación_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,responsable_infectologia,tel_vac,mail_vac,responsable_vac,mac');
	               
        foreach ($places as $p) {
        $p = (array)$p;
       	// dd($p);
        //$csv->insertAll([$p]);
        $csv->insertOne([
        	$p['establecimiento'],
        	$p['tipo'],
        	$p['calle'],
        	$p['altura'],
			$p['piso_dpto'],
			$p['cruce'],
			$p['barrio_localidad'],
			$p['nombre_partido'],
			$p['nombre_provincia'],
			$p['nombre_pais'],
			$p['latitude'],
			$p['longitude'],
			$p['condones'],
			$p['vacunatorio'],
			$p['infectologia'],
			$p['tel_testeo'],
			$p['horario_testeo'],
			$p['web_testeo'],
			$p['mail_testeo'],
			$p['responsable_testeo'],
			$p['observaciones_testeo'],
			$p['tel_distrib'],
			$p['horario_distrib'],
			$p['responsable_distrib'],
			$p['web_distrib'],
			$p['mail_distrib'],
			$p['ubicacion_distrib'],
			$p['comentarios_distrib'],
			$p['tel_infectologia'],
			$p['mail_infectologia'],
			$p['responsable_infectologia'],
			$p['tel_vac'],
			$p['mail_vac'],
			$p['responsable_vac'],
			1]);
			// $p['mac']]);
        }

        $csv->output('husped.csv');
	}
//==============================================================================================================

//==============================================================================================================
	// function to geocode address, it will return false if unable to geocode address
	public function geocode($address){
	// public function geocode(){
	// $address = "parana ENTRE RIOS";
    
    // url encode the address
    $address = urlencode($address); //para testeo get
    // $address = urlencode($address->address); //para uso con request

     
    // google map geocode api url
    $url = "https://maps.google.com.ar/maps/api/geocode/json?key=AIzaSyACdNTXGb7gdYwlhXegObZj8bvWtr-Sozc&address={$address}";
 	
	// dd($address);
    // get the json response

    $resp_json = file_get_contents($url);
	
     
 	// dd($resp_json);
    // decode the json
    $resp = json_decode($resp_json, true);
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
			
            return $data_arr;
             
        }else{
            return false;
        }
         
    }else{
        return false;
    }
}

//=================================================================================================================
//=================================================================================================================
//	RUTA PREVIEW, VISUALIZO LOS NUEVOS DATOS
//=================================================================================================================
//=================================================================================================================

public function preAdd(Request $request) {
	$_SESSION['NuevosPaises']= array();
	$_SESSION['NuevosProvincia']= array();
	$_SESSION['NuevosPartido']= array();
	$_SESSION['NuevosPlaces']= array();

	$_SESSION['cPais']=0;
	$_SESSION['cProvincia']=0;
	$_SESSION['cPartido']=0;

   	$tmpFile = Input::file('file')->getClientOriginalName();
   	
   	$_SESSION['nombreFile'] = $tmpFile;
   	Storage::disk('local')->put($tmpFile, \File::get($request->file('file') ) );
   	
   	//Cargo en memoria el csv para desp meterlo en la DB
	Excel::load(storage_path().'/app/'.$tmpFile, function($reader){ 
		foreach ($reader->get() as $book) {
			$address = "";
			$address = $book->pais;
			$address = $address.' '.$book->provincia_region;
			$address = $address.' '.$book->partido_comuna;
			$address = $address.' '.$book->barrio_localidad;
			$address = $address.' '.$book->altura;
			$address = $address.' '.$book->calle;
			//verificar como queda formado address para ver si es localizable
            $latLng = new ImportadorController();	
            $latLng = $latLng->geocode($address); // [lati,longi,formatted_address]
			
            
            if ($latLng){
                    //si se puede localizar arranca la joda de las bds

                $existePais = DB::table('pais')
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->first();

                $existeProvincia = DB::table('provincia')
                    ->join('pais','pais.id','=','provincia.idPais')
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                    ->first();

                $existePartido = DB::table('partido')
                	->join('provincia','provincia.id','=','partido.idProvincia')
                	->join('pais','pais.id','=','partido.idPais')
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                    ->where('partido.nombre_partido', 'like', '%' .$book->partido_comuna.'%')
                    ->first();

                $existePlace = DB::table('places')
                	->join('pais','pais.id','=','places.idPais')
                	->join('provincia','provincia.id','=','places.idProvincia')
                    ->join('partido','partido.id','=','places.idProvincia')
                    ->where('places.establecimiento', 'like', '%' .$book->establecimiento.'%')
                    ->where('places.tipo', 'like', '%' .$book->tipo.'%')
                    ->where('places.calle', 'like', '%' .$book->calle.'%')
                    // ->where('places.altura', 'like', '%' .$book->altura.'%')
                    // ->where('places.piso_dpto', 'like', '%' .$book->piso_dpto.'%')
                    // ->where('places.cruce', 'like', '%' .$book->cruce.'%')
                    ->where('places.barrio_localidad', 'like', '%' .$book->barrio_localidad.'%')
                    ->where('places.latitude', '=', $latLng[0])
                    ->where('places.longitude', '=', $latLng[1])
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                    ->where('partido.nombre_partido', 'like', '%' .$book->partido_comuna.'%')
                    ->first();
				
				if (!$existePais) { //si es nuevo el pais en la BD lo agarro
					//Ahora me fijo si existe en mi variable session
					$salida = true;
						foreach ($_SESSION['NuevosPaises'] as $key => $value) {
								if ( $value ==  $book->pais ){
									$salida = false;
									break;
								}
						}
					if ($salida) { 
						array_push($_SESSION['NuevosPaises'],$book->pais);	
						$_SESSION['cPais']++;
					}

				}
				if (!$existeProvincia) { //si no existe la prov en lectura vs bd
					$salida = true;
						foreach ($_SESSION['NuevosProvincia'] as $key => $value) {
								if ( $value ==  $book->provincia_region ){
									$salida = false;
									break;
								}
						}
					if ($salida) {
						array_push($_SESSION['NuevosProvincia'],$book->provincia_region);	
						$_SESSION['cProvincia']++;
					}
				}//del ifelse
				if (!$existePartido) {
					$salida = true;
						foreach ($_SESSION['NuevosPartido'] as $key => $value) {
								if ( $value['Partido'] ==  $book->partido_comuna && $value['Provincia'] ==$book->provincia_region ){
									$salida = false;
									break;
								}
						}
					if ($salida) {
						array_push($_SESSION['NuevosPartido'],array('Partido'=>$book->partido_comuna,'Provincia'=>$book->provincia_region));
						$_SESSION['cPartido']++;
						}	
				}
				// elseif (!$existePlace) {
				// }

            } //del if (%LatLng)
            // else { //no se puede mostrar, baja fidelidad o incompletos  partido_comuna
            // 	$_SESSION['CantidadDescartados']++;	

            // }
		}//del for each 
	});//del exel::load
	//Armo los datos para mostrar
	$nuevosPaises =$_SESSION['NuevosPaises'];
	$nuevosProvincias =$_SESSION['NuevosProvincia'];
	$nuevosPartidos =$_SESSION['NuevosPartido'];
	$cantidadPais = $_SESSION['cPais'];
	$cantidadProvincia = $_SESSION['cProvincia'];
	$cantidadPartido = $_SESSION['cPartido'];

	$nombreFile =  $_SESSION['nombreFile'];
	

	return view('panel.importer.preview',compact('nuevosPaises','nuevosProvincias','nuevosPartidos','nombreFile','cantidadPais','cantidadProvincia','cantidadPartido'));
}

//=================================================================================================================
//=================================================================================================================
//	RUTA RESULTS, AGREGANDO A BD EN ESTA FUNCION
//=================================================================================================================
//=================================================================================================================

public function posAdd(Request $request) //vista results, agrego a BD
{	
	$_SESSION['CantidadRepetidos']= 0;	
	$_SESSION['CantidadIncompletos']= 0;	
	$_SESSION['CantidadUnificar']= 0;	
	$_SESSION['CantidadDescartados']= 0;	

	$_SESSION['Repetidos']= array();
	$_SESSION['Incompletos']= array();
	$_SESSION['Unificar']= array();
	$_SESSION['Descartados']= array();
   	
   	//Cargo en memoria el csv para desp meterlo en la DB
	Excel::load(storage_path().'/app/'.$request->fileName, function($reader){ 
		foreach ($reader->get() as $book) {
			$address = "";
			$address = $book->pais;
			$address = $address.' '.$book->provincia_region;
			$address = $address.' '.$book->partido_comuna;
			$address = $address.' '.$book->barrio_localidad;
			$address = $address.' '.$book->altura;
			$address = $address.' '.$book->calle;

			//FILTRO INCOMPLETO
			// if ($book->establecimiento || $book->tipo || $book->calle || $book->altura || $book->barrio_localidad || $book->partido_comuna || $book->provincia_region || $book->pais || !$book->mac) {
		if (!$book->establecimiento || !$book->calle || !$book->barrio_localidad || !$book->partido_comuna || !$book->provincia_region || !$book->pais) {
			$_SESSION['CantidadIncompletos']++;     
                                array_push($_SESSION['Incompletos'],
                                            array(
                                                'status' => 'ADD_REPITED',
                                                'pais' => $book->pais,
                                                'provincia_region' => $book->provincia_region,
                                                'partido_comuna' => $book->partido_comuna,
                                                'barrio_localidad' => $book->barrio_localidad,
                                                'calle' => $book->calle,
                                                'altura' => $book->altura,
                                                'piso_dpto' => $book->piso_dpto,
                                                'cruce' => $book->cruce,
                                                'tipo' => $book->tipo,
                                                'latitude' => $latLng[0],
                                                'longitude' => $latLng[1],
                                                'formattedAddress' => $latLng[2],
                                                'testeo' => $book->testeo,
                                                'tel_testeo' => $book->tel_testeo,
                                                'horario_testeo' => $book->horario_testeo,
                                                'web_testeo' => $book->web_testeo,
                                                'mail_testeo' => $book->mail_testeo,
                                                'responsable_testeo' => $book->responsable_testeo,
                                                'observaciones_testeo' => $book->observaciones_testeo,
                                                'preservativos' => $book->preservativos,
                                                'tel_distrib' => $book->tel_distrib,
                                                'horario_distrib' => $book->horario_distrib,
                                                'responsable_distrib' => $book->responsable_distrib,
                                                'web_distrib' => $book->web_distrib,
                                                'mail_distrib' => $book->mail_distrib,
                                                'ubicacion_distrib' => $book->ubicación_distrib,
                                                'comentarios_distrib' => $book->comentarios_distrib,
                                                'vacunatorio' => $book->vacunatorio,
                                                'tel_vac' => $book->tel_vac,
                                                'mail_vac' => $book->mail_vac,
                                                'responsable_vac' => $book->responsable_vac,
                                                'tel_infectologia' => $book->tel_infectologia,
                                                'mail_infectologia' => $book->mail_infectologia,
                                                'responsable_infectologia' => $book->responsable_infectologia,
                                                'mac' => $book->mac,
                                                'establecimiento' => $book->establecimiento)); 
		}//del if incompleto	

			//verificar como queda formado address para ver si es localizable
            $latLng = new ImportadorController();	
            $latLng = $latLng->geocode($address); // [lati,longi,formatted_address]
            
            if ($latLng){
                    //si se puede localizar arranca la joda de las bds

               $existePais = DB::table('pais')
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->first();

                $existeProvincia = DB::table('provincia')
                    ->join('pais','pais.id','=','provincia.idPais')
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                    ->first();

                $existePartido = DB::table('partido')
                	->join('provincia','provincia.id','=','partido.idProvincia')
                	->join('pais','pais.id','=','partido.idPais')
                    ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                    ->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                    ->where('partido.nombre_partido', 'like', '%' .$book->partido_comuna.'%')
                    ->first();

                //FILTRO REPETIDO
                $existePlace = DB::table('places')
                	->join('pais','pais.id','=','places.idPais')
                	->join('provincia','provincia.id','=','places.idProvincia')
                    ->join('partido','partido.id','=','places.idProvincia')
                    ->where('places.establecimiento', 'like', '%' .$book->establecimiento.'%')
                    ->where('places.tipo', 'like', '%' .$book->tipo.'%')
                    ->where('places.calle', 'like', '%' .$book->calle.'%')
                    ->where('places.altura', '=', $book->altura)
                    ->where('places.piso_dpto', '=', $book->piso_dpto)
                    // ->where('places.cruce', 'like', '%' .$book->cruce.'%')
                    ->where('places.barrio_localidad', 'like', '%' .$book->barrio_localidad.'%')
                    ->where('places.latitude', '=', $latLng[0])
                    ->where('places.longitude', '=', $latLng[1])
                    ->where('places.condones', '=', $book->condones)
                    ->where('places.prueba', '=', $book->prueba)
                    ->where('places.vacunatorio', '=', $book->vacunatorio)
                    ->where('places.infectologia', '=', $book->infectologia)

					->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                    ->where('partido.nombre_partido', 'like', '%' .$book->partido_comuna.'%')
                    ->first();
				
				if ($existePais && $existeProvincia && $existePartido && $existePlace) { //si entra aca esta repetido
                	$_SESSION['CantidadRepetidos']++;     
                            // $tmpObject = array(); //manipulo toda la lectura de linea         
                                // array_push($tmpObject,
                                array_push($_SESSION['Repetidos'],
                                            array(
                                                'status' => 'ADD_REPITED',
                                                'pais' => $book->pais,
                                                'provincia_region' => $book->provincia_region,
                                                'partido_comuna' => $book->partido_comuna,
                                                'barrio_localidad' => $book->barrio_localidad,
                                                'calle' => $book->calle,
                                                'altura' => $book->altura,
                                                'piso_dpto' => $book->piso_dpto,
                                                'cruce' => $book->cruce,
                                                'tipo' => $book->tipo,
                                                'latitude' => $latLng[0],
                                                'longitude' => $latLng[1],
                                                'formattedAddress' => $latLng[2],
                                                'testeo' => $book->testeo,
                                                'tel_testeo' => $book->tel_testeo,
                                                'horario_testeo' => $book->horario_testeo,
                                                'web_testeo' => $book->web_testeo,
                                                'mail_testeo' => $book->mail_testeo,
                                                'responsable_testeo' => $book->responsable_testeo,
                                                'observaciones_testeo' => $book->observaciones_testeo,
                                                'preservativos' => $book->preservativos,
                                                'tel_distrib' => $book->tel_distrib,
                                                'horario_distrib' => $book->horario_distrib,
                                                'responsable_distrib' => $book->responsable_distrib,
                                                'web_distrib' => $book->web_distrib,
                                                'mail_distrib' => $book->mail_distrib,
                                                'ubicacion_distrib' => $book->ubicación_distrib,
                                                'comentarios_distrib' => $book->comentarios_distrib,
                                                'vacunatorio' => $book->vacunatorio,
                                                'tel_vac' => $book->tel_vac,
                                                'mail_vac' => $book->mail_vac,
                                                'responsable_vac' => $book->responsable_vac,
                                                'tel_infectologia' => $book->tel_infectologia,
                                                'mail_infectologia' => $book->mail_infectologia,
                                                'responsable_infectologia' => $book->responsable_infectologia,
                                                'mac' => $book->mac,
                                                'establecimiento' => $book->establecimiento)); 
				}

                $finalIdPais =0;
                $finalIdProvincia = 0;
                $finalIdPartido = 0;

                if ($existePais) $finalIdPais =$existePais->id;
				if ($existeProvincia) $finalIdProvincia = $existeProvincia->id;
				if ($existePartido) $finalIdPartido = $existePartido->id;

				 if (!$existePais) {	
                        //PAIS
                        $pais = new Pais;
                        $pais->nombre_pais = $book->pais;
                        $pais->save();
                        $finalIdPais = $pais->id;
                    }//del existe pais 

                    if (!$existeProvincia) { //CASO 2, no existe la provincia en la BD
                            //PROVINCIA
                            $provincia = new Provincia;
                            $provincia->nombre_provincia = $book->provincia_region;
                            $provincia->idPais = $finalIdPais;
                            $provincia->save();
                            $finalIdProvincia = $provincia->id;
                        }//del provincia

                    if (!$existePartido) {  //CASO 3, no existe partido en la BD     
                            //PARTIDO
                            $partido = new Partido;
                            $partido->nombre_partido = $book->partido_comuna;
                            $partido->idPais = $finalIdPais;
                            $partido->idProvincia = $finalIdProvincia;
                            $partido->save();
							$finalIdPartido = $partido->id;
                    }

                    //aca gato
                if (!$existePlace) {//CASO 4, exite todo en la BD, sola queda comp LAT y Lng en la bd con el generado    
                        //PLACES
                        $places = new Places;
                        $places->idPais = $finalIdPais;
                        $places->idProvincia = $finalIdProvincia;
                        $places->idPartido = $finalIdPartido;
                        $places->establecimiento = $book->establecimiento;
                        $places->tipo = $book->tipo;
                        $places->calle = $book->calle;
                        $places->altura = $book->altura;
                        $places->piso_dpto = $book->piso_dpto;
                        $places->cruce = $book->cruce;
                        $places->barrio_localidad = $book->barrio_localidad;
                        $places->formattedAddress = $latLng[2];
                        $places->latitude = $latLng[0];
                        $places->longitude = $latLng[1];
                        $places->habilitado = $book->habilitado;
                        $places->vacunatorio = $book->vacunatorio;
                        $places->infectologia = $book->infectologia;
                        $places->condones = $book->condones;
                        $places->prueba = $book->prueba;
                        $places->tel_testeo = $book->tel_testeo;
                        $places->mail_testeo = $book->mail_testeo;
                        $places->horario_testeo = $book->horario_testeo;
                        $places->responsable_testeo = $book->responsable_testeo;
                        $places->web_testeo = $book->web_testeo;
                        $places->responsable_testeo = $book->responsable_testeo;
                        $places->observaciones_testeo = $book->observaciones_testeo;
                        $places->tel_distrib = $book->tel_distrib;
                        $places->mail_distrib = $book->mail_distrib;
                        $places->horario_distrib = $book->horario_distrib;
                        $places->responsable_distrib = $book->responsable_distrib;
                        $places->web_distrib = $book->web_distrib;
                        $places->ubicacion_distrib = $book->ubicación_distrib;
                        $places->comentarios_distrib = $book->comentarios_distrib;
                        $places->tel_infectologia = $book->tel_infectologia;
                        $places->mail_infectologia = $book->mail_infectologia;
                        $places->horario_infectologia = $book->horario_infectologia;
                        $places->web_infectologia = $book->web_infectologia;
                        $places->comentarios_infectologia = $book->comentarios_infectologia;
                        $places->tel_vac = $book->tel_vac;
                        $places->mail_vac = $book->mail_vac;
                        $places->horario_vac = $book->horario_vac;
                        $places->responsable_vac = $book->responsable_vac;
                        $places->mail_vac = $book->mail_vac;
                        $places->ubicacion_vac = $book->ubicación_vac;
                        $places->mac = $book->mac;
                        $places->save();
                    }    

            } //del if (%LatLng)
            else
            {				
                        $_SESSION['CantidadDescartados']++;
                        
                        array_push( $_SESSION['Descartados'],
                                    array(
                                        'status' => 'ADD_BAJA_CONF',
                                        'pais' => $book->pais,
                                        'provincia_region' => $book->provincia_region,
                                        'partido_comuna' => $book->partido_comuna,
                                        'barrio_localidad' => $book->barrio_localidad,
                                        'calle' => $book->calle,
                                        'altura' => $book->altura,
                                        'piso_dpto' => $book->piso_dpto,
                                        'cruce' => $book->cruce,
                                        'tipo' => $book->tipo,
                                        'establecimiento' => $book->establecimiento,
                                        'latitude' => $latLng[0],
                                        'longitude' => $latLng[1],
                                        'formattedAddress' => $latLng[2],
                                        'testeo' => $book->testeo,
                                        'tel_testeo' => $book->tel_testeo,
                                        'horario_testeo' => $book->horario_testeo,
                                        'web_testeo' => $book->web_testeo,
                                        'mail_testeo' => $book->mail_testeo,
                                        'responsable_testeo' => $book->responsable_testeo,
                                        'observaciones_testeo' => $book->observaciones_testeo,
                                        'preservativos' => $book->preservativos,
                                        'tel_distrib' => $book->tel_distrib,
                                        'horario_distrib' => $book->horario_distrib,
                                        'responsable_distrib' => $book->responsable_distrib,
                                        'web_distrib' => $book->web_distrib,
                                        'mail_distrib' => $book->mail_distrib,
                                        'ubicacion_distrib' => $book->ubicación_distrib,
                                        'comentarios_distrib' => $book->comentarios_distrib,
                                        'vacunatorio' => $book->vacunatorio,
                                        'tel_vac' => $book->tel_vac,
                                        'mail_vac' => $book->mail_vac,
                                        'responsable_vac' => $book->responsable_vac,
                                        'tel_infectologia' => $book->tel_infectologia,
                                        'mail_infectologia' => $book->mail_infectologia,
                                        'responsable_infectologia' => $book->responsable_infectologia));	
            }
		}//del for each 
	});//del exel::load
    //dd($_SESSION);
	$datosRepetidos = $_SESSION['Repetidos'];
	$cantidadRepetidos = $_SESSION['CantidadRepetidos'];
	
	$datosDescartados = $_SESSION['Descartados'];
	$cantidadDescartados = $_SESSION['CantidadDescartados'];

	$datosIncompletos = $_SESSION['Incompletos'];
	$cantidadIncompletos = $_SESSION['CantidadIncompletos'];

	$datosUnificar = $_SESSION['Unificar'];
	$cantidadUnificar = $_SESSION['CantidadUnificar'];

	

	return view('panel.importer.results',compact('datosRepetidos','cantidadRepetidos','datosDescartados','cantidadDescartados','datosIncompletos','cantidadIncompletos','datosUnificar','cantidadUnificar'));

}


//=================================================================================================================
//=================================================================================================================
//	STORE
//=================================================================================================================
//=================================================================================================================


	//Importar (Metodo llamado por el Btn Agregar)
    public function store(Request $request)
    {  
        $cantRep = 0;
	 	$cantNue = 0;
	 	$cantDes = 0;
    	$nuevos = array();	
    	$repetidos = array();	

    	//contador de cantidades
		$_SESSION['CantidadNuevos']=$cantNue;	 	
		$_SESSION['CantidadRepetidos']=$cantRep;	
		$_SESSION['CantidadDescartados']=$cantDes;	
		//arreglos de datos
    	$_SESSION['Nuevos']=$nuevos;
    	$_SESSION['Repetidos']=$repetidos;


        //guardo el archivo
       	// $tmpFile = $request->file->getClientOriginalName();
       	$tmpFile = Input::file('file')->getClientOriginalName();
       	Storage::disk('local')->put($tmpFile, \File::get($request->file('file')));
       	
       	//Cargo en memoria el csv para desp meterlo en la DB
    	// Excel::load('..\storage/'.$tmpFile, function($reader) 
    	Excel::load(storage_path().'/app/'.$tmpFile, function($reader) 
        {
            foreach ($reader->get() as $book) 
            {
            	$address = "";
                $address = $book->pais;
                $address = $address.' '.$book->provincia_region;
                $address = $address.' '.$book->partido_comuna;
                $address = $address.' '.$book->barrio_localidad;
                $address = $address.' '.$book->altura;
                $address = $address.' '.$book->calle;

                //verificar como queda formado address
                $latLng = new ImportadorController();	
                $latLng = $latLng->geocode($address); // [lati,longi,formatted_address]
             
                if ($latLng) 
                {
                    //si se puede localizar arranca la joda de las bds

                    $existePais = DB::table('pais')
                        ->where('pais.nombre_pais', 'like', '%' .$book->pais.'%')
                        ->first();

                    $existeProvincia = DB::table('provincia')
                        ->where('provincia.nombre_provincia', 'like', '%' .$book->provincia_region.'%')
                        ->select('provincia.id')
                        ->first();

                    $existePartido = DB::table('partido')
                        ->where('partido.nombre_partido', 'like', '%' .$book->partido_comuna.'%')
                        ->first();

                    $existePlace = DB::table('places')
                        ->where('places.establecimiento', 'like', '%' .$book->establecimiento.'%')
                        ->where('places.tipo', 'like', '%' .$book->tipo.'%')
                        ->where('places.calle', 'like', '%' .$book->calle.'%')
                        ->where('places.altura', 'like', '%' .$book->altura.'%')
                        ->where('places.piso_dpto', 'like', '%' .$book->piso_dpto.'%')
                        ->where('places.cruce', 'like', '%' .$book->cruce.'%')
                        ->where('places.barrio_localidad', 'like', '%' .$book->barrio_localidad.'%')
                        ->where('places.latitude', '=', $latLng[0])
                        ->where('places.longitude', '=', $latLng[1])
                        ->first();	


                    //caso 1 (no existe el pais en la BD)
                    if (!$existePais)
                    {
                        $tmpObject = array(); //manipulo toda la lectura de linea
				
                        $_SESSION['Nuevos']++;
                        
                        array_push( $tmpObject,
                                    array(
                                        'status' => 'ADD_NEW',
                                        'pais' => $book->pais,
                                        'provincia_region' => $book->provincia_region,
                                        'partido_comuna' => $book->partido_comuna,
                                        'barrio_localidad' => $book->barrio_localidad,
                                        'calle' => $book->calle,
                                        'altura' => $book->altura,
                                        'piso_dpto' => $book->piso_dpto,
                                        'cruce' => $book->cruce,
                                        'tipo' => $book->tipo,
                                        'establecimiento' => $book->establecimiento,
                                        'latitude' => $latLng[0],
                                        'longitude' => $latLng[1],
                                        'formattedAddress' => $latLng[2],
                                        'testeo' => $book->testeo,
                                        'tel_testeo' => $book->tel_testeo,
                                        'horario_testeo' => $book->horario_testeo,
                                        'web_testeo' => $book->web_testeo,
                                        'mail_testeo' => $book->mail_testeo,
                                        'responsable_testeo' => $book->responsable_testeo,
                                        'observaciones_testeo' => $book->observaciones_testeo,
                                        'preservativos' => $book->preservativos,
                                        'tel_distrib' => $book->tel_distrib,
                                        'horario_distrib' => $book->horario_distrib,
                                        'responsable_distrib' => $book->responsable_distrib,
                                        'web_distrib' => $book->web_distrib,
                                        'mail_distrib' => $book->mail_distrib,
                                        'ubicacion_distrib' => $book->ubicación_distrib,
                                        'comentarios_distrib' => $book->comentarios_distrib,
                                        'vacunatorio' => $book->vacunatorio,
                                        'tel_vac' => $book->tel_vac,
                                        'mail_vac' => $book->mail_vac,
                                        'responsable_vac' => $book->responsable_vac,
                                        'tel_infectologia' => $book->tel_infectologia,
                                        'mail_infectologia' => $book->mail_infectologia,
                                        'responsable_infectologia' => $book->responsable_infectologia));	
                        //lo agrego al array de nuevos
                        array_push($_SESSION['Nuevos'], $tmpObject);

                        //agrego lo nuevo a la BD, pais + provincia + partido + places

                        //Lo guardo en BD de a 1

                        //PAIS
                        $pais = new Pais;
                        $pais->nombre_pais = $book->pais;
                        $pais->habilitado = 0;
                        $pais->save();

                        //PROVINCIA
                        $provincia = new Provincia;
                        $provincia->nombre_provincia = $book->provincia_region;
                        $provincia->idPais = $pais->id;
                        $provincia->save();

                        //PARTIDO
                        $partido = new Partido;
                        $partido->nombre_partido = $book->partido_comuna;
                        $partido->idPais = $pais->id;
                        $partido->idProvincia = $provincia->id;
                        $partido->save();

                        //PLACES
                        $places = new Places;
                        $places->idPais = $pais->id;
                        $places->idProvincia = $provincia->id;
                        $places->idPartido = $partido->id;
                        $places->establecimiento = $book->establecimiento;
                        $places->tipo = $book->tipo;
                        $places->calle = $book->calle;
                        $places->altura = $book->altura;
                        $places->piso_dpto = $book->piso_dpto;
                        $places->cruce = $book->cruce;
                        $places->barrio_localidad = $book->barrio_localidad;
                        $places->formattedAddress = $latLng[2];
                        $places->latitude = $latLng[0];
                        $places->longitude = $latLng[1];
                        $places->habilitado = $book->habilitado;
                        $places->vacunatorio = $book->vacunatorio;
                        $places->infectologia = $book->infectologia;
                        $places->condones = $book->condones;
                        $places->prueba = $book->prueba;
                        $places->tel_testeo = $book->tel_testeo;
                        $places->mail_testeo = $book->mail_testeo;
                        $places->horario_testeo = $book->horario_testeo;
                        $places->responsable_testeo = $book->responsable_testeo;
                        $places->web_testeo = $book->web_testeo;
                        $places->responsable_testeo = $book->responsable_testeo;
                        $places->observaciones_testeo = $book->observaciones_testeo;
                        $places->tel_distrib = $book->tel_distrib;
                        $places->mail_distrib = $book->mail_distrib;
                        $places->horario_distrib = $book->horario_distrib;
                        $places->responsable_distrib = $book->responsable_distrib;
                        $places->web_distrib = $book->web_distrib;
                        $places->ubicacion_distrib = $book->ubicación_distrib;
                        $places->comentarios_distrib = $book->comentarios_distrib;
                        $places->tel_infectologia = $book->tel_infectologia;
                        $places->mail_infectologia = $book->mail_infectologia;
                        $places->horario_infectologia = $book->horario_infectologia;
                        $places->web_infectologia = $book->web_infectologia;
                        $places->comentarios_infectologia = $book->comentarios_infectologia;
                        $places->tel_vac = $book->tel_vac;
                        $places->mail_vac = $book->mail_vac;
                        $places->horario_vac = $book->horario_vac;
                        $places->responsable_vac = $book->responsable_vac;
                        $places->mail_vac = $book->mail_vac;
                        $places->ubicacion_vac = $book->ubicación_vac;
                        $places->mac = $book->mac;
                        $places->save();

                    } 
                    elseif (!$existeProvincia) //CASO 2, no existe la provincia en la BD
                        {
                            $tmpObject = array(); //manipulo toda la lectura de linea
				
                            $_SESSION['Nuevos']++;
                            
                            array_push($tmpObject,
                                        array(
                                            'status' => 'ADD_NEW',
                                            // 'pais' => ucwords(strtolower($book->name)),
                                            // 'provincia' => ucwords(strtolower($book->author)),
                                            'pais' => $book->pais,
                                            'provincia_region' => $book->provincia_region,
                                            'partido_comuna' => $book->partido_comuna,
                                            'barrio_localidad' => $book->barrio_localidad,
                                            'calle' => $book->calle,
                                            'altura' => $book->altura,
                                            'piso_dpto' => $book->piso_dpto,
                                            'cruce' => $book->cruce,
                                            'tipo' => $book->tipo,
                                            'establecimiento' => $book->establecimiento,
                                            
                                            'latitude' => $latLng[0],
                                            'longitude' => $latLng[1],
                                            'formattedAddress' => $latLng[2],

                                            
                                            'testeo' => $book->testeo,
                                            'tel_testeo' => $book->tel_testeo,
                                            'horario_testeo' => $book->horario_testeo,
                                            'web_testeo' => $book->web_testeo,
                                            'mail_testeo' => $book->mail_testeo,
                                            'responsable_testeo' => $book->responsable_testeo,
                                            'observaciones_testeo' => $book->observaciones_testeo,
                                            
                                            'preservativos' => $book->preservativos,
                                            'tel_distrib' => $book->tel_distrib,
                                            'horario_distrib' => $book->horario_distrib,
                                            'responsable_distrib' => $book->responsable_distrib,
                                            'web_distrib' => $book->web_distrib,
                                            'mail_distrib' => $book->mail_distrib,
                                            'ubicacion_distrib' => $book->ubicación_distrib,
                                            'comentarios_distrib' => $book->comentarios_distrib,
                                            
                                            'vacunatorio' => $book->vacunatorio,
                                            'tel_vac' => $book->tel_vac,
                                            'mail_vac' => $book->mail_vac,
                                            'responsable_vac' => $book->responsable_vac,
                                            
                                            'tel_infectologia' => $book->tel_infectologia,
                                            'mail_infectologia' => $book->mail_infectologia,
                                            'responsable_infectologia' => $book->responsable_infectologia,

                                            'establecimiento' => $book->establecimiento));

                                            //lo agrego al array de nuevos
                            array_push($_SESSION['Nuevos'], $tmpObject);

                            //agrego lo nuevo a la BD, provincia + partido + places

                            //Lo guardo en BD de a 1

                            //PROVINCIA
                            $provincia = new Provincia;
                            $provincia->nombre_provincia = $book->provincia_region;
                            $provincia->idPais = $existePais->id;
                            $provincia->save();

                            //PARTIDO
                            $partido = new Partido;
                            $partido->nombre_partido = $book->partido_comuna;
                            $partido->idPais = $existePais->id;
                            $partido->idProvincia = $provincia->id;
                            $partido->save();

                            //PLACES
                            $places = new Places;
                            $places->idPais = $existePais->id;
                            $places->idProvincia = $provincia->id;
                            $places->idPartido = $partido->id;
                            $places->establecimiento = $book->establecimiento;
                            $places->tipo = $book->tipo;
                            $places->calle = $book->calle;
                            $places->altura = $book->altura;
                            $places->piso_dpto = $book->piso_dpto;
                            $places->cruce = $book->cruce;
                            $places->barrio_localidad = $book->barrio_localidad;
                            $places->formattedAddress = $latLng[2];
                            $places->latitude = $latLng[0];
                            $places->longitude = $latLng[1];
                            $places->habilitado = $book->habilitado;
                            $places->vacunatorio = $book->vacunatorio;
                            $places->infectologia = $book->infectologia;
                            $places->condones = $book->condones;
                            $places->prueba = $book->prueba;
                            $places->tel_testeo = $book->tel_testeo;
                            $places->mail_testeo = $book->mail_testeo;
                            $places->horario_testeo = $book->horario_testeo;
                            $places->responsable_testeo = $book->responsable_testeo;
                            $places->web_testeo = $book->web_testeo;
                            $places->responsable_testeo = $book->responsable_testeo;
                            $places->observaciones_testeo = $book->observaciones_testeo;
                            $places->tel_distrib = $book->tel_distrib;
                            $places->mail_distrib = $book->mail_distrib;
                            $places->horario_distrib = $book->horario_distrib;
                            $places->responsable_distrib = $book->responsable_distrib;
                            $places->web_distrib = $book->web_distrib;
                            $places->ubicacion_distrib = $book->ubicación_distrib;
                            $places->comentarios_distrib = $book->comentarios_distrib;
                            $places->tel_infectologia = $book->tel_infectologia;
                            $places->mail_infectologia = $book->mail_infectologia;
                            $places->horario_infectologia = $book->horario_infectologia;
                            $places->web_infectologia = $book->web_infectologia;
                            $places->comentarios_infectologia = $book->comentarios_infectologia;
                            $places->tel_vac = $book->tel_vac;
                            $places->mail_vac = $book->mail_vac;
                            $places->horario_vac = $book->horario_vac;
                            $places->responsable_vac = $book->responsable_vac;
                            $places->mail_vac = $book->mail_vac;
                            $places->ubicacion_vac = $book->ubicación_vac;
                             $places->mac = $book->mac;
                            $places->save();		

                        } elseif (!$existePartido)  //CASO 3, no existe partido en la BD 
                            {
                                //agrego solamente el partido con los datos de los demas existens
                                $tmpObject = array(); //manipulo toda la lectura de linea
                                
                                $_SESSION['Nuevos']++;
                                
                                array_push($tmpObject,
                                            array(
                                                'status' => 'ADD_NEW',
                                                // 'pais' => ucwords(strtolower($book->name)),
                                                // 'provincia' => ucwords(strtolower($book->author)),
                                                'pais' => $book->pais,
                                                'provincia_region' => $book->provincia_region,
                                                'partido_comuna' => $book->partido_comuna,
                                                'barrio_localidad' => $book->barrio_localidad,
                                                'calle' => $book->calle,
                                                'altura' => $book->altura,
                                                'piso_dpto' => $book->piso_dpto,
                                                'cruce' => $book->cruce,
                                                'tipo' => $book->tipo,
                                                'establecimiento' => $book->establecimiento,
                                                
                                                'latitude' => $latLng[0],
                                                'longitude' => $latLng[1],
                                                'formattedAddress' => $latLng[2],

                                                
                                                'testeo' => $book->testeo,
                                                'tel_testeo' => $book->tel_testeo,
                                                'horario_testeo' => $book->horario_testeo,
                                                'web_testeo' => $book->web_testeo,
                                                'mail_testeo' => $book->mail_testeo,
                                                'responsable_testeo' => $book->responsable_testeo,
                                                'observaciones_testeo' => $book->observaciones_testeo,
                                                
                                                'preservativos' => $book->preservativos,
                                                'tel_distrib' => $book->tel_distrib,
                                                'horario_distrib' => $book->horario_distrib,
                                                'responsable_distrib' => $book->responsable_distrib,
                                                'web_distrib' => $book->web_distrib,
                                                'mail_distrib' => $book->mail_distrib,
                                                'ubicacion_distrib' => $book->ubicación_distrib,
                                                'comentarios_distrib' => $book->comentarios_distrib,
                                                
                                                'vacunatorio' => $book->vacunatorio,
                                                'tel_vac' => $book->tel_vac,
                                                'mail_vac' => $book->mail_vac,
                                                'responsable_vac' => $book->responsable_vac,
                                                
                                                'tel_infectologia' => $book->tel_infectologia,
                                                'mail_infectologia' => $book->mail_infectologia,
                                                'responsable_infectologia' => $book->responsable_infectologia,

                                                'establecimiento' => $book->establecimiento));

                                                //lo agrego al array de nuevos
                                array_push($_SESSION['Nuevos'], $tmpObject);

                                //agrego lo nuevo a la BD,   partido + places
                                //Lo guardo en BD de a 1

                                //PARTIDO
                                $partido = new Partido;
                                $partido->nombre_partido = $book->partido_comuna;
                                $partido->idPais = $existePais->id;
                                $partido->idProvincia = $existeProvincia->id;
                                $partido->save();

                                //PLACES
                                $places = new Places;
                                $places->idPais = $existePais->id;
                                $places->idProvincia = $existeProvincia->id;
                                $places->idPartido = $partido->id;
                                $places->establecimiento = $book->establecimiento;
                                $places->tipo = $book->tipo;
                                $places->calle = $book->calle;
                                $places->altura = $book->altura;
                                $places->piso_dpto = $book->piso_dpto;
                                $places->cruce = $book->cruce;
                                $places->barrio_localidad = $book->barrio_localidad;
                                $places->formattedAddress = $latLng[2];
                                $places->latitude = $latLng[0];
                                $places->longitude = $latLng[1];
                                $places->habilitado = $book->habilitado;
                                $places->vacunatorio = $book->vacunatorio;
                                $places->infectologia = $book->infectologia;
                                $places->condones = $book->condones;
                                $places->prueba = $book->prueba;
                                $places->tel_testeo = $book->tel_testeo;
                                $places->mail_testeo = $book->mail_testeo;
                                $places->horario_testeo = $book->horario_testeo;
                                $places->responsable_testeo = $book->responsable_testeo;
                                $places->web_testeo = $book->web_testeo;
                                $places->responsable_testeo = $book->responsable_testeo;
                                $places->observaciones_testeo = $book->observaciones_testeo;
                                $places->tel_distrib = $book->tel_distrib;
                                $places->mail_distrib = $book->mail_distrib;
                                $places->horario_distrib = $book->horario_distrib;
                                $places->responsable_distrib = $book->responsable_distrib;
                                $places->web_distrib = $book->web_distrib;
                                $places->ubicacion_distrib = $book->ubicación_distrib;
                                $places->comentarios_distrib = $book->comentarios_distrib;
                                $places->tel_infectologia = $book->tel_infectologia;
                                $places->mail_infectologia = $book->mail_infectologia;
                                $places->horario_infectologia = $book->horario_infectologia;
                                $places->web_infectologia = $book->web_infectologia;
                                $places->comentarios_infectologia = $book->comentarios_infectologia;
                                $places->tel_vac = $book->tel_vac;
                                $places->mail_vac = $book->mail_vac;
                                $places->horario_vac = $book->horario_vac;
                                $places->responsable_vac = $book->responsable_vac;
                                $places->mail_vac = $book->mail_vac;
                                $places->ubicacion_vac = $book->ubicación_vac;
                                 $places->mac = $book->mac;
                                $places->save();

                            } elseif (!$existePlace) //CASO 4, exite todo en la BD, sola queda comp LAT y Lng en la bd con el generado
                            {
                                $tmpObject = array(); //manipulo toda la lectura de linea
						
                                $_SESSION['Nuevos']++;
                                
                                array_push($tmpObject,
                                            array(
                                                'status' => 'ADD_NEW',
                                                // 'pais' => ucwords(strtolower($book->name)),
                                                // 'provincia' => ucwords(strtolower($book->author)),
                                                'pais' => $book->pais,
                                                'provincia_region' => $book->provincia_region,
                                                'partido_comuna' => $book->partido_comuna,
                                                'barrio_localidad' => $book->barrio_localidad,
                                                'calle' => $book->calle,
                                                'altura' => $book->altura,
                                                'piso_dpto' => $book->piso_dpto,
                                                'cruce' => $book->cruce,
                                                'tipo' => $book->tipo,
                                                'establecimiento' => $book->establecimiento,
                                                
                                                'latitude' => $latLng[0],
                                                'longitude' => $latLng[1],
                                                'formattedAddress' => $latLng[2],

                                                
                                                'testeo' => $book->testeo,
                                                'tel_testeo' => $book->tel_testeo,
                                                'horario_testeo' => $book->horario_testeo,
                                                'web_testeo' => $book->web_testeo,
                                                'mail_testeo' => $book->mail_testeo,
                                                'responsable_testeo' => $book->responsable_testeo,
                                                'observaciones_testeo' => $book->observaciones_testeo,
                                                
                                                'preservativos' => $book->preservativos,
                                                'tel_distrib' => $book->tel_distrib,
                                                'horario_distrib' => $book->horario_distrib,
                                                'responsable_distrib' => $book->responsable_distrib,
                                                'web_distrib' => $book->web_distrib,
                                                'mail_distrib' => $book->mail_distrib,
                                                'ubicacion_distrib' => $book->ubicación_distrib,
                                                'comentarios_distrib' => $book->comentarios_distrib,
                                                
                                                'vacunatorio' => $book->vacunatorio,
                                                'tel_vac' => $book->tel_vac,
                                                'mail_vac' => $book->mail_vac,
                                                'responsable_vac' => $book->responsable_vac,
                                                
                                                'tel_infectologia' => $book->tel_infectologia,
                                                'mail_infectologia' => $book->mail_infectologia,
                                                'responsable_infectologia' => $book->responsable_infectologia,

                                                'establecimiento' => $book->establecimiento));

                                                //lo agrego al array de nuevos
                                array_push($_SESSION['Nuevos'], $tmpObject);

                                //agrego lo nuevo a la BD  places
                                
                                //PLACES
                                $places = new Places;
                                $places->idPais = $existePais->id;
                                $places->idProvincia = $existeProvincia->id;
                                $places->idPartido = $existePartido->id;
                                $places->establecimiento = $book->establecimiento;
                                $places->tipo = $book->tipo;
                                $places->calle = $book->calle;
                                $places->altura = $book->altura;
                                $places->piso_dpto = $book->piso_dpto;
                                $places->cruce = $book->cruce;
                                $places->barrio_localidad = $book->barrio_localidad;
                                $places->formattedAddress = $latLng[2];
                                $places->latitude = $latLng[0];
                                $places->longitude = $latLng[1];
                                $places->habilitado = $book->habilitado;
                                $places->vacunatorio = $book->vacunatorio;
                                $places->infectologia = $book->infectologia;
                                $places->condones = $book->condones;
                                $places->prueba = $book->prueba;
                                $places->tel_testeo = $book->tel_testeo;
                                $places->mail_testeo = $book->mail_testeo;
                                $places->horario_testeo = $book->horario_testeo;
                                $places->responsable_testeo = $book->responsable_testeo;
                                $places->web_testeo = $book->web_testeo;
                                $places->responsable_testeo = $book->responsable_testeo;
                                $places->observaciones_testeo = $book->observaciones_testeo;
                                $places->tel_distrib = $book->tel_distrib;
                                $places->mail_distrib = $book->mail_distrib;
                                $places->horario_distrib = $book->horario_distrib;
                                $places->responsable_distrib = $book->responsable_distrib;
                                $places->web_distrib = $book->web_distrib;
                                $places->ubicacion_distrib = $book->ubicación_distrib;
                                $places->comentarios_distrib = $book->comentarios_distrib;
                                $places->tel_infectologia = $book->tel_infectologia;
                                $places->mail_infectologia = $book->mail_infectologia;
                                $places->horario_infectologia = $book->horario_infectologia;
                                $places->web_infectologia = $book->web_infectologia;
                                $places->comentarios_infectologia = $book->comentarios_infectologia;
                                $places->tel_vac = $book->tel_vac;
                                $places->mail_vac = $book->mail_vac;
                                $places->horario_vac = $book->horario_vac;
                                $places->responsable_vac = $book->responsable_vac;
                                $places->mail_vac = $book->mail_vac;
                                $places->ubicacion_vac = $book->ubicación_vac;
                                 $places->mac = $book->mac;
                                $places->save();
                            }else
                        	{ //si llega hasta aca, es xq paso x todos y es repetid
                            $_SESSION['CantidadRepetidos']++;
                            
                            $tmpObject = array(); //manipulo toda la lectura de linea
                                                
                                array_push($tmpObject,
                                            array(
                                                'status' => 'ADD_REPITED',
                                                // 'pais' => ucwords(strtolower($book->name)),
                                                // 'provincia' => ucwords(strtolower($book->author)),
                                                'pais' => $book->pais,
                                                'provincia_region' => $book->provincia_region,
                                                'partido_comuna' => $book->partido_comuna,
                                                'barrio_localidad' => $book->barrio_localidad,
                                                'calle' => $book->calle,
                                                'altura' => $book->altura,
                                                'piso_dpto' => $book->piso_dpto,
                                                'cruce' => $book->cruce,
                                                'tipo' => $book->tipo,
                                                'establecimiento' => $book->establecimiento,
                                                
                                                'latitude' => $latLng[0],
                                                'longitude' => $latLng[1],
                                                'formattedAddress' => $latLng[2],

                                                
                                                'testeo' => $book->testeo,
                                                'tel_testeo' => $book->tel_testeo,
                                                'horario_testeo' => $book->horario_testeo,
                                                'web_testeo' => $book->web_testeo,
                                                'mail_testeo' => $book->mail_testeo,
                                                'responsable_testeo' => $book->responsable_testeo,
                                                'observaciones_testeo' => $book->observaciones_testeo,
                                                
                                                'preservativos' => $book->preservativos,
                                                'tel_distrib' => $book->tel_distrib,
                                                'horario_distrib' => $book->horario_distrib,
                                                'responsable_distrib' => $book->responsable_distrib,
                                                'web_distrib' => $book->web_distrib,
                                                'mail_distrib' => $book->mail_distrib,
                                                'ubicacion_distrib' => $book->ubicación_distrib,
                                                'comentarios_distrib' => $book->comentarios_distrib,
                                                
                                                'vacunatorio' => $book->vacunatorio,
                                                'tel_vac' => $book->tel_vac,
                                                'mail_vac' => $book->mail_vac,
                                                'responsable_vac' => $book->responsable_vac,
                                                
                                                'tel_infectologia' => $book->tel_infectologia,
                                                'mail_infectologia' => $book->mail_infectologia,
                                                'responsable_infectologia' => $book->responsable_infectologia,

                                                'establecimiento' => $book->establecimiento));

                                                //lo agrego al array de nuevos
                                array_push($_SESSION['Repetidos'], $tmpObject);
                        }
                    }
                    else
                     // este es del si pudo geoLocalizarlo.
                        //esto seria de arriba de todo, si no se pudo geolocalizar x algun motivo (conf baja)
                        $_SESSION['CantidadDescartados']++;

                $next = new ImportadorController();	
                $next->filtroImportar($_SESSION);     
            }
        });
    }
//==============================================================================================================

//==============================================================================================================

	public function filtroImportar($data){
		$Nuevos = $data['Nuevos'];
		$Repetidos = $data['Repetidos'];
		$CantidadNuevos = $data['CantidadNuevos'];
		$CantidadRepetidos = $data['CantidadRepetidos'];
		$CantidadDescartados = $data['CantidadDescartados'];

		$resu = array();
		array_push($resu,$Nuevos);
		array_push($resu,$Repetidos);
		array_push($resu,$CantidadNuevos);
		array_push($resu,$CantidadRepetidos);
		array_push($resu,$CantidadDescartados);		

		// foreach ($Repetidos as $key => $value) {
		// 		return($value[0]);
		// }
    	return response()->json($resu);
    
    }

//==============================================================================================================

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
