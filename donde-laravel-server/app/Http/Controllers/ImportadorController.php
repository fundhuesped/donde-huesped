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

use Session;
use Image;
use ImageServiceProvider;   

use SplTempFileObject;
use SplFileObject;

class ImportadorController extends Controller {

	public function exportNuevos(Request $request){
		$datosNuevos = 0;
		if (session('datosNuevos') != null)		
			$datosNuevos = session('datosNuevos');
		
		$csv = Writer::createFromFileObject(new SplTempFileObject());

		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac');

        //body
        foreach ($datosNuevos as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);

        	$csv->insertOne([
	        	$p['establecimiento'],
	        	$p['tipo'],
	        	$p['calle'],
	        	$p['altura'],
				$p['piso_dpto'],
				$p['cruce'],
				$p['barrio_localidad'],
				$p['partido_comuna'],
				$p['provincia_region'],
				$p['pais'],
				$p['aprobado'],//	
				$p['observacion'],
				$p['formattedAddress'],
				$p['latitude'],
				$p['longitude'],
				$p['habilitado'],

				$p['condones'],
				$p['prueba'],
				$p['vacunatorio'],
				$p['infectologia'],
				$p['mac'],
				
				$p['tel_testeo'],
				$p['mail_testeo'],
				$p['horario_testeo'],
				$p['responsable_testeo'],
				$p['web_testeo'],
				$p['ubicacion_testeo'],
				$p['observaciones_testeo'],
				
				$p['tel_distrib'],
				$p['mail_distrib'],
				$p['horario_distrib'],
				$p['responsable_distrib'],
				$p['web_distrib'],
				$p['ubicacion_distrib'],
				$p['comentarios_distrib'],
				
				$p['tel_infectologia'],
				$p['mail_infectologia'],
				$p['horario_infectologia'],
				$p['responsable_infectologia'],
				$p['web_infectologia'],
				$p['ubicacion_infectologia'],
				$p['comentarios_infectologia'],
				
				$p['tel_vac'],
				$p['mail_vac'],
				$p['horario_vac'],
				$p['responsable_vac'],
				$p['web_vac'],
				$p['ubicacion_vac'],
				$p['comentarios_vac'] 
			]);
        
        }

        //descarga
        $csv->output('huspedDatosNuevos.csv');

	}
	public function exportReptidos(Request $request){
		$datosRepetidos = 0;
		if (session('datosRepetidos') != null)		
			$datosRepetidos = session('datosRepetidos');
		
		$csv = Writer::createFromFileObject(new SplTempFileObject());

		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac');

        //body
        foreach ($datosRepetidos as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);

        	$csv->insertOne([
	        	$p['establecimiento'],
	        	$p['tipo'],
	        	$p['calle'],
	        	$p['altura'],
				$p['piso_dpto'],
				$p['cruce'],
				$p['barrio_localidad'],
				$p['partido_comuna'],
				$p['provincia_region'],
				$p['pais'],
				$p['aprobado'],//	
				$p['observacion'],
				$p['formattedAddress'],
				$p['latitude'],
				$p['longitude'],
				$p['habilitado'],

				$p['condones'],
				$p['prueba'],
				$p['vacunatorio'],
				$p['infectologia'],
				$p['mac'],
				
				$p['tel_testeo'],
				$p['mail_testeo'],
				$p['horario_testeo'],
				$p['responsable_testeo'],
				$p['web_testeo'],
				$p['ubicacion_testeo'],
				$p['observaciones_testeo'],
				
				$p['tel_distrib'],
				$p['mail_distrib'],
				$p['horario_distrib'],
				$p['responsable_distrib'],
				$p['web_distrib'],
				$p['ubicacion_distrib'],
				$p['comentarios_distrib'],
				
				$p['tel_infectologia'],
				$p['mail_infectologia'],
				$p['horario_infectologia'],
				$p['responsable_infectologia'],
				$p['web_infectologia'],
				$p['ubicacion_infectologia'],
				$p['comentarios_infectologia'],
				
				$p['tel_vac'],
				$p['mail_vac'],
				$p['horario_vac'],
				$p['responsable_vac'],
				$p['web_vac'],
				$p['ubicacion_vac'],
				$p['comentarios_vac'] 
			]);
        
        }

        //descarga
        $csv->output('huspedDatosRepetidos.csv');
	}
	public function exportInompletos(Request $request){
		$datosIncompletos = 0;
		if (session('datosIncompletos') != null)		
			$datosIncompletos = session('datosIncompletos');
		

		$csv = Writer::createFromFileObject(new SplTempFileObject());

		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac');

        //body
        foreach ($datosIncompletos as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);

        	$csv->insertOne([
	        	$p['establecimiento'],
	        	$p['tipo'],
	        	$p['calle'],
	        	$p['altura'],
				$p['piso_dpto'],
				$p['cruce'],
				$p['barrio_localidad'],
				$p['partido_comuna'],
				$p['provincia_region'],
				$p['pais'],
				$p['aprobado'],//	
				$p['observacion'],
				$p['formattedAddress'],
				$p['latitude'],
				$p['longitude'],
				$p['habilitado'],

				$p['condones'],
				$p['prueba'],
				$p['vacunatorio'],
				$p['infectologia'],
				$p['mac'],
				
				$p['tel_testeo'],
				$p['mail_testeo'],
				$p['horario_testeo'],
				$p['responsable_testeo'],
				$p['web_testeo'],
				$p['ubicacion_testeo'],
				$p['observaciones_testeo'],
				
				$p['tel_distrib'],
				$p['mail_distrib'],
				$p['horario_distrib'],
				$p['responsable_distrib'],
				$p['web_distrib'],
				$p['ubicacion_distrib'],
				$p['comentarios_distrib'],
				
				$p['tel_infectologia'],
				$p['mail_infectologia'],
				$p['horario_infectologia'],
				$p['responsable_infectologia'],
				$p['web_infectologia'],
				$p['ubicacion_infectologia'],
				$p['comentarios_infectologia'],
				
				$p['tel_vac'],
				$p['mail_vac'],
				$p['horario_vac'],
				$p['responsable_vac'],
				$p['web_vac'],
				$p['ubicacion_vac'],
				$p['comentarios_vac'] 
			]);
        
        }

        //descarga
        $csv->output('huspedDatosIncompletos.csv');
	}
	public function exportUnificar(Request $request){
		$datosUnificar = 0;
		if (session('datosUnificar') != null)		
			$datosUnificar = session('datosUnificar');
		
		$csv = Writer::createFromFileObject(new SplTempFileObject());

		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac');

        //body
        foreach ($datosUnificar as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);

        	$csv->insertOne([
	        	$p['establecimiento'],
	        	$p['tipo'],
	        	$p['calle'],
	        	$p['altura'],
				$p['piso_dpto'],
				$p['cruce'],
				$p['barrio_localidad'],
				$p['partido_comuna'],
				$p['provincia_region'],
				$p['pais'],
				$p['aprobado'],//	
				$p['observacion'],
				$p['formattedAddress'],
				$p['latitude'],
				$p['longitude'],
				$p['habilitado'],

				$p['condones'],
				$p['prueba'],
				$p['vacunatorio'],
				$p['infectologia'],
				$p['mac'],
				
				$p['tel_testeo'],
				$p['mail_testeo'],
				$p['horario_testeo'],
				$p['responsable_testeo'],
				$p['web_testeo'],
				$p['ubicacion_testeo'],
				$p['observaciones_testeo'],
				
				$p['tel_distrib'],
				$p['mail_distrib'],
				$p['horario_distrib'],
				$p['responsable_distrib'],
				$p['web_distrib'],
				$p['ubicacion_distrib'],
				$p['comentarios_distrib'],
				
				$p['tel_infectologia'],
				$p['mail_infectologia'],
				$p['horario_infectologia'],
				$p['responsable_infectologia'],
				$p['web_infectologia'],
				$p['ubicacion_infectologia'],
				$p['comentarios_infectologia'],
				
				$p['tel_vac'],
				$p['mail_vac'],
				$p['horario_vac'],
				$p['responsable_vac'],
				$p['web_vac'],
				$p['ubicacion_vac'],
				$p['comentarios_vac'] 
			]);
        
        }

        //descarga
        $csv->output('huspedDatosUnificar.csv');
	}

	public function exportBC(Request $request){
		$datosDescartados = 0;
		if (session('datosDescartados') != null)		
			$datosDescartados = session('datosDescartados');
		
		$csv = Writer::createFromFileObject(new SplTempFileObject());

		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac');
        
        //body
        foreach ($datosDescartados as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);
        	
        	// if (!isset())

        	$csv->insertOne([
	        	$p['establecimiento'],
	        	$p['tipo'],
	        	$p['calle'],
	        	$p['altura'],
				$p['piso_dpto'],
				$p['cruce'],
				$p['barrio_localidad'],
				$p['partido_comuna'],
				$p['provincia_region'],
				$p['pais'],
				$p['aprobado'],//	
				$p['observacion'],
				$p['formattedAddress'],
				$p['latitude'],
				$p['longitude'],
				$p['habilitado'],

				$p['condones'],
				$p['prueba'],
				$p['vacunatorio'],
				$p['infectologia'],
				$p['mac'],
				
				$p['tel_testeo'],
				$p['mail_testeo'],
				$p['horario_testeo'],
				$p['responsable_testeo'],
				$p['web_testeo'],
				$p['ubicacion_testeo'],
				$p['observaciones_testeo'],
				
				$p['tel_distrib'],
				$p['mail_distrib'],
				$p['horario_distrib'],
				$p['responsable_distrib'],
				$p['web_distrib'],
				$p['ubicacion_distrib'],
				$p['comentarios_distrib'],
				
				$p['tel_infectologia'],
				$p['mail_infectologia'],
				$p['horario_infectologia'],
				$p['responsable_infectologia'],
				$p['web_infectologia'],
				$p['ubicacion_infectologia'],
				$p['comentarios_infectologia'],
				
				$p['tel_vac'],
				$p['mail_vac'],
				$p['horario_vac'],
				$p['responsable_vac'],
				$p['web_vac'],
				$p['ubicacion_vac'],
				$p['comentarios_vac'] 
			]);
        
        }

        //descarga
        $csv->output('huspedDatosBajaConf.csv');
	}

	public function index()
	{
		return view('panel.importer.index');
	}

	public function picker() //llamo a la vista
	{
		return view('panel.importer.picker');
	}
	

	public function parseToExport($string){
		if ($string == 1)  {
			$string = "SI"; 
		}
		else{
			$string = "NO"; 
		}

		return $string;
	}

	public function parseToImport($string){
		if ( $string == "SI")  {
			$string = 1; 
		}
		else{
			$string = 0; 
		}

		return $string;
	}	


