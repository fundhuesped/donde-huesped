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
use Validator;
use Redirect;
use SplTempFileObject;
use SplFileObject;
use SplFileInfo;
class ImportadorController extends Controller {
	public function exportNuevos(Request $request){
		$datosNuevos = 0;
		if (session('datosNuevos') != null)
			$datosNuevos = session('datosNuevos');
		$csv = Writer::createFromFileObject(new SplTempFileObject());
		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
        //body
        foreach ($datosNuevos as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);
        	$p['ile']= $this->parseToExport($p['ile']);
        	$p['es_rapido']= $this->parseToExport($p['es_rapido']);
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
				$p['ile'],
				$p['es_rapido'],
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
				$p['comentarios_vac'],
				$p['tel_mac'],
				$p['mail_mac'],
				$p['horario_mac'],
				$p['responsable_mac'],
				$p['web_mac'],
				$p['ubicacion_mac'],
				$p['comentarios_mac'],
				$p['tel_ile'],
				$p['mail_ile'],
				$p['horario_ile'],
				$p['responsable_ile'],
				$p['web_ile'],
				$p['ubicacion_ile'],
				$p['comentarios_ile']
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
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
        //body
        foreach ($datosRepetidos as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);
        	$p['ile']= $this->parseToExport($p['ile']);
        	$p['es_rapido']= $this->parseToExport($p['es_rapido']);
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
				$p['ile'],
				$p['es_rapido'],
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
				$p['comentarios_vac'],
				$p['tel_mac'],
				$p['mail_mac'],
				$p['horario_mac'],
				$p['responsable_mac'],
				$p['web_mac'],
				$p['ubicacion_mac'],
				$p['comentarios_mac'],
				$p['tel_ile'],
				$p['mail_ile'],
				$p['horario_ile'],
				$p['responsable_ile'],
				$p['web_ile'],
				$p['ubicacion_ile'],
				$p['comentarios_ile']
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
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
        //body
        foreach ($datosIncompletos as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);
        	$p['ile']= $this->parseToExport($p['ile']);
        	$p['es_rapido']= $this->parseToExport($p['es_rapido']);
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
				$p['ile'],
				$p['es_rapido'],
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
				$p['comentarios_vac'],
				$p['tel_mac'],
				$p['mail_mac'],
				$p['horario_mac'],
				$p['responsable_mac'],
				$p['web_mac'],
				$p['ubicacion_mac'],
				$p['comentarios_mac'],
				$p['tel_ile'],
				$p['mail_ile'],
				$p['horario_ile'],
				$p['responsable_ile'],
				$p['web_ile'],
				$p['ubicacion_ile'],
				$p['comentarios_ile']
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
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
        //body
        foreach ($datosUnificar as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);
        	$p['ile']= $this->parseToExport($p['ile']);
        	$p['es_rapido']= $this->parseToExport($p['es_rapido']);
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
				$p['ile'],
				$p['es_rapido'],
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
				$p['comentarios_vac'],
				$p['tel_mac'],
				$p['mail_mac'],
				$p['horario_mac'],
				$p['responsable_mac'],
				$p['web_mac'],
				$p['ubicacion_mac'],
				$p['comentarios_mac'],
				$p['tel_ile'],
				$p['mail_ile'],
				$p['horario_ile'],
				$p['responsable_ile'],
				$p['web_ile'],
				$p['ubicacion_ile'],
				$p['comentarios_ile']
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
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
        //body
        foreach ($datosDescartados as $key => $p) {
        	$p['condones']= $this->parseToExport($p['condones']);
        	$p['prueba']= $this->parseToExport($p['prueba']);
        	$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
        	$p['infectologia']= $this->parseToExport($p['infectologia']);
        	$p['mac']= $this->parseToExport($p['mac']);
        	$p['ile']= $this->parseToExport($p['ile']);
        	$p['es_rapido']= $this->parseToExport($p['es_rapido']);
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
				$p['ile'],
				$p['es_rapido'],
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
				$p['comentarios_vac'],
				$p['tel_mac'],
				$p['mail_mac'],
				$p['horario_mac'],
				$p['responsable_mac'],
				$p['web_mac'],
				$p['ubicacion_mac'],
				$p['comentarios_mac'],
				$p['tel_ile'],
				$p['mail_ile'],
				$p['horario_ile'],
				$p['responsable_ile'],
				$p['web_ile'],
				$p['ubicacion_ile'],
				$p['comentarios_ile']
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
		$string = trim($string);
		if ( $string == "SI") {
			$string = 1;
		}
		else{
			$string = 0;
		}
		return $string;
	}
//==============================================================================================================
	public function exportarEvaluaciones(Request $request){
	
	header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    // header('Content-Disposition: attachment; filename='.basename($result));
    // header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
	
		$evaluations = $request->all();

		$csv = Writer::createFromFileObject(new SplTempFileObject());
		//header
        $csv->insertOne('¿Que busco?,¿Se lo dieron?,Información clara,Privacidad,Edad,Género,Puntuación,Comentario,¿Aprobado?');

                //body
        foreach ($evaluations as $key => $evaluation) {
        		$csv->insertOne([
        			$evaluation['id'],
        			$evaluation['que_busca'],
        			$evaluation['le_dieron'],
        			$evaluation['info_ok'],
        			$evaluation['privacidad_ok'],
        			$evaluation['edad'],
        			$evaluation['genero'],
        			$evaluation['comentario'],
        			$evaluation['voto'],
        			$evaluation['aprobado'],
        			$evaluation['idPlace'] ]);
        }

        $csv->output('EvaluacionesHuesped.csv');
        
        // return response()
        //     ->withHeaders([
        //         'Content-Type' => 'application/force-download',
        //         'Content-Description' => 'File Transfer',
        //     ]);

        return response()->header('Content-Type', 'application/force-download');

	}

	public function exportarPanel(Request $request){
		$places = $request->all();
		
		$_POST = json_decode(file_get_contents('php://input'), true);

		$csv = Writer::createFromFileObject(new SplTempFileObject());
		//header
        $csv->insertOne('establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
        //body
foreach ($places as $p) {
    $p = (array)$p;
		$p['condones']= $this->parseToExport($p['condones']);
		$p['prueba']= $this->parseToExport($p['prueba']);
		$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
		$p['infectologia']= $this->parseToExport($p['infectologia']);
		$p['mac']= $this->parseToExport($p['mac']);
		$p['ile']= $this->parseToExport($p['ile']);
		$p['es_rapido']= $this->parseToExport($p['es_rapido']);

    $csv->insertOne([
    	$p['placeId'],
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
		$p['ile'],
		$p['es_rapido'],
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
		$p['comentarios_vac'],
		$p['tel_mac'],
		$p['mail_mac'],
		$p['horario_mac'],
		$p['responsable_mac'],
		$p['web_mac'],
		$p['ubicacion_mac'],
		$p['comentarios_mac'],
		$p['tel_ile'],
		$p['mail_ile'],
		$p['horario_ile'],
		$p['responsable_ile'],
		$p['web_ile'],
		$p['ubicacion_ile'],
		$p['comentarios_ile']
		]);


        }
        //descarga
        $csv->output('ListadoHuesped.csv');
	}

//==============================================================================================================
public function exportar(){ //en base a una tabla, creo un CVS.
	//ini_set('memory_limit', '-1'); // 4 GBs minus 1 MB
    $places = DB::table('places')
    	->join('pais','pais.id','=','places.idPais')
    	->join('provincia','provincia.id','=','places.idProvincia')
    	->join('partido','partido.id','=','places.idPartido')
    	->get();

	$csv = Writer::createFromFileObject(new SplTempFileObject());
    $csv->insertOne('id,establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
    
    foreach ($places as $p) {
    $p = (array)$p;
		$p['condones']= $this->parseToExport($p['condones']);
		$p['prueba']= $this->parseToExport($p['prueba']);
		$p['vacunatorio']= $this->parseToExport($p['vacunatorio']);
		$p['infectologia']= $this->parseToExport($p['infectologia']);
		$p['mac']= $this->parseToExport($p['mac']);
		$p['ile']= $this->parseToExport($p['ile']);
		$p['es_rapido']= $this->parseToExport($p['es_rapido']);

    $csv->insertOne([
    	$p['placeId'],
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
		$p['ile'],
		$p['es_rapido'],
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
		$p['comentarios_vac'],
		$p['tel_mac'],
		$p['mail_mac'],
		$p['horario_mac'],
		$p['responsable_mac'],
		$p['web_mac'],
		$p['ubicacion_mac'],
		$p['comentarios_mac'],
		$p['tel_ile'],
		$p['mail_ile'],
		$p['horario_ile'],
		$p['responsable_ile'],
		$p['web_ile'],
		$p['ubicacion_ile'],
		$p['comentarios_ile']
		]);
    }
    $csv->output('Huésped.csv');
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
public function elimina_acentos($text) {
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
public function geocode($book){
	if ( ($book->latitude) != null  && ($book->longitude) != null) {
		$address = $book->latitude.','.$book->longitude;
	    $url = "https://maps.google.com.ar/maps/api/geocode/json?latlng={$address}";
	    // $url = "https://maps.google.com.ar/maps/api/geocode/json?key=AIzaSyACdNTXGb7gdYwlhXegObZj8bvWtr-Sozc&latlng=-24.4460601000000004,-56.8961200999999974";
	    $resp_json = file_get_contents($url);
	    // YHU
	    // -25.0705759999999991	-55.9376960000000025
	    // decode the json
	    $resp = json_decode($resp_json, true);
	    $location = json_decode($resp_json);
	    // // response status will be 'OK', if able to geocode given address
	    if($resp['status']=='OK'){
				    $geoResults = [];
					foreach($location->results as $result){
					    $geoResult = [];
					    if ($location->status == "OK"){
					    	foreach ($location->results[0]->address_components as $address) {
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
						            $geoResult['partido'] = $address->long_name; //partido
						        }
						        if ($address->types[0] == 'locality') {  		//barrio_localidad (CABA), ciudad (Entre rios)
						            $geoResult['city'] = $address->long_name;
						        }
						        if ($address->types[0] == 'political') { //solo en caba
						            $geoResult['county'] = $address->long_name;  //barrio_localidad
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
						if (isset($geoResult['route']))
							if ($geoResult['route'] == "Unnamed Road") $geoResult['route'] = "Calle sin nombre";
						    $geoResults = $geoResult;
					}
				$faltaAlgo = false;
				if (!isset($geoResults['state'])) $faltaAlgo = true;
				if (!isset($geoResults['city']) && (!isset($geoResults['county']))  ){
					$faltaAlgo = true;
					}
				elseif (!isset($geoResults['county'])) {
					$geoResults['county'] = $geoResults['city'];
				}
				// // if (!isset($geoResults['partido'])) {
				// // 	if (isset($geoResults['state']))
				// // 	$geoResults['partido'] = $geoResults['state'];
				// // }
				// if (!isset($geoResults['city']))
				// 	if (isset($geoResults['partido']))
				// 		$geoResults['city'] = $geoResults['partido'];
				// if (!isset($geoResults['county'])) {
				// 	if (isset($geoResults['city']))
				// 		$geoResults['county'] = $geoResults['city'];
				// }
				// dd($faltaAlgo);
				if ($faltaAlgo) 	return false;
				else 	return $geoResults;
			    }
				else{
			            return false;
			    	}
	}
	else{
		$address = $book->calle;
		if (is_numeric($book->altura))
			$address = $address.' '.$book->altura;
		// if (($book->partido_comuna != $book->barrio_localidad) && isset($book->barrio_localidad) )
			// $address = $address.' '.$book->barrio_localidad;
		$address = $address.' '.$book->partido_comuna;
		$address = $address.' '.$book->provincia_region;
		$address = $address.' '.$book->pais;
		$basicString = $this->elimina_acentos($address);
		$address = urlencode($basicString);

		// dd($address);
		// google map geocode api url
		// $url = "https://maps.google.com.ar/maps/api/geocode/json?key=AIzaSyACdNTXGb7gdYwlhXegObZj8bvWtr-Sozc&address={$address}";
		// $url = "https://maps.google.com.ar/maps/api/geocode/json?key=AIzaSyBoXKGMHwhiMfdCqGsa6BPBuX43L-2Fwqs&address={$address}";
		$url = "https://maps.google.com.ar/maps/api/geocode/json?address={$address}";
		// dd($url);
		// get the json response
		$resp_json = file_get_contents($url);
		$resp_json = file_get_contents($url);
	    // decode the json
	    $resp = json_decode($resp_json, true);
	    $location = json_decode($resp_json);
	   	// dd($location);
	    // // response status will be 'OK', if able to geocode given address
	    if($resp['status']=='OK'){
			    $geoResults = [];
				foreach($location->results as $result){
					// dd($result);
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
					            $geoResult['partido'] = $address->long_name; //partido
					        }
					        if ($address->types[0] == 'locality') {  		//barrio_localidad (CABA), ciudad (Entre rios)
					            $geoResult['city'] = $address->long_name;
					        }
					        if ($address->types[0] == 'political') { //solo en caba
					            $geoResult['county'] = $address->long_name;  //barrio_localidad
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
				    // if (isset($geoResult['esCABA'])){
					   //  if ($geoResult['esCABA'] == "CABA" && isset($geoResult['county']))
					   //  	$geoResult['city'] = $geoResult['county'];
					   //  // if ($geoResult['esCABA'] != "CABA" && !isset($geoResult['county']))
					   //  // 	if (isset($geoResult['city']))
					   //  // 	$geoResult['county'] =$geoResult['city'];
					   //  // 	$geoResult = false;
					   //  // if ($geoResult['esCABA'] != "CABA" && !isset($geoResult['city']))
					   //  // 	if (isset($geoResult['county']))
					   //  // 	$geoResult['city'] =$geoResult['county'];
					   //  }
					    // if (isset($geoResult['esCABA']))
					    // 	if ($geoResult['esCABA'] != "CABA" && isset($geoResult['city'])){
					    // 	$geoResult['county'] = $geoResult['city'];
					    // 	}
					    // if ($geoResult['country'] == "Paraguay"){//paraguay no tiene lv2
					    // 	if (isset($geoResult['locality']))
					    // 		$geoResult['partido'] = $geoResult['locality'];
					    // }
				    $geoResults = $geoResult;
				}
				// dd($geoResult);
				
				//new aunque tendria que fallar aca.
				if (!isset($geoResults['state']))
					$geoResults['state']=$geoResults['city'];

				if (isset($geoResults['esCABA'])){ //solamente a caba le mando barrio|barrio|provincia|pais
					if (isset($geoResults['county']))
											$geoResults['partido'] = $geoResults['county'];
					if (isset($geoResults['county']))
											$geoResults['city'] = $geoResults['county'];
				}
				// dd($geoResults);
				$faltaAlgo = false;
				if (!isset($geoResults['route'])) $resultado = true;
				if (!isset($geoResults['partido'])) $resultado = true;
				if (!isset($geoResults['city'])) $resultado = true;
				if (!isset($geoResults['county'])) $resultado = true;
				if ($faltaAlgo) 	return false;
				else 				return $geoResults;
				}
				else{
				return false;
				}
		}
}
public function esRepetido($book,$latLng){
	$resultado = false;
	// $tmp = [$latLng, $book];
	// dd($tmp);
	$existePlace = DB::table('places')
    	->join('pais','pais.id','=','places.idPais')
    	->join('provincia','provincia.id','=','places.idProvincia')
        ->join('partido','partido.id','=','places.idPartido')

		->where('places.calle','=', $latLng['route'])
		->where('places.barrio_localidad','=', $latLng['city']) // no usar debdio a google maps (almagro, etc)
		->where('partido.nombre_partido', '=', $latLng['partido']) // comuna 1,2,3,4
		->where('provincia.nombre_provincia', '=', $latLng['state']) // caba
		->where('pais.nombre_pais', '=', $latLng['country'])
		
		->where('places.aprobado','=', $book->aprobado)
->orWhereNull('places.aprobado')

->where('places.establecimiento','=', $book->establecimiento)
->orWhereNull('places.establecimiento')

->where('places.tipo','=', $book->tipo)
->orWhereNull('places.tipo')

->where('places.altura','=', $book->altura)
->orWhereNull('places.altura')

->where('places.piso_dpto','=', $book->piso_dpto)
->orWhereNull('places.piso_dpto')

->where('places.cruce','=', $book->cruce)
->orWhereNull('places.cruce')

->where('places.observacion','=', $book->observacion)
->orWhereNull('places.observacion')

->where('places.habilitado','=', $book->habilitado)
->orWhereNull('places.habilitado')

->where('places.condones','=', $book->condones)
->orWhereNull('places.condones')

->where('places.prueba','=', $book->prueba)
->orWhereNull('places.prueba')

->where('places.vacunatorio','=', $book->vacunatorio)
->orWhereNull('places.vacunatorio')

->where('places.infectologia','=', $book->infectologia)
->orWhereNull('places.infectologia')

->where('places.mac','=', $book->mac)
->orWhereNull('places.mac')

->where('places.ile','=', $book->ile)
->orWhereNull('places.ile')

->where('places.es_rapido','=', $book->es_rapido)
->orWhereNull('places.es_rapido')

->where('places.tel_testeo','=', $book->tel_testeo)
->orWhereNull('places.tel_testeo')

->where('places.mail_testeo','=', $book->mail_testeo)
->orWhereNull('places.mail_testeo')

->where('places.horario_testeo','=', $book->horario_testeo)
->orWhereNull('places.horario_testeo')

->where('places.responsable_testeo','=', $book->responsable_testeo)
->orWhereNull('places.responsable_testeo')

->where('places.web_testeo','=', $book->web_testeo)
->orWhereNull('places.web_testeo')

->where('places.ubicacion_testeo','=', $book->ubicacion_testeo)
->orWhereNull('places.ubicacion_testeo')

->where('places.observaciones_testeo','=', $book->observaciones_testeo)
->orWhereNull('places.observaciones_testeo')

->where('places.tel_distrib','=', $book->tel_distrib)
->orWhereNull('places.tel_distrib')

->where('places.mail_distrib','=', $book->mail_distrib)
->orWhereNull('places.mail_distrib')

->where('places.horario_distrib','=', $book->horario_distrib)
->orWhereNull('places.horario_distrib')

->where('places.responsable_distrib','=', $book->responsable_distrib)
->orWhereNull('places.responsable_distrib')

->where('places.web_distrib','=', $book->web_distrib)
->orWhereNull('places.web_distrib')

->where('places.ubicacion_distrib','=', $book->ubicacion_distrib)
->orWhereNull('places.ubicacion_distrib')

->where('places.comentarios_distrib','=', $book->comentarios_distrib)
->orWhereNull('places.comentarios_distrib')

->where('places.tel_infectologia','=', $book->tel_infectologia)
->orWhereNull('places.tel_infectologia')

->where('places.mail_infectologia','=', $book->mail_infectologia)
->orWhereNull('places.mail_infectologia')

->where('places.horario_infectologia','=', $book->horario_infectologia)
->orWhereNull('places.horario_infectologia')

->where('places.responsable_infectologia','=', $book->responsable_infectologia)
->orWhereNull('places.responsable_infectologia')

->where('places.web_infectologia','=', $book->web_infectologia)
->orWhereNull('places.web_infectologia')

->where('places.ubicacion_infectologia','=', $book->ubicacion_infectologia)
->orWhereNull('places.ubicacion_infectologia')

->where('places.comentarios_infectologia','=', $book->comentarios_infectologia)
->orWhereNull('places.comentarios_infectologia')

->where('places.tel_vac','=', $book->tel_vac)
->orWhereNull('places.tel_vac')

->where('places.mail_vac','=', $book->mail_vac)
->orWhereNull('places.mail_vac')

->where('places.horario_vac','=', $book->horario_vac)
->orWhereNull('places.horario_vac')

->where('places.responsable_vac','=', $book->responsable_vac)
->orWhereNull('places.responsable_vac')

->where('places.web_vac','=', $book->web_vac)
->orWhereNull('places.web_vac')

->where('places.ubicacion_vac','=', $book->ubicacion_vac)
->orWhereNull('places.ubicacion_vac')

->where('places.comentarios_vac','=', $book->comentarios_vac)
->orWhereNull('places.comentarios_vac')

->where('places.tel_mac','=', $book->tel_mac)
->orWhereNull('places.tel_mac')

->where('places.mail_mac','=', $book->mail_mac)
->orWhereNull('places.mail_mac')

->where('places.horario_mac','=', $book->horario_mac)
->orWhereNull('places.horario_mac')

->where('places.responsable_mac','=', $book->responsable_mac)
->orWhereNull('places.responsable_mac')

->where('places.web_mac','=', $book->web_mac)
->orWhereNull('places.web_mac')

->where('places.ubicacion_mac','=', $book->ubicacion_mac)
->orWhereNull('places.ubicacion_mac')

->where('places.comentarios_mac','=', $book->comentarios_mac)
->orWhereNull('places.comentarios_mac')


->where('places.tel_ile','=', $book->tel_ile)
->orWhereNull('places.tel_ile')

->where('places.mail_ile','=', $book->mail_ile)
->orWhereNull('places.mail_ile')

->where('places.horario_ile','=', $book->horario_ile)
->orWhereNull('places.horario_ile')

->where('places.responsable_ile','=', $book->responsable_ile)
->orWhereNull('places.responsable_ile')

->where('places.web_ile','=', $book->web_ile)
->orWhereNull('places.web_ile')

->where('places.ubicacion_ile','=', $book->ubicacion_ile)
->orWhereNull('places.ubicacion_ile')

->where('places.comentarios_ile','=', $book->comentarios_ile)
->orWhereNull('places.comentarios_ile')


		// ->where('places.aprobado','=', $book->aprobado)
		// ->where('places.establecimiento','=', $book->establecimiento)
		// ->where('places.tipo','=', $book->tipo)
		// ->where('places.altura','=', $book->altura)
		// ->where('places.piso_dpto','=', $book->piso_dpto)
		// ->where('places.cruce','=', $book->cruce)
		// ->where('places.observacion','=', $book->observacion)
		// ->where('places.habilitado','=', $book->habilitado)
		// ->where('places.condones','=', $book->condones)
		// ->where('places.prueba','=', $book->prueba)
		// ->where('places.vacunatorio','=', $book->vacunatorio)
		// ->where('places.infectologia','=', $book->infectologia)
		// ->where('places.mac','=', $book->mac)
		// ->where('places.ile','=', $book->ile)
		// ->where('places.es_rapido','=', $book->es_rapido)
		// ->where('places.tel_testeo','=', $book->tel_testeo)
		// ->where('places.mail_testeo','=', $book->mail_testeo)
		// ->where('places.horario_testeo','=', $book->horario_testeo)
		// ->where('places.responsable_testeo','=', $book->responsable_testeo)
		// ->where('places.web_testeo','=', $book->web_testeo)
		// ->where('places.ubicacion_testeo','=', $book->ubicacion_testeo)
		// ->where('places.observaciones_testeo','=', $book->observaciones_testeo)
		// ->where('places.tel_distrib','=', $book->tel_distrib)
		// ->where('places.mail_distrib','=', $book->mail_distrib)
		// ->where('places.horario_distrib','=', $book->horario_distrib)
		// ->where('places.responsable_distrib','=', $book->responsable_distrib)
		// ->where('places.web_distrib','=', $book->web_distrib)
		// ->where('places.ubicacion_distrib','=', $book->ubicacion_distrib)
		// ->where('places.comentarios_distrib','=', $book->comentarios_distrib)
		// ->where('places.tel_infectologia','=', $book->tel_infectologia)
		// ->where('places.mail_infectologia','=', $book->mail_infectologia)
		// ->where('places.horario_infectologia','=', $book->horario_infectologia)
		// ->where('places.responsable_infectologia','=', $book->responsable_infectologia)
		// ->where('places.web_infectologia','=', $book->web_infectologia)
		// ->where('places.ubicacion_infectologia','=', $book->ubicacion_infectologia)
		// ->where('places.comentarios_infectologia','=', $book->comentarios_infectologia)
		// ->where('places.tel_vac','=', $book->tel_vac)
		// ->where('places.mail_vac','=', $book->mail_vac)
		// ->where('places.horario_vac','=', $book->horario_vac)
		// ->where('places.responsable_vac','=', $book->responsable_vac)
		// ->where('places.web_vac','=', $book->web_vac)
		// ->where('places.ubicacion_vac','=', $book->ubicacion_vac)
		// ->where('places.comentarios_vac','=', $book->comentarios_vac)
		// ->where('places.tel_mac','=', $book->tel_mac)
		// ->where('places.mail_mac','=', $book->mail_mac)
		// ->where('places.horario_mac','=', $book->horario_mac)
		// ->where('places.responsable_mac','=', $book->responsable_mac)
		// ->where('places.web_mac','=', $book->web_mac)
		// ->where('places.ubicacion_mac','=', $book->ubicacion_mac)
		// ->where('places.comentarios_mac','=', $book->comentarios_mac)
		
		// ->where('places.tel_ile','=', $book->tel_ile)
		// ->where('places.mail_ile','=', $book->mail_ile)
		// ->where('places.horario_ile','=', $book->horario_ile)
		// ->where('places.responsable_ile','=', $book->responsable_ile)
		// ->where('places.web_ile','=', $book->web_ile)
		// ->where('places.ubicacion_ile','=', $book->ubicacion_ile)
		// ->where('places.comentarios_ile','=', $book->comentarios_ile)
		// ->select('partido.nombre_partido')
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
	// 'ile' => $book->ile
	// 	'resultadoFinal' => $existePlace
	// 	 );
	// dd($latLng);
	// 	dd($arrayName);
	// 	dd($resultado);
	return $resultado;
}
public function esRepetidoNoGeo($book){
	$resultado = false; //hacer filtro previo, para que los nulos los reemplace por ""

	$c = 0;
	$valor ="";

        foreach ($book as $key => $value) {
			if (is_null($value) == "ubicacion_testeo")
				$valor = $value;
        }

        dd($valor);

	$existePlace = DB::table('places')
    	->join('pais','pais.id','=','places.idPais')
    	->join('provincia','provincia.id','=','places.idProvincia')
        ->join('partido','partido.id','=','places.idPartido')


->where('places.establecimiento', $book->establecimiento)
->where('places.tipo','like', '%' . $book->tipo . '%')
->orWhereNull('places.tipo')
->where('places.calle','like', '%' . $book->calle . '%')
->orWhereNull('places.calle')
->where('places.altura','like', '%' . $book->altura . '%')
->orWhereNull('places.altura')
->where('places.piso_dpto','like', '%' . $book->piso_dpto . '%')
->orWhereNull('places.piso_dpto')
->where('places.cruce','like', '%' . $book->cruce . '%')
->orWhereNull('places.cruce')
->where('places.barrio_localidad','like', '%' . $book->barrio_localidad . '%')
->orWhereNull('places.barrio_localidad')
->where('partido.nombre_partido','like', '%' .  $book->nombre_partido . '%')
->orWhereNull('partido.nombre_partido')
->where('provincia.nombre_provincia','like', '%' .  $book->nombre_provincia . '%')
->orWhereNull('provincia.nombre_provincia')
->where('pais.nombre_pais','like', '%' .  $book->pais . '%')
->orWhereNull('pais.nombre_pais')
->where('places.aprobado','like', '%' . $book->aprobado . '%')
->orWhereNull('places.aprobado')
->where('places.observacion','like', '%' . $book->observacion . '%')
->orWhereNull('places.observacion')
->where('places.habilitado','like', '%' . $book->habilitado . '%')
->orWhereNull('places.habilitado')
->where('places.latitude','like', '%' . $book->latitude . '%')
->orWhereNull('places.latitude')
->where('places.longitude','like', '%' . $book->longitude . '%')
->orWhereNull('places.longitude')
->where('places.condones','like', '%' . $book->condones . '%')
->orWhereNull('places.condones')
->where('places.prueba','like', '%' . $book->prueba . '%')
->orWhereNull('places.prueba')
->where('places.vacunatorio','like', '%' . $book->vacunatorio . '%')
->orWhereNull('places.vacunatorio')
->where('places.infectologia','like', '%' . $book->infectologia . '%')
->orWhereNull('places.infectologia')
->where('places.mac','like', '%' . $book->mac . '%')
->orWhereNull('places.mac')
->where('places.ile','like', '%' . $book->ile . '%')
->orWhereNull('places.ile')
->where('places.es_rapido','like', '%' . $book->es_rapido . '%')
->orWhereNull('places.es_rapido')
->where('places.tel_testeo','like', '%' . $book->tel_testeo . '%')
->orWhereNull('places.tel_testeo')
->where('places.mail_testeo','like', '%' . $book->mail_testeo . '%')
->orWhereNull('places.mail_testeo')
->where('places.horario_testeo','like', '%' . $book->horario_testeo . '%')
->orWhereNull('places.horario_testeo')
->where('places.responsable_testeo','like', '%' . $book->responsable_testeo . '%')
->orWhereNull('places.responsable_testeo')
->where('places.web_testeo','like', '%' . $book->web_testeo . '%')
->orWhereNull('places.web_testeo')
->where('places.ubicacion_testeo','like', '%' . $book->ubicacion_testeo . '%')
->orWhereNull('places.ubicacion_testeo')
->where('places.observaciones_testeo','like', '%' . $book->observaciones_testeo . '%')
->orWhereNull('places.observaciones_testeo')
->where('places.tel_distrib','like', '%' . $book->tel_distrib . '%')
->orWhereNull('places.tel_distrib')
->where('places.mail_distrib','like', '%' . $book->mail_distrib . '%')
->orWhereNull('places.mail_distrib')
->where('places.horario_distrib','like', '%' . $book->horario_distrib . '%')
->orWhereNull('places.horario_distrib')
->where('places.responsable_distrib','like', '%' . $book->responsable_distrib . '%')
->orWhereNull('places.responsable_distrib')
->where('places.web_distrib','like', '%' . $book->web_distrib . '%')
->orWhereNull('places.web_distrib')
->where('places.ubicacion_distrib','like', '%' . $book->ubicacion_distrib . '%')
->orWhereNull('places.ubicacion_distrib')
->where('places.comentarios_distrib','like', '%' . $book->comentarios_distrib . '%')
->orWhereNull('places.comentarios_distrib')
->where('places.tel_infectologia','like', '%' . $book->tel_infectologia . '%')
->orWhereNull('places.tel_infectologia')
->where('places.mail_infectologia','like', '%' . $book->mail_infectologia . '%')
->orWhereNull('places.mail_infectologia')
->where('places.horario_infectologia','like', '%' . $book->horario_infectologia . '%')
->orWhereNull('places.horario_infectologia')
->where('places.responsable_infectologia','like', '%' . $book->responsable_infectologia . '%')
->orWhereNull('places.responsable_infectologia')
->where('places.web_infectologia','like', '%' . $book->web_infectologia . '%')
->orWhereNull('places.web_infectologia')
->where('places.ubicacion_infectologia','like', '%' . $book->ubicacion_infectologia . '%')
->orWhereNull('places.ubicacion_infectologia')
->where('places.comentarios_infectologia','like', '%' . $book->comentarios_infectologia . '%')
->orWhereNull('places.comentarios_infectologia')
->where('places.tel_vac','like', '%' . $book->tel_vac . '%')
->orWhereNull('places.tel_vac')
->where('places.mail_vac','like', '%' . $book->mail_vac . '%')
->orWhereNull('places.mail_vac')
->where('places.horario_vac','like', '%' . $book->horario_vac . '%')
->orWhereNull('places.horario_vac')
->where('places.responsable_vac','like', '%' . $book->responsable_vac . '%')
->orWhereNull('places.responsable_vac')
->where('places.web_vac','like', '%' . $book->web_vac . '%')
->orWhereNull('places.web_vac')
->where('places.ubicacion_vac','like', '%' . $book->ubicacion_vac . '%')
->orWhereNull('places.ubicacion_vac')
->where('places.comentarios_vac','like', '%' . $book->comentarios_vac . '%')
->orWhereNull('places.comentarios_vac')
->where('places.tel_mac','like', '%' . $book->tel_mac . '%')
->orWhereNull('places.tel_mac')
->where('places.mail_mac','like', '%' . $book->mail_mac . '%')
->orWhereNull('places.mail_mac')
->where('places.horario_mac','like', '%' . $book->horario_mac . '%')
->orWhereNull('places.horario_mac')
->where('places.responsable_mac','like', '%' . $book->responsable_mac . '%')
->orWhereNull('places.responsable_mac')
->where('places.web_mac','like', '%' . $book->web_mac . '%')
->orWhereNull('places.web_mac')
->where('places.ubicacion_mac','like', '%' . $book->ubicacion_mac . '%')
->orWhereNull('places.ubicacion_mac')
->where('places.comentarios_mac','like', '%' . $book->comentarios_mac . '%')
->orWhereNull('places.comentarios_mac')
->where('places.tel_ile','like', '%' . $book->tel_ile . '%')
->orWhereNull('places.tel_ile')

		// ->select('pais.nombre_pais','provincia.nombre_provincia','partido.nombre_partido')
		->first();
		dd($existePlace);
    if ($existePlace)
    	$resultado = true;
	$arrayName = array( //  statem ccounty partido city
		'bookCalle' => $book->calle,
		'bookP2' => $book->pais,
		'bookPartido_comuna' => $book->partido_comuna,
		'bookBarrioLocalidad' => $book->barrio_localidad,
		'bookProvincia_region' => $book->provincia_region,
		'condones' => $book->condones,
		'prueba' => $book->prueba,
		'vacunatorio' => $book->vacunatorio,
		'infectologia' => $book->infectologia,
		'mac' => $book->mac,
		'ile' => $book->ile,
		'es_rapido' => $book->es_rapido,
		'resultadoFinal' => $existePlace,
		'resultadoRetornado' => $resultado
		 );
	return $resultado;
}
public function esIncompleto($book){
	$resultado = false;
	if (
		(is_null($book->establecimiento)) ||
		(is_null($book->calle)) ||
		(is_null($book->pais)) ||
		(is_null($book->provincia_region)) ||
		(is_null($book->partido_comuna)) ){
		$resultado = true;
	}
    return $resultado;
}
public function esIncompletoNoGeo($book){
	$resultado = false;
	if (
		(is_null($book->pais)) ||
		(is_null($book->latitude)) ||
		(is_null($book->longitude)) ){
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
        ->join('partido','partido.id','=','places.idPartido')
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
		// ->where('places.observacion','=', $book->observacion)
		// ->where('places.aprobado','=', $book->aprobado)
		// ->where('places.habilitado','=', $book->habilitado)
		->first();
		if ( (!$this->esRepetido($book,$latLng)) && ($existePlace) )
			$resultado = true;
    return $resultado;
}
public function esUnificableNoGeo($book){
	$resultado = false;
	
    $existePlace = DB::table('places')
        ->join('pais','pais.id','=','places.idPais')
    	->join('provincia','provincia.id','=','places.idProvincia')
        ->join('partido','partido.id','=','places.idPartido')
		->where('places.establecimiento','=', $book->establecimiento)
		->where('places.tipo','=', $book->tipo)
		->where('places.calle','=', $book->calle)
		->where('places.altura','=', $book->altura)
		->where('places.piso_dpto','=', $book->piso_dpto)
		->where('places.cruce','=', $book->cruce)//este rompe con
		->where('places.barrio_localidad','=', $book->barrio_localidad) // no usar debdio a google maps (almagro, etc)
		->where('partido.nombre_partido', '=', $book->partido_comuna) // comuna 1,2,3,4
		->where('provincia.nombre_provincia', '=', $book->provincia_region) // caba
		->where('pais.nombre_pais', '=', $book->pais)
		->first();
		if ( (!$this->esRepetidoNoGeo($book)) && ($existePlace) )
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
public function esNuevoNoGeo($book){
	$resultado = false;
	if ( (!$this->esRepetidoNoGeo($book)) && (!$this->esIncompletoNoGeo($book)) )
			$resultado = true;
    return $resultado;
}
//=================================================================================================================
//=================================================================================================================
//	RUTA PREVIEW, VISUALIZO LOS NUEVOS DATOS sin geolocalizar
//=================================================================================================================
//=================================================================================================================
public function preAddNoGeo(Request $request) {
	$request_params = $request->all();
	if ($request->hasFile('file'))
		$ext = $request->file('file')->getClientOriginalExtension();
		if (isset($ext)) 
			$request_params['tmp'] = ($ext == "csv") ? 1234 : 1234567;
    
    $rules = array(
		  'tmp' => 'required|max:4'
    );
	$messages = array(
	'required'    => 'Se debe ingresar un archivo antes de continuar!',
	'max'    => 'La extension del archivo tiene que ser .csv y estar separado por comas (",") ');
	$validator = Validator::make($request_params,$rules,$messages);
	if ($validator->fails()) {
		return redirect('panel/importer/picker')
					->withErrors($validator->messages())
					->withInput();
	}
	$params = $request_params;
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
				if($this->esIncompleto($book))
					continue;
				else{
			                $existePais = DB::table('pais')
			                    ->where('pais.nombre_pais', '=',$book->pais)
			                    ->first();
			                $existeProvincia = DB::table('provincia')
			                    ->join('pais','pais.id','=','provincia.idPais')
			                    ->where('pais.nombre_pais', '=',$book->pais)
			                    ->where('provincia.nombre_provincia', '=', $book->provincia_region)
			                    ->first();
			                if (!isset($latLng['partido'])) $latLng['partido'] = '';
			                $existePartido = DB::table('partido')
			                	->join('provincia','provincia.id','=','partido.idProvincia')
			                	->join('pais','pais.id','=','partido.idPais')
			                    ->where('pais.nombre_pais', '=', $book->pais)
			                    ->where('provincia.nombre_provincia', '=', $book->provincia_region)
			                    ->where('partido.nombre_partido', '=', $book->partido_comuna)
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
			                    ->where('places.latitude', '=', $book->latitude)
			                    ->where('places.longitude', '=', $book->longitude)
			                    ->where('pais.nombre_pais', '=', $book->pais)
			                    ->where('provincia.nombre_provincia', '=', $book->provincia_region)
			                    ->where('partido.nombre_partido', '=', $book->partido_comuna)
			                    ->first();
							if (!$existePais) { //si es nuevo el pais en la BD lo agarro
								//Ahora me fijo si existe en mi variable session
								$salida = true;
									foreach ($_SESSION['NuevosPaises'] as $key => $value) {
											if ( $value ==  $book->pais ){
												$salida = false;
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
											}
									}
								if ($salida) {
									array_push($_SESSION['NuevosProvincia'],$book->provincia_region);
									$_SESSION['cProvincia']++;
								}
							}//del if
							if (!$existePartido) {
								$salida = true; // si no existe el partido hay que recorrer la session y agregar si no esta
									foreach ($_SESSION['NuevosPartido'] as $key => $value)
									{
										if ( $value['Partido'] ==  $book->partido_comuna && $value['Provincia'] == $book->provincia_region )
											$salida = false;
									}
								//desp que recorrio todo, si esta en true aun es xq no hay existe
								if ($salida) {
									array_push($_SESSION['NuevosPartido'],array('Partido'=>$book->partido_comuna,'Provincia'=>$book->provincia_region));
									$_SESSION['cPartido']++;
								}
							}
	            }// del else qe no es incompleto
			}//del for each
		});//del exel::load
		//Armo los datos para mostrar
		$nuevosPaises = $_SESSION['NuevosPaises'];
		$nuevosProvincias =$_SESSION['NuevosProvincia'];
		$nuevosPartidos =$_SESSION['NuevosPartido'];
		$cantidadPais = $_SESSION['cPais'];
		$cantidadProvincia = $_SESSION['cProvincia'];
		$cantidadPartido = $_SESSION['cPartido'];
		$nombreFile =  $_SESSION['nombreFile'];
		return view('panel.importer.preview-ng',compact('nuevosPaises','nuevosProvincias','nuevosPartidos','nombreFile','cantidadPais','cantidadProvincia','cantidadPartido'));
}
//=================================================================================================================
//=================================================================================================================
//	RUTA PREVIEW, VISUALIZO LOS NUEVOS DATOS
//=================================================================================================================
//=================================================================================================================
public function preAdd(Request $request) {
	$request_params = $request->all();
	if ($request->hasFile('file'))
		$ext = $request->file('file')->getClientOriginalExtension();
		if (isset($ext)) 
			$request_params['tmp'] = ($ext == "csv") ? 1234 : 1234567;
    
    $rules = array(
		  'tmp' => 'required|max:4'
    );
	$messages = array(
	'required'    => 'Se debe ingresar un archivo antes de continuar!',
	'max'    => 'La extension del archivo tiene que ser .csv y estar separado por comas (",") ');
	$validator = Validator::make($request_params,$rules,$messages);
	if ($validator->fails()) {
		return redirect('panel/importer/picker')
					->withErrors($validator->messages())
					->withInput();
	}
	$params = $request_params;
	
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
				if($this->esIncompleto($book))
					continue;
				else{
						//verificar como queda formado address para ver si es localizable
			            $latLng = new ImportadorController();
			            $latLng = $latLng->geocode($book); // [lati,longi,formatted_address]
			            //retorno
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
									if (isset($latLng['city'])){ //aca ver esto
												if ( $value['Partido'] ==  $latLng['city'] && $value['Provincia'] == $latLng['state'] )
													$salida = false;
												}
											else
												if (isset($latLng['county']))
											 	if ( $value['Partido'] ==  $latLng['county'] && $value['Provincia'] == $latLng['state'] ){
											 		$salida = false;
											 	}
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
public function confirmAddNoGeo(Request $request){ //vista results, agrego a BD
	$_SESSION['Nuevos'] = array();
	$_SESSION['Repetidos'] = array();
	$_SESSION['Unificar']= array();
	$_SESSION['Descartados']= array();
	$_SESSION['Incompletos']= array();
   	//Cargo en memoria el csv para desp meterlo en la DB
	Excel::load(storage_path().'/app/'.$request->fileName, function($reader){
		foreach ($reader->get() as $book) {
			// //cambio los SI, NO por 0,1
			// dd($this->parseToImport($book->condones));
			$book->vacunatorioOri = $book->vacunatorio;
			$book->infectologiaOri = $book->infectologia;
			$book->condonesOri = $book->condones;
			$book->pruebaOri = $book->prueba;
			$book->macOri = $book->mac;
			$book->ileOri = $book->ile;
			$book->es_rapidoOri = $book->es_rapido;

			$book->vacunatorio = $this->parseToImport($book->vacunatorio);
			$book->infectologia = $this->parseToImport($book->infectologia);
			$book->condones = $this->parseToImport($book->condones);
			$book->prueba = $this->parseToImport($book->prueba);
			$book->mac = $this->parseToImport($book->mac);
			$book->ile = $this->parseToImport($book->ile);
			$book->es_rapido = $this->parseToImport($book->es_rapido);
			
			$faltaAlgo = false;
			if (!isset($book->calle)) $faltaAlgo = true;
			if (!isset($book->barrio_localidad)) $faltaAlgo = true;
			if (!isset($book->partido_comuna)) $faltaAlgo = true;
			if (!isset($book->pais)) $faltaAlgo = true;
			//just in case
			if (!isset($book->latitude)) $faltaAlgo = true;
			if (!isset($book->longitude)) $faltaAlgo = true;
			
			// dd($this->esNuevoNoGeo($book));
			if ($this->esIncompletoNoGeo($book)){ //aca gato
			    array_push($_SESSION['Incompletos'],$this->agregarIncompleto($book));
			}
			elseif ($this->esRepetidoNoGeo($book)){
			    array_push($_SESSION['Repetidos'],$this->agregarRepetidoNoGeo($book));
			}
			elseif ($this->esUnificableNoGeo($book)){
			    array_push($_SESSION['Unificar'],$this->agregarUnificableNoGeo($book));
			}
			elseif ($this->esNuevoNoGeo($book)){
			    array_push($_SESSION['Nuevos'],$this->agregarNuevoNoGeo($book));
			}
			// dd($_SESSION['Nuevos']);
		}//del for each
	});//del exel::load
	$datosNuevos = $_SESSION['Nuevos'];
	$cantidadNuevos = sizeof($datosNuevos);
	session(['datosNuevos' => $_SESSION['Nuevos']]);
	$datosRepetidos = $_SESSION['Repetidos'];
	$cantidadRepetidos = sizeof($_SESSION['Repetidos']);
	session(['datosRepetidos' => $_SESSION['Repetidos']]); //usando el helper
	$datosIncompletos = $_SESSION['Incompletos'];
	$cantidadIncompletos = sizeof($datosIncompletos);
	session(['datosIncompletos' => $datosIncompletos]); //usando el helper
	$datosUnificar = $_SESSION['Unificar'];
	$cantidadUnificar = sizeof($datosUnificar);
	session(['datosUnificar' => $datosUnificar]); //usando el helper
	$datosDescartados = $_SESSION['Descartados'];
	$cantidadDescartados = sizeof($datosDescartados);
	session(['datosDescartados' => $datosDescartados]); //usando el helper
	return view('panel.importer.confirmFast-ng',compact('datosNuevos','cantidadNuevos','datosRepetidos','cantidadRepetidos','datosDescartados','cantidadDescartados','datosIncompletos','cantidadIncompletos','datosUnificar','cantidadUnificar'));
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
			if (is_numeric($book->altura))
				$address = $address.' '.$book->altura;
			if ($book->partido_comuna != $book->barrio_localidad)
				$address = $address.' '.$book->barrio_localidad;
			$address = $address.' '.$book->partido_comuna;
			$address = $address.' '.$book->provincia_region;
			$address = $address.' '.$book->pais;
			$latLng = new ImportadorController();
            $latLng = $latLng->geocode($book); // [lati,longi,formatted_address]
            
            $book->vacunatorioOri = $book->vacunatorio;
			$book->infectologiaOri = $book->infectologia;
			$book->condonesOri = $book->condones;
			$book->pruebaOri = $book->prueba;
			$book->macOri = $book->mac;
			$book->ileOri = $book->ile;
			$book->es_rapidoOri = $book->es_rapido;

			// //cambio los SI, NO por 0,1
			// dd($this->parseToImport($book->condones));
			$book->vacunatorio = $this->parseToImport($book->vacunatorio);
			$book->infectologia = $this->parseToImport($book->infectologia);
			$book->condones = $this->parseToImport($book->condones);
			$book->prueba = $this->parseToImport($book->prueba);
			$book->mac = $this->parseToImport($book->mac);
			$book->ile = $this->parseToImport($book->ile);
			$book->es_rapido = $this->parseToImport($book->es_rapido);
			$faltaAlgo = false;
			// dd($latLng);
			if (!isset($latLng['route'])) $faltaAlgo = true;
			if (!isset($latLng['city'])) $faltaAlgo = true;
			if (!isset($latLng['county'])) {
				if (isset($latLng['city']))
					$latLng['county'] = $latLng['city'];
				else
					$faltaAlgo = true;
			}
			if (!isset($latLng['partido'])) {
				if (isset($latLng['county']))
					$latLng['partido'] = $latLng['county'];
				else
					$faltaAlgo = true;
			}
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
		$partido->habilitado = 1;
		$partido->idProvincia = $finalIdProvincia;
		$partido->save();
		$finalIdPartido = $partido->id;
	}
	//PLACES
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
		$places->es_rapido = $book['es_rapido'];
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
		$places->ubicacion_vac = $book['ubicacion_vac']; 
		$places->comentarios_vac = $book['comentarios_vac'];
		$places->tel_mac = $book['tel_mac'];
		$places->mail_mac = $book['mail_mac'];
		$places->horario_mac = $book['horario_mac'];
		$places->responsable_mac = $book['responsable_mac'];
		$places->web_mac = $book['web_mac'];
		$places->ubicacion_mac = $book['ubicacion_mac']; 
		$places->comentarios_mac = $book['comentarios_mac'];
		$places->tel_ile = $book['tel_ile'];
		$places->mail_ile = $book['mail_ile'];
		$places->horario_ile = $book['horario_ile'];
		$places->responsable_ile = $book['responsable_ile'];
		$places->web_ile = $book['web_ile'];
		$places->ubicacion_ile = $book['ubicacion_ile']; 
		$places->comentarios_ile = $book['comentarios_ile'];
		$places->mac = $book['mac'];
		$places->ile = $book['ile'];
		$places->save();
	}
	if (session()->get('datosUnificar') != null)
	foreach ($datosUnificar as $book) {

		$places = Places::find($book['placeId']);
		
		$places->vacunatorio = $book['vacunatorio'];
		$places->infectologia = $book['infectologia'];
		$places->condones = $book['condones'];
		$places->prueba = $book['prueba'];
		$places->es_rapido = $book['es_rapido'];
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
		$places->ubicacion_vac = $book['ubicacion_vac']; 
		$places->comentarios_vac = $book['comentarios_vac'];
		$places->tel_mac = $book['tel_mac'];
		$places->mail_mac = $book['mail_mac'];
		$places->horario_mac = $book['horario_mac'];
		$places->responsable_mac = $book['responsable_mac'];
		$places->web_mac = $book['web_mac'];
		$places->ubicacion_mac = $book['ubicacion_mac']; 
		$places->comentarios_mac = $book['comentarios_mac'];
		$places->tel_ile = $book['tel_ile'];
		$places->mail_ile = $book['mail_ile'];
		$places->horario_ile = $book['horario_ile'];
		$places->responsable_ile = $book['responsable_ile'];
		$places->web_ile = $book['web_ile'];
		$places->ubicacion_ile = $book['ubicacion_ile']; 
		$places->comentarios_ile = $book['comentarios_ile'];
		$places->mac = $book['mac'];
		$places->ile = $book['ile'];

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
	public function agregarIncompleto($book){
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
				'es_rapido' => $book->es_rapido,
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
				'ubicacion_distrib' => $book->ubicacion_distrib,
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
				'tel_mac' => $book->tel_mac,
				'mail_mac' => $book->mail_mac,
				'horario_mac' => $book->horario_mac,
				'responsable_mac' => $book->responsable_mac,
				'web_mac' => $book->web_mac,
				'ubicacion_mac' => $book->ubicacion_mac, 
				'comentarios_mac' => $book->comentarios_mac,
				'tel_ile' => $book->tel_ile,
				'mail_ile' => $book->mail_ile,
				'horario_ile' => $book->horario_ile,
				'responsable_ile' => $book->responsable_ile,
				'web_ile' => $book->web_ile,
				'ubicacion_ile' => $book->ubicacion_ile, 
				'comentarios_ile' => $book->comentarios_ile,
				'mac' => $book->mac,
				'ile' => $book->ile
//			) //del array que creo
		); //del array push
	}
	public function agregarBajaConfianza($book){
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
			'es_rapido' => $book->es_rapido,
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
			'ubicacion_distrib' => $book->ubicacion_distrib,
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
			'ubicacion_vac' => $book->ubicacion_vac, 
			'comentarios_vac' => $book->comentarios_vac,
			'tel_mac' => $book->tel_mac,
			'mail_mac' => $book->mail_mac,
			'horario_mac' => $book->horario_mac,
			'responsable_mac' => $book->responsable_mac,
			'web_mac' => $book->web_mac,
			'ubicacion_mac' => $book->ubicacion_mac, 
			'comentarios_mac' => $book->comentarios_mac,
			'tel_ile' => $book->tel_ile,
			'mail_ile' => $book->mail_ile,
			'horario_ile' => $book->horario_ile,
			'responsable_ile' => $book->responsable_ile,
			'web_ile' => $book->web_ile,
			'ubicacion_ile' => $book->ubicacion_ile, 
			'comentarios_ile' => $book->comentarios_ile,
			'mac' => $book->mac,
			'ile' => $book->ile
		);
	}
	public function agregarRepetido($book,$latLng){
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
				'es_rapido' => $book->es_rapido,
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
				'ubicacion_distrib' => $book->ubicacion_distrib,
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
				'tel_mac' => $book->tel_mac,
				'mail_mac' => $book->mail_mac,
				'horario_mac' => $book->horario_mac,
				'responsable_mac' => $book->responsable_mac,
				'web_mac' => $book->web_mac,
				'ubicacion_mac' => $book->ubicacion_mac, 
				'comentarios_mac' => $book->comentarios_mac,
				'tel_ile' => $book->tel_ile,
				'mail_ile' => $book->mail_ile,
				'horario_ile' => $book->horario_ile,
				'responsable_ile' => $book->responsable_ile,
				'web_ile' => $book->web_ile,
				'ubicacion_ile' => $book->ubicacion_ile, 
				'comentarios_ile' => $book->comentarios_ile,
				'mac' => $book->mac,
				'ile' => $book->ile
		);
	}
	public function agregarRepetidoNoGeo($book){
		return array(
				'status' => 'ADD_REPITED',
				'pais' => $book->pais,
				'establecimiento' => $book->establecimiento,
				'partido_comuna' => $book->partido_comuna, //comuna 3
				'provincia_region' => $book->provincia_region, //caba
				'barrio_localidad' => $book->barrio_localidad, //
				'tipo' => $book->tipo,
				'calle' => $book->calle,
				'altura' => $book->altura,
				'piso_dpto' => $book->piso_dpto,
				'cruce' => $book->cruce,
				'aprobado' => $book->aprobado,
				'observacion' => $book->observacion,
				'latitude' => $book->latitude,
				'longitude' => $book->longitude,
				'formattedAddress' => $book->formatted_address,
				'habilitado' => $book->habilitado,
				'condones' => $book->condones,
				'prueba' => $book->prueba,
				'es_rapido' => $book->es_rapido,
				'vacunatorio' => $book->vacunatorio,
				'infectologia' => $book->infectologia,
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
				'ubicacion_distrib' => $book->ubicacion_distrib,
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
				'tel_mac' => $book->tel_mac,
				'mail_mac' => $book->mail_mac,
				'horario_mac' => $book->horario_mac,
				'responsable_mac' => $book->responsable_mac,
				'web_mac' => $book->web_mac,
				'ubicacion_mac' => $book->ubicacion_mac, 
				'comentarios_mac' => $book->comentarios_mac,
				'tel_ile' => $book->tel_ile,
				'mail_ile' => $book->mail_ile,
				'horario_ile' => $book->horario_ile,
				'responsable_ile' => $book->responsable_ile,
				'web_ile' => $book->web_ile,
				'ubicacion_ile' => $book->ubicacion_ile, 
				'comentarios_ile' => $book->comentarios_ile,
				'mac' => $book->mac,
				'ile' => $book->ile
		);
	}
	public function agregarUnificable($book,$latLng){
		$existePlace = DB::table('places')
	        ->join('pais','pais.id','=','places.idPais')
	    	->join('provincia','provincia.id','=','places.idProvincia')
	        ->join('partido','partido.id','=','places.idPartido')
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
			// ->where('places.observacion','=', $book->observacion)
			// ->where('places.aprobado','=', $book->aprobado)
			// ->where('places.habilitado','=', $book->habilitado)
			->first();




		return array(
			'status' => 'ADD_UNI',
			'placeId' => $existePlace->placeId,
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
			'vacunatorio' => $this->correctValueService($existePlace->vacunatorio,$book->vacunatorioOri),
			'infectologia' => $this->correctValueService($existePlace->infectologia,$book->infectologiaOri),
			'condones' => $this->correctValueService($existePlace->condones,$book->condonesOri),
			'prueba' => $this->correctValueService($existePlace->prueba,$book->pruebaOri),
			'es_rapido' => $this->correctValueService($existePlace->es_rapido,$book->es_rapidoOri),
			'tel_testeo' => $this->correctValue($existePlace->tel_testeo,$book->tel_testeo),
			'mail_testeo' => $this->correctValue($existePlace->mail_testeo,$book->mail_testeo),
			'horario_testeo' => $this->correctValue($existePlace->horario_testeo,$book->horario_testeo),
			'responsable_testeo' => $this->correctValue($existePlace->responsable_testeo,$book->responsable_testeo),
			'web_testeo' => $this->correctValue($existePlace->web_testeo,$book->web_testeo),
			'ubicacion_testeo' => $this->correctValue($existePlace->ubicacion_testeo,$book->ubicacion_testeo),
			'observaciones_testeo' => $this->correctValue($existePlace->observaciones_testeo,$book->observaciones_testeo),
			'tel_distrib' => $this->correctValue($existePlace->tel_distrib,$book->tel_distrib),
			'mail_distrib' => $this->correctValue($existePlace->mail_distrib,$book->mail_distrib),
			'horario_distrib' => $this->correctValue($existePlace->horario_distrib,$book->horario_distrib),
			'responsable_distrib' => $this->correctValue($existePlace->responsable_distrib,$book->responsable_distrib),
			'web_distrib' => $this->correctValue($existePlace->web_distrib,$book->web_distrib),
			'ubicacion_distrib' => $this->correctValue($existePlace->ubicacion_distrib,$book->ubicacion_distrib),
			'comentarios_distrib' => $this->correctValue($existePlace->comentarios_distrib,$book->comentarios_distrib),
			'tel_infectologia' => $this->correctValue($existePlace->tel_infectologia,$book->tel_infectologia),
			'mail_infectologia' => $this->correctValue($existePlace->mail_infectologia,$book->mail_infectologia),
			'horario_infectologia' => $this->correctValue($existePlace->horario_infectologia,$book->horario_infectologia),
			'responsable_infectologia' => $this->correctValue($existePlace->responsable_infectologia,$book->responsable_infectologia),
			'web_infectologia' => $this->correctValue($existePlace->web_infectologia,$book->web_infectologia),
			'ubicacion_infectologia' => $this->correctValue($existePlace->ubicacion_infectologia,$book->ubicacion_infectologia),
			'comentarios_infectologia' => $this->correctValue($existePlace->comentarios_infectologia,$book->comentarios_infectologia),
			'tel_vac' => $this->correctValue($existePlace->tel_vac,$book->tel_vac),
			'mail_vac' => $this->correctValue($existePlace->mail_vac,$book->mail_vac),
			'horario_vac' => $this->correctValue($existePlace->horario_vac,$book->horario_vac),
			'responsable_vac' => $this->correctValue($existePlace->responsable_vac,$book->responsable_vac),
			'web_vac' => $this->correctValue($existePlace->web_vac,$book->web_vac),
			'ubicacion_vac' => $this->correctValue($existePlace->ubicacion_vac,$book->ubicacion_vac),
			'comentarios_vac' => $this->correctValue($existePlace->comentarios_vac,$book->comentarios_vac),
			'tel_mac' => $this->correctValue($existePlace->tel_mac,$book->tel_mac),
			'mail_mac' => $this->correctValue($existePlace->mail_mac,$book->mail_mac),
			'horario_mac' => $this->correctValue($existePlace->horario_mac,$book->horario_mac),
			'responsable_mac' => $this->correctValue($existePlace->responsable_mac,$book->responsable_mac),
			'web_mac' => $this->correctValue($existePlace->web_mac,$book->web_mac),
			'ubicacion_mac' => $this->correctValue($existePlace->ubicacion_mac,$book->ubicacion_mac),
			'comentarios_mac' => $this->correctValue($existePlace->comentarios_mac,$book->comentarios_mac),
			'tel_ile' => $this->correctValue($existePlace->tel_ile,$book->tel_ile),
			'mail_ile' => $this->correctValue($existePlace->mail_ile,$book->mail_ile),
			'horario_ile' => $this->correctValue($existePlace->horario_ile,$book->horario_ile),
			'responsable_ile' => $this->correctValue($existePlace->responsable_ile,$book->responsable_ile),
			'web_ile' => $this->correctValue($existePlace->web_ile,$book->web_ile),
			'ubicacion_ile' => $this->correctValue($existePlace->ubicacion_ile,$book->ubicacion_ile),
			'comentarios_ile' => $this->correctValue($existePlace->comentarios_ile,$book->comentarios_ile),
			'mac' => $this->correctValueService($existePlace->mac,$book->macOri),
			'ile' => $this->correctValueService($existePlace->ile,$book->ileOri),
		);
	}

	public function correctValue($old,$new){
	// echo "este";
		// dd($new);
		// dd($old);
		if (!isset($new) || $new == "" || $new == " " || $new == "  " || $new == "   " || $new == "    " || is_null($new)) {//si nuevo esta vacio no perder el viejo
			return $old;
		} else {
			return $new;
		}
	}	
	public function correctValueService($old,$new){
		 $resu = 999;
		 if (trim($new) == "NO") $new = 0;
		 if (trim($new) == "SI") $new = 1;
		 // dd($new); //null
		 // dd($old); //1

		 if (is_null($new)) {//si nuevo esta vacio no perder el viejo
			$resu = $old;
		} else {
			$resu = $new;
		}
		// echo "resu";
		// dd($resu);
		return $resu;
	}

	public function agregarUnificableNoGeo($book){ //aca jona
		$existePlace = DB::table('places')
	        ->join('pais','pais.id','=','places.idPais')
	    	->join('provincia','provincia.id','=','places.idProvincia')
	        ->join('partido','partido.id','=','places.idPartido')
			->where('places.establecimiento','=', $book->establecimiento)
			->where('places.tipo','=', $book->tipo)
			->where('places.calle','=', $book->calle)
			->where('places.altura','=', $book->altura)
			->where('places.piso_dpto','=', $book->piso_dpto)
			->where('places.cruce','=', $book->cruce)//este rompe con
			->where('places.barrio_localidad','=', $book->barrio_localidad) // no usar debdio a google maps (almagro, etc)
			->where('partido.nombre_partido', '=', $book->partido_comuna) // comuna 1,2,3,4
			->where('provincia.nombre_provincia', '=', $book->provincia_region) // caba
			->where('pais.nombre_pais', '=', $book->pais)
			->first();
		
		// dd($book->tel_testeo);
		// dd($existePlace);
		// dd($this->correctValue($existePlace->web_testeo,$book->web_testeo));
		// dd($existePlace->tel_testeo); //1
		// dd($book->tel_testeo); //null
		
		return array(
			'status' => 'ADD_UNI',
			'placeId' => $existePlace->placeId,
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
			'latitude' => $book->latitude,
			'longitude' => $book->longitude,
			'formattedAddress' => $book->formattedaddress,
			'habilitado' => $book->habilitado,
			'vacunatorio' => $this->correctValueService($existePlace->vacunatorio,$book->vacunatorioOri),
			'infectologia' => $this->correctValueService($existePlace->infectologia,$book->infectologiaOri),
			'condones' => $this->correctValueService($existePlace->condones,$book->condonesOri),
			'prueba' => $this->correctValueService($existePlace->prueba,$book->pruebaOri),
			'es_rapido' => $this->correctValueService($existePlace->es_rapido,$book->es_rapidoOri),
			'tel_testeo' => $this->correctValue($existePlace->tel_testeo,$book->tel_testeo),
			'mail_testeo' => $this->correctValue($existePlace->mail_testeo,$book->mail_testeo),
			'horario_testeo' => $this->correctValue($existePlace->horario_testeo,$book->horario_testeo),
			'responsable_testeo' => $this->correctValue($existePlace->responsable_testeo,$book->responsable_testeo),
			'web_testeo' => $this->correctValue($existePlace->web_testeo,$book->web_testeo),
			'ubicacion_testeo' => $this->correctValue($existePlace->ubicacion_testeo,$book->ubicacion_testeo),
			'observaciones_testeo' => $this->correctValue($existePlace->observaciones_testeo,$book->observaciones_testeo),
			'tel_distrib' => $this->correctValue($existePlace->tel_distrib,$book->tel_distrib),
			'mail_distrib' => $this->correctValue($existePlace->mail_distrib,$book->mail_distrib),
			'horario_distrib' => $this->correctValue($existePlace->horario_distrib,$book->horario_distrib),
			'responsable_distrib' => $this->correctValue($existePlace->responsable_distrib,$book->responsable_distrib),
			'web_distrib' => $this->correctValue($existePlace->web_distrib,$book->web_distrib),
			'ubicacion_distrib' => $this->correctValue($existePlace->ubicacion_distrib,$book->ubicacion_distrib),
			'comentarios_distrib' => $this->correctValue($existePlace->comentarios_distrib,$book->comentarios_distrib),
			'tel_infectologia' => $this->correctValue($existePlace->tel_infectologia,$book->tel_infectologia),
			'mail_infectologia' => $this->correctValue($existePlace->mail_infectologia,$book->mail_infectologia),
			'horario_infectologia' => $this->correctValue($existePlace->horario_infectologia,$book->horario_infectologia),
			'responsable_infectologia' => $this->correctValue($existePlace->responsable_infectologia,$book->responsable_infectologia),
			'web_infectologia' => $this->correctValue($existePlace->web_infectologia,$book->web_infectologia),
			'ubicacion_infectologia' => $this->correctValue($existePlace->ubicacion_infectologia,$book->ubicacion_infectologia),
			'comentarios_infectologia' => $this->correctValue($existePlace->comentarios_infectologia,$book->comentarios_infectologia),
			'tel_vac' => $this->correctValue($existePlace->tel_vac,$book->tel_vac),
			'mail_vac' => $this->correctValue($existePlace->mail_vac,$book->mail_vac),
			'horario_vac' => $this->correctValue($existePlace->horario_vac,$book->horario_vac),
			'responsable_vac' => $this->correctValue($existePlace->responsable_vac,$book->responsable_vac),
			'web_vac' => $this->correctValue($existePlace->web_vac,$book->web_vac),
			'ubicacion_vac' => $this->correctValue($existePlace->ubicacion_vac,$book->ubicacion_vac),
			'comentarios_vac' => $this->correctValue($existePlace->comentarios_vac,$book->comentarios_vac),
			'tel_mac' => $this->correctValue($existePlace->tel_mac,$book->tel_mac),
			'mail_mac' => $this->correctValue($existePlace->mail_mac,$book->mail_mac),
			'horario_mac' => $this->correctValue($existePlace->horario_mac,$book->horario_mac),
			'responsable_mac' => $this->correctValue($existePlace->responsable_mac,$book->responsable_mac),
			'web_mac' => $this->correctValue($existePlace->web_mac,$book->web_mac),
			'ubicacion_mac' => $this->correctValue($existePlace->ubicacion_mac,$book->ubicacion_mac),
			'comentarios_mac' => $this->correctValue($existePlace->comentarios_mac,$book->comentarios_mac),
			'tel_ile' => $this->correctValue($existePlace->tel_ile,$book->tel_ile),
			'mail_ile' => $this->correctValue($existePlace->mail_ile,$book->mail_ile),
			'horario_ile' => $this->correctValue($existePlace->horario_ile,$book->horario_ile),
			'responsable_ile' => $this->correctValue($existePlace->responsable_ile,$book->responsable_ile),
			'web_ile' => $this->correctValue($existePlace->web_ile,$book->web_ile),
			'ubicacion_ile' => $this->correctValue($existePlace->ubicacion_ile,$book->ubicacion_ile),
			'comentarios_ile' => $this->correctValue($existePlace->comentarios_ile,$book->comentarios_ile),
			'mac' => $this->correctValueService($existePlace->mac,$book->macOri),
			'ile' => $this->correctValueService($existePlace->ile,$book->ileOri)
		);
	}
	public function agregarNuevo($book,$latLng){
		return array(
			'status' => 'ADD_NEW',
			// 'placeId' => $existePlace->placeId,
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
			'ile' => $book->ile,
			'es_rapido' => $book->es_rapido,
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
			'ubicacion_distrib' => $book->ubicacion_distrib,
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
			'tel_mac' => $book->tel_mac,
			'mail_mac' => $book->mail_mac,
			'horario_mac' => $book->horario_mac,
			'responsable_mac' => $book->responsable_mac,
			'web_mac' => $book->web_mac,
			'ubicacion_mac' => $book->ubicacion_mac, 
			'comentarios_mac' => $book->comentarios_mac,
			'tel_ile' => $book->tel_ile,
			'mail_ile' => $book->mail_ile,
			'horario_ile' => $book->horario_ile,
			'responsable_ile' => $book->responsable_ile,
			'web_ile' => $book->web_ile,
			'ubicacion_ile' => $book->ubicacion_ile, 
			'comentarios_ile' => $book->comentarios_ile
		);
	}
	public function agregarNuevoNoGeo($book){
		return array(
			'status' => 'ADD_NEW',
			'establecimiento' => $book->establecimiento,
			'tipo' => $book->tipo,
			'calle' => $book->calle,
			'altura' => $book->altura,
			'piso_dpto' => $book->piso_dpto,
			'cruce' => $book->cruce,
			'barrio_localidad' => $book->barrio_localidad, // almagro, balvanera, etc
			'partido_comuna' => $book->partido_comuna, //comuna 3
			'provincia_region' => $book->provincia_region, //caba
			'pais' => $book->pais,
			'aprobado' => $book->aprobado,
			'observacion' => $book->observacion,
			'latitude' => $book->latitude,
			'longitude' => $book->longitude,
			'formattedAddress' => $book->formatted_address,
			'habilitado' => $book->habilitado,
			'condones' => $book->condones,
			'prueba' => $book->prueba,
			'vacunatorio' => $book->vacunatorio,
			'infectologia' => $book->infectologia,
			'mac' => $book->mac,
			'ile' => $book->ile,
			'es_rapido' => $book->es_rapido,
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
			'ubicacion_distrib' => $book->ubicacion_distrib,
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
			'tel_mac' => $book->tel_mac,
			'mail_mac' => $book->mail_mac,
			'horario_mac' => $book->horario_mac,
			'responsable_mac' => $book->responsable_mac,
			'web_mac' => $book->web_mac,
			'ubicacion_mac' => $book->ubicacion_mac, 
			'comentarios_mac' => $book->comentarios_mac,
			'tel_ile' => $book->tel_ile,
			'mail_ile' => $book->mail_ile,
			'horario_ile' => $book->horario_ile,
			'responsable_ile' => $book->responsable_ile,
			'web_ile' => $book->web_ile,
			'ubicacion_ile' => $book->ubicacion_ile, 
			'comentarios_ile' => $book->comentarios_ile
		);
	}
}