<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SeoController extends Controller {

	public function showServices($pais,$provincia,$partido)
	{
		// $location = array('pais' => $pais,'provincia' => $provincia,'partido' => $partido);
		
		$servicio1 = array('icon' => 'iconos-new_preservativos-3.png',
							'title' => 'Condones',
							'code' => 'condones');

		$servicio2 = array('icon' => 'iconos-new_analisis-3.png',
							'title' => 'Prueba VIH',
							'code' => 'prueba');
		
		$servicio3 = array('icon' => 'iconos-new_vacunacion-3.png',
							'title' => 'Vacunatorios',
							'code' => 'vacunatorio');
	
		$servicio4 = array('icon' => 'iconos-new_atencion-3.png',
							'title' => 'Centros de Infectología',
							'code' => 'infectologia');

		$servicio5 = array('icon' => 'iconos-new_sssr-3.png',
					'title' => 'Servicios de Salud Sexual y Reproductiva',
					'code' => 'infectologia');

		$servicio6 = array('icon' => 'iconos-new_ile-3.png',
			'title' => 'Interrupcion Legal del Embarazo',
			'code' => 'infectologia');

		$allElements = [$servicio1 , $servicio2 , $servicio3, $servicio4, $servicio5, $servicio6];
		        
		return view('seo.services',compact('pais','provincia','partido','allElements'));
	
	}


	public function index()
	{
		echo "SEO";
	}

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