//==============================================================================================================

	public function exportar(){ //en base a una tabla, creo un CVS.

        $places = DB::table('places')
        	->join('pais','pais.id','=','places.idPais')
        	->join('provincia','provincia.id','=','places.idProvincia')
        	->join('partido','partido.id','=','places.idPartido')
        	->get();

		$csv = Writer::createFromFileObject(new SplTempFileObject());


        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac');
	               
        foreach ($places as $p) {
        $p = (array)$p;


		$p['condones']= $this->parseToExport($p['condones']);
		$p['prueba']= $this->parseToExport($p['prueba']);
		$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
		$p['infectologia']= $this->parseToExport($p['infectologia']);
		$p['mac']= $this->parseToExport($p['mac']);

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
			$p['aprobado'],//	
			$p['observacion'],
			$p['formattedAddress'],
			$p['latitude'],
			$p['longitude'],
			$p['habilitado'],

			$p['condones'],
			$p['prueba'],
			$p['vacunatorio'],
			$p['infectologia'],
			$p['mac'],
			
			$p['tel_testeo'],
			$p['mail_testeo'],
			$p['horario_testeo'],
			$p['responsable_testeo'],
			$p['web_testeo'],
			$p['ubicacion_testeo'],
			$p['observaciones_testeo'],
			
			$p['tel_distrib'],
			$p['mail_distrib'],
			$p['horario_distrib'],
			$p['responsable_distrib'],
			$p['web_distrib'],
			$p['ubicacion_distrib'],
			$p['comentarios_distrib'],
			
			$p['tel_infectologia'],
			$p['mail_infectologia'],
			$p['horario_infectologia'],
			$p['responsable_infectologia'],
			$p['web_infectologia'],
			$p['ubicacion_infectologia'],
			$p['comentarios_infectologia'],
			
			$p['tel_vac'],
			$p['mail_vac'],
			$p['horario_vac'],
			$p['responsable_vac'],
			$p['web_vac'],
			$p['ubicacion_vac'],
			$p['comentarios_vac'] 
			]);
        }

        $csv->output('husped.csv');
	}
//==============================================================================================================
public function get_numeric_score($data) {
	switch($data){
	        case "ROOFTOP":
	            return 9;
	        break;

	        case "RANGE_INTERPOLATED":
	            return 7;
	        break;

	        case "GEOMETRIC_CENTER":
	            return 6;
	        break;

	        case "APPROXIMATE":
	            return 4;
	        break;

	        default:
	            return 0;
	    }
}
function elimina_acentos($text)
    {
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',
 
            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',
 
            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',
 
            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',
 
            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',
 
            // Agregar aqui mas caracteres si es necesario
 
        );
 
        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }
//==============================================================================================================
	// function to geocode address, it will return false if unable to geocode address
