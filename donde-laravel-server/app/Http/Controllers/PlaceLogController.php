<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\PlaceLog;
use Excel;
use Input;
use Storage;
use DB;
use App\Pais;
use App\Provincia;
use App\Partido;
use App\Places;
use App\Evaluation;
use League\Csv\Writer;
use League\Csv\Reader;
use Session;
use Image;
use ImageServiceProvider;
use Validator;
use Redirect;
use Exception;
use App\Exceptions\CustomException;

use PHPExcel_Cell;

use SplTempFileObject;
use SplFileObject;
use SplFileInfo;

class PlaceLogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getall()
	{
		return PlaceLog::with('user')->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function exportplacesfilterbytag($tagId)
	{
		if (isset($tagId)){
			$tag = PlaceLog::where('id',$tagId)->first();
			if (isset($tag)){
				$placesController = new PlacesRESTController;
				$places = $placesController->showApprovedFilterByTag($tagId);
				if (count($places) > 0){
					if (isset($tag->user->name)) $csvName = "places_". $tag->entry_type ."_". $tag->modification_date."_" . $tag->user->name . ".csv";
					else $csvName = "places_". $tag->entry_type ."_". $tag->modification_date.".csv";
				}
				else {
					$csvName = "nodata.csv";
				}

				$csv = Writer::createFromFileObject(new SplTempFileObject());
				//header
						$csv->insertOne('id,establecimiento,tipo,calle,altura,piso_dpto,cruce,barrio_localidad,partido_comuna,provincia_region,pais,aprobado,observacion,formattedAddress,latitude,longitude,habilitado,confidence,condones,prueba,vacunatorio,infectologia,mac,ile,es_rapido,tel_testeo,mail_testeo,horario_testeo,responsable_testeo,web_testeo,ubicacion_testeo,observaciones_testeo,tel_distrib,mail_distrib,horario_distrib,responsable_distrib,web_distrib,ubicacion_distrib,comentarios_distrib,tel_infectologia,mail_infectologia,horario_infectologia,responsable_infectologia,web_infectologia,ubicacion_infectologia,comentarios_infectologia,tel_vac,mail_vac,horario_vac,responsable_vac,web_vac,ubicacion_vac,comentarios_vac,tel_mac,mail_mac,horario_mac,responsable_mac,web_mac,ubicacion_mac,comentarios_mac,tel_ile,mail_ile,horario_ile,responsable_ile,web_ile,ubicacion_ile,comentarios_ile');
						//body
						foreach ($places as $key => $p) {
							$p = (array)$p;
							$p['condones']= ($p['condones']) ? "SI" : "NO";
							$p['prueba']= ($p['prueba']) ? "SI" : "NO";
							$p['vacunatorio']= ($p['vacunatorio']) ? "SI" : "NO";
							$p['infectologia']= ($p['infectologia']) ? "SI" : "NO";
							$p['mac']= ($p['mac']) ? "SI" : "NO";
							$p['ile']= ($p['ile']) ? "SI" : "NO";
							$p['es_rapido']= ($p['es_rapido']) ? "SI" : "NO";
						
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
						$p['confidence'],
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
						$csv->output($csvName);
			}
			else return $arrayName = array('error' => 'tag not found with id ' . $tagId);
		}
		else return $arrayName = array('error' => 'TagId null or undefined');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

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
