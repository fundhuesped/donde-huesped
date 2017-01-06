<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SeoController extends Controller {

	public function showServices()
	{
		$allElements = [{
		        icon: 'iconos-new_preservativos-3.png',
		        title: 'Condones',
		        content: 'Encuentra los lugares más cercanos para retirar condones gratis.'
		    },{
		        icon: 'iconos-new_analisis-3.png',
		        title: 'Prueba VIH',
		        content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.'
		     },{
		        icon: 'iconos-new_vacunacion-3.png',
		        label: 'Vacunatorios',
		        content: 'Encuentra los vacunatorios más cercanos, sus horarios de atención e información de contacto.'  
		    },{
		        icon: 'iconos-new_atencion-3.png',
		        title: 'Centros de Infectología',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    },{//nuevo ILE
		        icon: 'iconos-new_atencion-3.png',
		        title: 'Centros de Infectología',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    },{//nuevo SSSR
		        icon: 'iconos-new_atencion-3.png',
		        title: 'Servicios de Salud Sexual y Reproductiva',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    }
		];
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