public function geocode($address){
	$basicString = $this->elimina_acentos($address);
	// $basicString = $this->elimina_acentos("Avenida Rivadavia 2057, Campana, Buenos Aires");
	// $basicString = $this->elimina_acentos("Balvanera - Av. Rivadavia 2057, Buenos Aires, Ciudad Autónoma de Buenos Aires");
	// $basicString = $this->elimina_acentos("españa 577 parana entre rios argentina");
	// $basicString = $this->elimina_acentos("alberdi 46 Mendoza, Argentina");
    // url encode the address
  
    // $address = urlencode($address); 
    $address = urlencode($basicString); 
    // $address2 = urlencode("argentina entre rios dimante parana"); 

    
    // google map geocode api url
    $url = "https://maps.google.com.ar/maps/api/geocode/json?key=AIzaSyACdNTXGb7gdYwlhXegObZj8bvWtr-Sozc&address={$address}";
	
 	
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);

    $location = json_decode($resp_json);
    // echo $address;
    // var_dump($location);
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
					    $geoResults = [];
						foreach($location->results as $result){
						    $geoResult = [];    
						    if ($location->status == "OK"){
						    	foreach ($result->address_components as $address) {
							        if ($address->types[0] == 'country') {
							            $geoResult['country'] = $address->long_name;
							        }
							        if ($address->types[0] == 'administrative_area_level_1') {
							            $geoResult['state'] = $address->long_name;
							        }
							        if ($address->types[0] == 'administrative_area_level_1') {
							            $geoResult['esCABA'] = $address->short_name;
							        }
							        if ($address->types[0] == 'administrative_area_level_2') {
							            $geoResult['partido'] = $address->long_name;
							        }
							        if ($address->types[0] == 'political') {
							            $geoResult['county'] = $address->long_name;  //barrio_localidad
							        }							        
							        if ($address->types[0] == 'locality') {  		//barrio_localidad (CABA), ciudad (Entre rios)
							            $geoResult['city'] = $address->long_name;
							        }
							        if ($address->types[0] == 'postal_code') {
							            $geoResult['postal_code'] = $address->long_name;
							        }       
							        if ($address->types[0] == 'route') {
							            $geoResult['route'] = $address->short_name;
							        }
							        if ($address->types[0] == 'street_number') {
							            $geoResult['street_number'] = $address->long_name;
							        }

						        $geoResult['lati'] = $result->geometry->location->lat;
						        $geoResult['longi'] = $result->geometry->location->lng;
						        $geoResult['formatted_address'] = $resp['results'][0]['formatted_address'];
						        $geoResult['accurracy'] = $this->get_numeric_score($result->geometry->location_type);       
						    	}
						    }
						    if ($geoResult['esCABA'] == "CABA" && isset($geoResult['county']))
						    	$geoResult['city'] = $geoResult['county'];
						    if ($geoResult['esCABA'] != "CABA" && !isset($geoResult['county']))
						    	$geoResult['county'] =$geoResult['city'];
						    // dd($geoResult);
						    $geoResults = $geoResult;
						} 
						//jona
					$faltaAlgo = false;
					if (!isset($latLng['route'])) $resultado = true;
					if (!isset($latLng['partido'])) $resultado = true;
					if (!isset($latLng['city'])) $resultado = true;
					// if (!isset($latLng['county'])) $resultado = true;
					if ($faltaAlgo) 
						return false;
					else
						return $geoResults;
					}
  //       // get the important data
  //       $lati = $resp['results'][0]['geometry']['location']['lat'];
  //       $longi = $resp['results'][0]['geometry']['location']['lng'];
  //       $formatted_address = $resp['results'][0]['formatted_address'];
		// $accurracy = $this->get_numeric_score($resp['results'][0]['geometry']['location_type']);
	
	 //    // verify if data is complete
  //       if($lati && $longi && $formatted_address && $formatted_address && $accurracy){
         
  //           // put the data in the array
  //           $data_arr = array();            
             
  //           array_push($data_arr, 
		// 	                $lati, 
		// 	                $longi, 
		// 	                $formatted_address,
		// 	                $accurracy
  //               		);

  //           return $data_arr;
             
  //       }

        else{
            return false;
        }
         
    // }else{
    //     return false;
    // }
}

public function esRepetido($book,$latLng){
	$resultado = false;

	$existePlace = DB::table('places')
    	->join('pais','pais.id','=','places.idPais')
    	->join('provincia','provincia.id','=','places.idProvincia')
        ->join('partido','partido.id','=','places.idPartido')
			->where('places.establecimiento','=', $book->establecimiento)
			->where('places.tipo','=', $book->tipo)
			->where('places.calle','=', $latLng['route']) 
			->where('places.altura','=', $book->altura) 
			->where('places.piso_dpto','=', $book->piso_dpto)
			->where('places.cruce','=', $book->cruce)
			->where('places.barrio_localidad','=', $latLng['city']) // no usar debdio a google maps (almagro, etc)
			->where('partido.nombre_partido', '=', $latLng['partido']) // comuna 1,2,3,4
			->where('provincia.nombre_provincia', '=', $latLng['state']) // caba
			->where('pais.nombre_pais', '=', $latLng['country'])
			->where('places.aprobado','=', $book->aprobado)
			->where('places.observacion','=', $book->observacion)
			->where('places.habilitado','=', $book->habilitado)

			->where('places.condones','=', $book->condones)
			->where('places.prueba','=', $book->prueba)
			->where('places.vacunatorio','=', $book->vacunatorio)
			->where('places.infectologia','=', $book->infectologia)
			->where('places.mac','=', $book->mac)
			

			->where('places.tel_testeo','=', $book->tel_testeo)
			->where('places.mail_testeo','=', $book->mail_testeo)

			->where('places.horario_testeo','=', $book->horario_testeo)
			->where('places.responsable_testeo','=', $book->responsable_testeo)
			->where('places.web_testeo','=', $book->web_testeo)
			->where('places.ubicacion_testeo','=', $book->ubicacion_testeo)
			->where('places.observaciones_testeo','=', $book->observaciones_testeo)

			->where('places.tel_distrib','=', $book->tel_distrib)
			->where('places.mail_distrib','=', $book->mail_distrib)
			->where('places.horario_distrib','=', $book->horario_distrib)
			->where('places.responsable_distrib','=', $book->responsable_distrib)
			->where('places.web_distrib','=', $book->web_distrib)
			->where('places.ubicacion_distrib','=', $book->ubicacion_distrib)
			->where('places.comentarios_distrib','=', $book->comentarios_distrib)

			->where('places.tel_infectologia','=', $book->tel_infectologia)
			->where('places.mail_infectologia','=', $book->mail_infectologia)
			->where('places.horario_infectologia','=', $book->horario_infectologia)
			->where('places.responsable_infectologia','=', $book->responsable_infectologia)
			->where('places.web_infectologia','=', $book->web_infectologia)
			->where('places.ubicacion_infectologia','=', $book->ubicacion_infectologia)
			->where('places.comentarios_infectologia','=', $book->comentarios_infectologia)

			->where('places.tel_vac','=', $book->tel_vac)
			->where('places.mail_vac','=', $book->mail_vac)
			->where('places.horario_vac','=', $book->horario_vac)
			->where('places.responsable_vac','=', $book->responsable_vac)
			->where('places.web_vac','=', $book->web_vac)
			->where('places.ubicacion_vac','=', $book->ubicacion_vac)
			->where('places.comentarios_vac','=', $book->comentarios_vac)
			->select('partido.nombre_partido')
			->first();

	    if ($existePlace)
	    	$resultado = true;

	

	// $arrayName = array( //  statem ccounty partido city 
	// 	'latLngCalle' => $latLng['route'],
	// 	'bookCalle' => $book->calle,
	// 	'resultado' => ($latLng['route'] == $book->calle ),

	// 	'latLngPais' => $latLng['country'],
	// 	'bookP2' => $book->pais,
	// 	'resultado2' => ($latLng['country'] == $book->pais ),

	// 	'latLngPartido' => $latLng['partido'],
	// 	'bookPartido_comuna' => $book->partido_comuna,
	// 	'resultado3' => ($latLng['partido'] == $book->partido_comuna ),

	// 	'latLngCounty' => $latLng['city'],
	// 	'bookBarrioLocalidad' => $book->barrio_localidad,
	// 	'resultado4' => ($latLng['city'] == $book->barrio_localidad ),

	// 	'latLngProv' => $latLng['state'],
	// 	'bookProvincia_region' => $book->provincia_region,
	// 	'state' => ($latLng['state'] == $book->provincia_region ),

	// 	'condones' => $book->condones,
	// 	'prueba' => $book->prueba,
	// 	'vacunatorio' => $book->vacunatorio,
	// 	'infectologia' => $book->infectologia,
	// 	'mac' => $book->mac,
		
	// 	'resultadoFinal' => $existePlace
	// 	 );




// dd($latLng);
// 	dd($arrayName);	
// 	dd($resultado);
		return $resultado;

}

