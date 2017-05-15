<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ServiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getAllServices()
	{
			return \App\Service::all();
	}

	public function getPlaceServices($placeId)
	{

			//$services = \App\Service::all();
			$place = \App\Places::where('placeId',$placeId)->first();
			$services = [];
			if ($place->vacunatorio == 1) {
				$service = \App\Service::where('shortname','vacunatorios')->select('id','name','shortname')->get();
				array_push($services, $service[0]);
			}
			if ($place->infectologia == 1) {
				$service = \App\Service::where('shortname','cdi')->select('id','name','shortname')->get();
				array_push($services, $service[0]);
			}
			if ($place->condones == 1) {
				$service = \App\Service::where('shortname','condones')->select('id','name','shortname')->get();
				array_push($services, $service[0]);
			}
			if ($place->prueba == 1) {
				$service = \App\Service::where('shortname','prueba')->select('id','name','shortname')->get();
				array_push($services, $service[0]);
			}
			if ($place->mac == 1) {
				$service = \App\Service::where('shortname','sssr')->select('id','name','shortname')->get();
				array_push($services, $service[0]);
			}
			if ($place->ile == 1) {
				$service = \App\Service::where('shortname','ile')->select('id','name','shortname')->get();
				array_push($services, $service[0]);
			}
			return $services;
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