public function esIncompleto($book){
	$resultado = false;
	if ( 
		(is_null($book->establecimiento)) ||
		(is_null($book->calle)) ||
		(is_null($book->pais)) ||
		(is_null($book->provincia_region)) ||
		(is_null($book->partido_comuna))
		){
		$resultado = true;
	}
    return $resultado;
}

public function esUnificable($book,$latLng){ 
//LOGICA --> !esRepetido, y coincide con todos los datos MENOS los servicios
	$resultado = false;

    $existePlace = DB::table('places')
    	->join('pais','pais.id','=','places.idPais')
    	->join('provincia','provincia.id','=','places.idProvincia')
        ->join('partido','partido.id','=','places.idProvincia')
			->where('places.establecimiento','=', $book->establecimiento)
			->where('places.tipo','=', $book->tipo)
			->where('places.calle','=', $latLng['route'])
			->where('places.altura','=', $book->altura)
			->where('places.piso_dpto','=', $book->piso_dpto)
			->where('places.cruce','=', $book->cruce)//este rompe con 
			->where('places.barrio_localidad','=', $latLng['city']) // no usar debdio a google maps (almagro, etc)
			->where('provincia.nombre_provincia', '=', $latLng['state']) // caba
			->where('partido.nombre_partido', '=', $latLng['partido']) // comuna 1,2,3,4
			->where('pais.nombre_pais', '=', $latLng['country'])
			->where('places.aprobado','=', $book->aprobado)
			->where('places.observacion','=', $book->observacion)
			->where('places.habilitado','=', $book->habilitado)
			->first();

		if ( (!$this->esRepetido($book,$latLng)) && ($existePlace) )
			$resultado = true;

    return $resultado;
}
public function esBajaConfianza($book,$latLng){ 
//LOGICA --> si no se puede geolocalizar o la acurracy es baja   ( ver )
	$resultado = false;
	$faltaAlgo = false;
	if (!isset($latLng['route'])) $resultado = true;
	if (!isset($latLng['partido'])) $resultado = true;
	if (!isset($latLng['city'])) $resultado = true;

	if ($latLng == false)
		$resultado = true;

    return $resultado;
}

public function esNuevo($book,$latLng){ 
//LOGICA --> si no es ninguna de las otras opciones
	
	$resultado = false;
	if ( (!$this->esRepetido($book,$latLng)) && (!$this->esUnificable($book,$latLng)) && (!$this->esIncompleto($book)) && (!$this->esBajaConfianza($book,$latLng)))
			$resultado = true;

    return $resultado;
}

//=================================================================================================================
//=================================================================================================================
//	RUTA PREVIEW, VISUALIZO LOS NUEVOS DATOS
//=================================================================================================================
//=================================================================================================================

public function preAdd(Request $request) {
// session(['datosNuevos' => array()]); //usando el helper
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
				$address = $book->calle;
				$address = $address.' '.$book->altura;				
				if ($book->partido_comuna != $book->barrio_localidad)
					$address = $address.' '.$book->barrio_localidad;
				$address = $address.' '.$book->partido_comuna;
				$address = $address.' '.$book->provincia_region;
				$address = $address.' '.$book->pais;
				
				
				if($this->esIncompleto($book))
					continue; //ver aca
				else{           
						//verificar como queda formado address para ver si es localizable
			            $latLng = new ImportadorController();	
			            $latLng = $latLng->geocode($address); // [lati,longi,formatted_address]		            

			            if ($latLng){
			            //si se puede localizar arranca la joda de las bds
			                $existePais = DB::table('pais')
			                    ->where('pais.nombre_pais', '=',$latLng['country'])
			                    ->first();
			                    
			                    
			                $existeProvincia = DB::table('provincia')
			                    ->join('pais','pais.id','=','provincia.idPais')
			                    ->where('pais.nombre_pais', '=',$latLng['country'])
			                    ->where('provincia.nombre_provincia', '=', $latLng['state'])
			                    ->first();
			                if (!isset($latLng['partido'])) $latLng['partido'] = '';
			                $existePartido = DB::table('partido')
			                	->join('provincia','provincia.id','=','partido.idProvincia')
			                	->join('pais','pais.id','=','partido.idPais')
			                    ->where('pais.nombre_pais', '=', $latLng['country'])
			                    ->where('provincia.nombre_provincia', '=', $latLng['state'])
			                    ->where('partido.nombre_partido', '=', $latLng['partido'])
			                    ->first();
			                
			                if (!isset($latLng['route'])) $latLng['route'] = '';

			                $existePlace = DB::table('places')
			                	->join('pais','pais.id','=','places.idPais')
			                	->join('provincia','provincia.id','=','places.idProvincia')
			                    ->join('partido','partido.id','=','places.idProvincia')
			                    ->where('places.establecimiento', 'like', '%' .$book->establecimiento.'%')
			                    ->where('places.tipo', 'like', '%' .$book->tipo.'%')
			                    ->where('places.calle', '=',$latLng['route'])
			                    ->where('places.altura', 'like', '%' .$book->altura.'%')
			                    ->where('places.piso_dpto', 'like', '%' .$book->piso_dpto.'%')
			                    ->where('places.cruce', 'like', '%' .$book->cruce.'%')
			                    ->where('places.latitude', '=', $latLng['lati'])
			                    ->where('places.longitude', '=', $latLng['longi'])
			                    ->where('pais.nombre_pais', '=', $latLng['country'])
			                    ->where('provincia.nombre_provincia', '=', $latLng['state'])
			                    ->where('partido.nombre_partido', '=', $latLng['partido'])
			                    ->first();
			                    
							
							if (!$existePais) { //si es nuevo el pais en la BD lo agarro
								//Ahora me fijo si existe en mi variable session
								$salida = true;
									foreach ($_SESSION['NuevosPaises'] as $key => $value) {
											// if ( $value ==  $book->pais ){
											if ( $value ==  $latLng['country'] ){
												$salida = false;
												//break;
											}
									}
								if ($salida) { 
									// array_push($_SESSION['NuevosPaises'],$book->pais);	
									array_push($_SESSION['NuevosPaises'],$latLng['country']);	
									$_SESSION['cPais']++;
								}

							}
							if (!$existeProvincia) { //si no existe la prov en lectura vs bd
								$salida = true;
									foreach ($_SESSION['NuevosProvincia'] as $key => $value) {
											// if ( $value ==  $book->provincia_region ){
											if ( $value ==  $latLng['state'] ){
												$salida = false;
												//break;
											}
									}
								if ($salida) {
									// array_push($_SESSION['NuevosProvincia'],$book->provincia_region);	
									array_push($_SESSION['NuevosProvincia'],$latLng['state']);	
									$_SESSION['cProvincia']++;
								}
							}//del if
							if (!$existePartido) {
								$salida = true; 
									foreach ($_SESSION['NuevosPartido'] as $key => $value) {
									if (isset($latLng['city'])) //aca ver esto
												if ( $value['Partido'] ==  $latLng['city'] && $value['Provincia'] == $latLng['state'] ){
													$salida = false;
												}
											// else
											// 	if ( $value['Partido'] ==  $latLng['county'] && $value['Provincia'] == $latLng['state'] ){
											// 		$salida = false;
											// 	}
									}
								if ($salida) {
									if (isset($latLng['city'])){
									array_push($_SESSION['NuevosPartido'],array('Partido'=>$latLng['city'],'Provincia'=>$latLng['state']));
									$_SESSION['cPartido']++;
									}
									else
									{
										array_push($_SESSION['NuevosPartido'],array('Partido'=>'','Provincia'=>$latLng['state']));
										$_SESSION['cPartido']++;	
									}
									}	
							}
							// elseif (!$existePlace) {
							// }

			            } //del if (%LatLng)
	            }// del else qe no es incompleto
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
//	PRE ADD   confirmation
//=================================================================================================================
//=================================================================================================================

public function confirmAdd(Request $request){ //vista results, agrego a BD	
	$_SESSION['Nuevos'] = array();
	$_SESSION['Repetidos'] = array();
	$_SESSION['Unificar']= array();
	$_SESSION['Descartados']= array();
	$_SESSION['Incompletos']= array();
	
	  	
   	//Cargo en memoria el csv para desp meterlo en la DB
	Excel::load(storage_path().'/app/'.$request->fileName, function($reader){ 
		foreach ($reader->get() as $book) {
			
			$address = $book->calle;
			$address = $address.' '.$book->altura;
			// $address = $address.' '.$book->barrio_localidad;  //esto lo saco xq siempre le erran y rompe la busqueda
			$address = $address.' '.$book->partido_comuna; //por esto no comparo con partido
			$address = $address.' '.$book->provincia_region;
			$address = $address.' '.$book->pais;
		
			$latLng = new ImportadorController();	
            $latLng = $latLng->geocode($address); // [lati,longi,formatted_address]
			// //cambio los SI, NO por 0,1		 	
			$book->vacunatorio = $this->parseToImport($book->vacunatorio);
			$book->infectologia = $this->parseToImport($book->infectologia);
			$book->condones = $this->parseToImport($book->condones);
			$book->prueba = $this->parseToImport($book->prueba);
			$book->mac = $this->parseToImport($book->mac);
			
			$faltaAlgo = false;

			if (!isset($latLng['route'])) $faltaAlgo = true;
			if (!isset($latLng['partido'])) $faltaAlgo = true;
			if (!isset($latLng['city'])) $faltaAlgo = true;
			if (!isset($latLng['county'])) $faltaAlgo = true;


			if ($this->esIncompleto($book)){ 
			    array_push($_SESSION['Incompletos'],$this->agregarIncompleto($book));
			}

			elseif ($this->esBajaConfianza($book,$latLng) || $faltaAlgo) {
			    array_push($_SESSION['Descartados'],$this->agregarBajaConfianza($book));
			}

			elseif ($this->esRepetido($book,$latLng)){
			    array_push($_SESSION['Repetidos'],$this->agregarRepetido($book,$latLng));
			}

			elseif ($this->esUnificable($book,$latLng)){
			    array_push($_SESSION['Unificar'],$this->agregarUnificable($book,$latLng));
			}

			elseif ($this->esNuevo($book,$latLng)){
			    array_push($_SESSION['Nuevos'],$this->agregarNuevo($book,$latLng));
			}  

			// dd($RJ);


		}//del for each 
	});//del exel::load
	
	$datosNuevos = $_SESSION['Nuevos'];
	$cantidadNuevos = sizeof($datosNuevos);	
	session(['datosNuevos' => $_SESSION['Nuevos']]); //uasort(array, cmp_function)sando el helper
	// session(['cantidadNuevos' => $cantidadNuevos]); //usando el helper
	
	$datosRepetidos = $_SESSION['Repetidos'];
	$cantidadRepetidos = sizeof($_SESSION['Repetidos']);	
	session(['datosRepetidos' => $_SESSION['Repetidos']]); //usando el helper
	// $cantidadRepetidos = $_SESSION['CantidadRepetidos'];
	// session(['cantidadRepetidos' => $cantidadRepetidos]); //usando el helper
	
	$datosIncompletos = $_SESSION['Incompletos'];
	$cantidadIncompletos = sizeof($datosIncompletos);	
	session(['datosIncompletos' => $datosIncompletos]); //usando el helper
	// $cantidadIncompletos = $_SESSION['CantidadIncompletos'];
	// session(['cantidadIncompletos' => $cantidadIncompletos]); //usando el helper
	$datosUnificar = $_SESSION['Unificar'];
	$cantidadUnificar = sizeof($datosUnificar);	
	
	session(['datosUnificar' => $datosUnificar]); //usando el helper
	// $cantidadUnificar = $_SESSION['CantidadUnificar'];
	// session(['cantidadUnificar' => $cantidadUnificar]); //usando el helper

	$datosDescartados = $_SESSION['Descartados'];
	$cantidadDescartados = sizeof($datosDescartados);	
	session(['datosDescartados' => $datosDescartados]); //usando el helper
	// $cantidadDescartados = $_SESSION['CantidadDescartados'];
	// session(['cantidadDescartados' => $cantidadDescartados]); //usando el helper
	
	return view('panel.importer.confirmFast',compact('datosNuevos','cantidadNuevos','datosRepetidos','cantidadRepetidos','datosDescartados','cantidadDescartados','datosIncompletos','cantidadIncompletos','datosUnificar','cantidadUnificar'));

}

//=================================================================================================================
//=================================================================================================================
//	post ADD   results
//=================================================================================================================
//=================================================================================================================
public function posAdd(Request $request){ //vista results, agrego a BD
	
	$datosNuevos = $request->session()->get('datosNuevos');
	$cantidadNuevos = sizeof($request->session()->get('datosNuevos') );

	$datosRepetidos = $request->session()->get('datosRepetidos');
	$cantidadRepetidos = sizeof($request->session()->get('datosRepetidos'));

	$datosDescartados = $request->session()->get('datosDescartados');
	$cantidadDescartados = sizeof($request->session()->get('datosDescartados'));

	$datosUnificar = $request->session()->get('datosUnificar');
	$cantidadUnificar = sizeof($request->session()->get('datosUnificar'));

	$datosIncompletos = $request->session()->get('datosIncompletos');
	$cantidadIncompletos = sizeof($request->session()->get('datosIncompletos'));
	


	if (session()->get('datosNuevos') != null)
	foreach ($datosNuevos as $book) {
	//agrego nuevo
		
			$existePais = DB::table('pais')
				->where('pais.nombre_pais', '=', $book['pais'])
				->select('pais.id as pais')
				->first();
			
			$existeProvincia = DB::table('provincia')
				->join('pais','pais.id','=','provincia.idPais')
				->where('pais.nombre_pais', '=', $book['pais'])
				->where('provincia.nombre_provincia', '=', $book['provincia_region'])
				->select('provincia.id as provincia','pais.id as pais')
				->first();
			
			$existePartido = DB::table('partido')
				->join('provincia','provincia.id','=','partido.idProvincia')
				->join('pais','pais.id','=','partido.idPais')
				->where('pais.nombre_pais', '=', $book['pais'])
				->where('provincia.nombre_provincia', '=', $book['provincia_region'])
				->where('partido.nombre_partido', '=', $book['partido_comuna'])
				->select('partido.id as partido','provincia.id as provincia','pais.id as pais')
				->first();
		
			$finalIdPais =0;
			$finalIdProvincia = 0;
			$finalIdPartido = 0;

			if ($existePais) $finalIdPais = $existePais->pais;

			if ($existeProvincia) {
				$finalIdPais = $existeProvincia->pais;
				$finalIdProvincia = $existeProvincia->provincia;
			}
			if ($existePartido) {
				$finalIdPais = $existePartido->pais;
				$finalIdPartido = $existePartido->partido;
				$finalIdProvincia = $existePartido->provincia;
			}

	if (!$existePais) {	
	//PAIS
				$pais = new Pais;
				$pais->nombre_pais = $book['pais'];
				$pais->save();
				$finalIdPais = $pais->id;
	}//del existe pais 

	if (!$existeProvincia) { //CASO 2, no existe la provincia en la BD
	//PROVINCIA
		$provincia = new Provincia;
		$provincia->nombre_provincia = $book['provincia_region'];
		$provincia->idPais = $finalIdPais;
		$provincia->save();
		$finalIdProvincia = $provincia->id;
	}//del provincia

	if (!$existePartido) {  //CASO 3, no existe partido en la BD     
	//PARTIDO
		$partido = new Partido;
		$partido->nombre_partido = $book['partido_comuna'];
		$partido->idPais = $finalIdPais;
		$partido->idProvincia = $finalIdProvincia;
		$partido->save();
		$finalIdPartido = $partido->id;
	}
	//PLACES  //aca
		$places = new Places;
		$places->idPais = $finalIdPais;
		$places->idProvincia = $finalIdProvincia;
		$places->idPartido = $finalIdPartido;
		$places->establecimiento = $book['establecimiento'];
		$places->tipo = $book['tipo'];
		$places->calle = $book['calle'];
		$places->altura = $book['altura'];
		$places->piso_dpto = $book['piso_dpto'];
		$places->cruce = $book['cruce'];
		$places->barrio_localidad = $book['barrio_localidad'];
		$places->aprobado = $book['aprobado'];
		$places->observacion = $book['observacion'];
		$places->formattedAddress = $book['formattedAddress'];
		$places->latitude = $book['latitude'];
		$places->longitude = $book['longitude'];
		$places->habilitado = $book['habilitado'];
		$places->vacunatorio = $book['vacunatorio'];
		$places->infectologia = $book['infectologia'];
		$places->condones = $book['condones'];
		$places->prueba = $book['prueba'];
		$places->tel_testeo = $book['tel_testeo'];
		$places->mail_testeo = $book['mail_testeo'];
		$places->horario_testeo = $book['horario_testeo'];
		$places->responsable_testeo = $book['responsable_testeo'];
		$places->web_testeo = $book['web_testeo'];
		$places->ubicacion_testeo = $book['ubicacion_testeo'];
		$places->observaciones_testeo = $book['observaciones_testeo'];

		$places->tel_distrib = $book['tel_distrib'];
		$places->mail_distrib = $book['mail_distrib'];
		$places->horario_distrib = $book['horario_distrib'];
		$places->responsable_distrib = $book['responsable_distrib'];
		$places->web_distrib = $book['web_distrib'];
		$places->ubicacion_distrib = $book['ubicacion_distrib'];
		$places->comentarios_distrib = $book['comentarios_distrib'];

		$places->tel_infectologia = $book['tel_infectologia'];
		$places->mail_infectologia = $book['mail_infectologia'];
		$places->horario_infectologia = $book['horario_infectologia'];
		$places->responsable_infectologia = $book['responsable_infectologia'];
		$places->web_infectologia = $book['web_infectologia'];
		$places->ubicacion_infectologia = $book['ubicacion_infectologia'];
		$places->comentarios_infectologia = $book['comentarios_infectologia'];

		$places->tel_vac = $book['tel_vac'];
		$places->mail_vac = $book['mail_vac'];
		$places->horario_vac = $book['horario_vac'];
		$places->responsable_vac = $book['responsable_vac'];	
		$places->web_vac = $book['web_vac'];
		$places->ubicacion_vac = $book['ubicacion_vac']; //posible problema
		$places->comentarios_vac = $book['comentarios_vac'];
		$places->mac = $book['mac'];
		$places->save(); 	 	


	}
	

  return view('panel.importer.results',compact('datosNuevos','cantidadNuevos','datosRepetidos','cantidadRepetidos','datosDescartados','cantidadDescartados','datosIncompletos','cantidadIncompletos','datosUnificar','cantidadUnificar'));

}

//=================================================================================================================
//=================================================================================================================
//	STORE
//=================================================================================================================
//=================================================================================================================


	//Importar (Metodo llamado por el Btn Agregar)
	public function store(Request $request)
    {  

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

	public function agregarIncompleto($book)
	{
		
		return	array(
				'status' => 'ADD_INC',
				'pais' => $book->pais,
				'provincia_region' => $book->provincia_region,
				'partido_comuna' => $book->partido_comuna,
				'barrio_localidad' => $book->barrio_localidad,
				'establecimiento' => $book->establecimiento,
				'tipo' => $book->tipo,
				'calle' => $book->calle,
				'altura' => $book->altura,
				'piso_dpto' => $book->piso_dpto,
				'cruce' => $book->cruce,
				'aprobado' => $book->aprobado,
				'observacion' => $book->observacion,
				'latitude' => '',
				'longitude' => '',
				'formattedAddress' => '',
				'habilitado' => $book->habilitado,
				'vacunatorio' => $book->vacunatorio,
				'infectologia' => $book->infectologia,
				'condones' => $book->condones,
				'prueba' => $book->prueba,
				'tel_testeo' => $book->tel_testeo,
				'mail_testeo' => $book->mail_testeo,
				'horario_testeo' => $book->horario_testeo,
				'responsable_testeo' => $book->responsable_testeo,
				'web_testeo' => $book->web_testeo,
				'ubicacion_testeo' => $book->ubicacion_testeo,
				'observaciones_testeo' => $book->observaciones_testeo,

				'tel_distrib' => $book->tel_distrib,
				'mail_distrib' => $book->mail_distrib,
				'horario_distrib' => $book->horario_distrib,
				'responsable_distrib' => $book->responsable_distrib,
				'web_distrib' => $book->web_distrib,
				'ubicacion_distrib' => $book->ubicación_distrib,
				'comentarios_distrib' => $book->comentarios_distrib,

				'tel_infectologia' => $book->tel_infectologia,
				'mail_infectologia' => $book->mail_infectologia,
				'horario_infectologia' => $book->horario_infectologia,
				'responsable_infectologia' => $book->responsable_infectologia,
				'web_infectologia' => $book->web_infectologia,
				'ubicacion_infectologia' => $book->ubicacion_infectologia,
				'comentarios_infectologia' => $book->comentarios_infectologia,

				'tel_vac' => $book->tel_vac,
				'mail_vac' => $book->mail_vac,
				'horario_vac' => $book->horario_vac,
				'responsable_vac' => $book->responsable_vac,
				'web_vac' => $book->web_vac,
				'ubicacion_vac' => $book->ubicacion_vac, //posible problema
				'comentarios_vac' => $book->comentarios_vac,
				'mac' => $book->mac	                                    
//			) //del array que creo
		); //del array push 

	}

	public function agregarBajaConfianza($book)
	{
		return array(
			'status' => 'ADD_BAC',
			'pais' => $book->pais,
			'provincia_region' => $book->provincia_region,
			'partido_comuna' => $book->partido_comuna,
			'barrio_localidad' => $book->barrio_localidad,
			'establecimiento' => $book->establecimiento,
			'tipo' => $book->tipo,
			'calle' => $book->calle,
			'altura' => $book->altura,
			'piso_dpto' => $book->piso_dpto,
			'cruce' => $book->cruce,
			'aprobado' => $book->aprobado,
			'observacion' => $book->observacion,
			'latitude' => '',
			'longitude' => '',
			'formattedAddress' => '',
			'habilitado' => $book->habilitado,
			'vacunatorio' => $book->vacunatorio,
			'infectologia' => $book->infectologia,
			'condones' => $book->condones,
			'prueba' => $book->prueba,
			'tel_testeo' => $book->tel_testeo,
			'mail_testeo' => $book->mail_testeo,
			'horario_testeo' => $book->horario_testeo,
			'responsable_testeo' => $book->responsable_testeo,
			'web_testeo' => $book->web_testeo,
			'ubicacion_testeo' => $book->ubicacion_testeo,
			'observaciones_testeo' => $book->observaciones_testeo,

			'tel_distrib' => $book->tel_distrib,
			'mail_distrib' => $book->mail_distrib,
			'horario_distrib' => $book->horario_distrib,
			'responsable_distrib' => $book->responsable_distrib,
			'web_distrib' => $book->web_distrib,
			'ubicacion_distrib' => $book->ubicación_distrib,
			'comentarios_distrib' => $book->comentarios_distrib,

			'tel_infectologia' => $book->tel_infectologia,
			'mail_infectologia' => $book->mail_infectologia,
			'horario_infectologia' => $book->horario_infectologia,
			'responsable_infectologia' => $book->responsable_infectologia,
			'web_infectologia' => $book->web_infectologia,
			'ubicacion_infectologia' => $book->ubicacion_infectologia,
			'comentarios_infectologia' => $book->comentarios_infectologia,

			'tel_vac' => $book->tel_vac,
			'mail_vac' => $book->mail_vac,
			'horario_vac' => $book->horario_vac,
			'responsable_vac' => $book->responsable_vac,
			'web_vac' => $book->web_vac,
			'ubicacion_vac' => $book->ubicacion_vac, //posible problema
			'comentarios_vac' => $book->comentarios_vac,
			'mac' => $book->mac	                                        
		); 

	}

	public function agregarRepetido($book,$latLng)
	{
		return array(
				'status' => 'ADD_REPITED',
				'pais' => $latLng['country'],
				'establecimiento' => $book->establecimiento,
				'partido_comuna' => $latLng['partido'], //comuna 3
				'provincia_region' => $latLng['state'], //caba
				'barrio_localidad' => $latLng['city'], //
				'tipo' => $book->tipo,
				'calle' => $latLng['route'],
				'altura' => $book->altura,
				'piso_dpto' => $book->piso_dpto,
				'cruce' => $book->cruce,
				'aprobado' => $book->aprobado,
				'observacion' => $book->observacion,
				'latitude' => $latLng['lati'],
				'longitude' => $latLng['longi'],
				'formattedAddress' => $latLng['formatted_address'],
				'habilitado' => $book->habilitado,
				'vacunatorio' => $book->vacunatorio,
				'infectologia' => $book->infectologia,
				'condones' => $book->condones,
				'prueba' => $book->prueba,
				'tel_testeo' => $book->tel_testeo,
				'mail_testeo' => $book->mail_testeo,
				'horario_testeo' => $book->horario_testeo,
				'responsable_testeo' => $book->responsable_testeo,
				'web_testeo' => $book->web_testeo,
				'ubicacion_testeo' => $book->ubicacion_testeo,
				'observaciones_testeo' => $book->observaciones_testeo,

				'tel_distrib' => $book->tel_distrib,
				'mail_distrib' => $book->mail_distrib,
				'horario_distrib' => $book->horario_distrib,
				'responsable_distrib' => $book->responsable_distrib,
				'web_distrib' => $book->web_distrib,
				'ubicacion_distrib' => $book->ubicación_distrib,
				'comentarios_distrib' => $book->comentarios_distrib,

				'tel_infectologia' => $book->tel_infectologia,
				'mail_infectologia' => $book->mail_infectologia,
				'horario_infectologia' => $book->horario_infectologia,
				'responsable_infectologia' => $book->responsable_infectologia,
				'web_infectologia' => $book->web_infectologia,
				'ubicacion_infectologia' => $book->ubicacion_infectologia,
				'comentarios_infectologia' => $book->comentarios_infectologia,

				'tel_vac' => $book->tel_vac,
				'mail_vac' => $book->mail_vac,
				'horario_vac' => $book->horario_vac,
				'responsable_vac' => $book->responsable_vac,
				'web_vac' => $book->web_vac,
				'ubicacion_vac' => $book->ubicacion_vac, //posible problema
				'comentarios_vac' => $book->comentarios_vac,
				'mac' => $book->mac
		);

	}

	public function agregarUnificable($book,$latLng)
	{
		return array(
			'status' => 'ADD_UNI',
			'pais' => $latLng['country'],
			'provincia_region' => $latLng['state'],
			'partido_comuna' => $latLng['partido'],
			'barrio_localidad' => $latLng['city'],
			'establecimiento' => $book->establecimiento,
			'tipo' => $book->tipo,
			'calle' => $book->calle,
			'altura' => $book->altura,
			'piso_dpto' => $book->piso_dpto,
			'cruce' => $book->cruce,
			'aprobado' => $book->aprobado,
			'observacion' => $book->observacion,
			'latitude' => $latLng['lati'],
			'longitude' => $latLng['longi'],
			'formattedAddress' => $latLng['formatted_address'],
			'habilitado' => $book->habilitado,
			'vacunatorio' => $book->vacunatorio,
			'infectologia' => $book->infectologia,
			'condones' => $book->condones,
			'prueba' => $book->prueba,
			'tel_testeo' => $book->tel_testeo,
			'mail_testeo' => $book->mail_testeo,
			'horario_testeo' => $book->horario_testeo,
			'responsable_testeo' => $book->responsable_testeo,
			'web_testeo' => $book->web_testeo,
			'ubicacion_testeo' => $book->ubicacion_testeo,
			'observaciones_testeo' => $book->observaciones_testeo,

			'tel_distrib' => $book->tel_distrib,
			'mail_distrib' => $book->mail_distrib,
			'horario_distrib' => $book->horario_distrib,
			'responsable_distrib' => $book->responsable_distrib,
			'web_distrib' => $book->web_distrib,
			'ubicacion_distrib' => $book->ubicación_distrib,
			'comentarios_distrib' => $book->comentarios_distrib,

			'tel_infectologia' => $book->tel_infectologia,
			'mail_infectologia' => $book->mail_infectologia,
			'horario_infectologia' => $book->horario_infectologia,
			'responsable_infectologia' => $book->responsable_infectologia,
			'web_infectologia' => $book->web_infectologia,
			'ubicacion_infectologia' => $book->ubicacion_infectologia,
			'comentarios_infectologia' => $book->comentarios_infectologia,

			'tel_vac' => $book->tel_vac,
			'mail_vac' => $book->mail_vac,
			'horario_vac' => $book->horario_vac,
			'responsable_vac' => $book->responsable_vac,
			'web_vac' => $book->web_vac,
			'ubicacion_vac' => $book->ubicacion_vac, //posible problema
			'comentarios_vac' => $book->comentarios_vac,
			'mac' => $book->mac
		);  

	}

	public function agregarNuevo($book,$latLng)
	{
		return array(
			'status' => 'ADD_NEW',
			'establecimiento' => $book->establecimiento,
			'tipo' => $book->tipo,
			'calle' => $latLng['route'],
			'altura' => $book->altura,
			'piso_dpto' => $book->piso_dpto,
			'cruce' => $book->cruce,
			'barrio_localidad' => $latLng['city'], // almagro, balvanera, etc
			'partido_comuna' => $latLng['partido'], //comuna 3
			'provincia_region' => $latLng['state'], //caba
			'pais' => $latLng['country'],
			'aprobado' => $book->aprobado,
			'observacion' => $book->observacion,
			'latitude' => $latLng['lati'],
			'longitude' => $latLng['longi'],
			'formattedAddress' => $latLng['formatted_address'],
			'habilitado' => $book->habilitado,

			'condones' => $book->condones,
			'prueba' => $book->prueba,
			'vacunatorio' => $book->vacunatorio,
			'infectologia' => $book->infectologia,
			'mac' => $book->mac,

			'tel_testeo' => $book->tel_testeo,
			'mail_testeo' => $book->mail_testeo,
			'horario_testeo' => $book->horario_testeo,
			'responsable_testeo' => $book->responsable_testeo,
			'web_testeo' => $book->web_testeo,
			'ubicacion_testeo' => $book->ubicacion_testeo,
			'observaciones_testeo' => $book->observaciones_testeo,

			'tel_distrib' => $book->tel_distrib,
			'mail_distrib' => $book->mail_distrib,
			'horario_distrib' => $book->horario_distrib,
			'responsable_distrib' => $book->responsable_distrib,
			'web_distrib' => $book->web_distrib,
			'ubicacion_distrib' => $book->ubicación_distrib,
			'comentarios_distrib' => $book->comentarios_distrib,

			'tel_infectologia' => $book->tel_infectologia,
			'mail_infectologia' => $book->mail_infectologia,
			'horario_infectologia' => $book->horario_infectologia,
			'responsable_infectologia' => $book->responsable_infectologia,
			'web_infectologia' => $book->web_infectologia,
			'ubicacion_infectologia' => $book->ubicacion_infectologia,
			'comentarios_infectologia' => $book->comentarios_infectologia,

			'tel_vac' => $book->tel_vac,
			'mail_vac' => $book->mail_vac,
			'horario_vac' => $book->horario_vac,
			'responsable_vac' => $book->responsable_vac,
			'web_vac' => $book->web_vac,
			'ubicacion_vac' => $book->ubicacion_vac, //posible problema
			'comentarios_vac' => $book->comentarios_vac
			
		);

	}
}
