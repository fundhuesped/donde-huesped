<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Evaluation;
use App\Places;
use DB;

class EvaluationRESTController extends Controller {

	public function getCopies($id){
		return DB::table('places')->where('placeId',$id)->select('places.establecimiento')->get();
	}

	public function block($id){
		// $request_params = $request->all();

		$evaluation = Evaluation::find($id);

		$evaluation->aprobado = -1;

		$evaluation->updated_at = date("Y-m-d H:i:s");
		$evaluation->save();

		return $evaluation;
	}

	public function approve($id){

		// $request_params = $request->all();

		$evaluation = Evaluation::find($id);
		
		$evaluation->aprobado = 1;

		$evaluation->updated_at = date("Y-m-d H:i:s");
		$evaluation->save();

		return $evaluation;
	}

	public function countEvaluations($id){ //def toma 5, agregar que esten aprobados
		return DB::table('evaluation')
			->join('places', 'places.placeId', '=', 'evaluation.idPlace')
			->where('evaluation.idPlace',$id)
			->count();
	}


	public function showEvaluations($id){ //def toma 5, agregar que esten aprobados
		return DB::table('evaluation')
			->where('evaluation.idPlace',$id)
			->select('evaluation.comentario','evaluation.que_busca','evaluation.voto')
			->take(5)
			->get();
	}


	public function getPlaceAverageVote($id){
		$resu =  Evaluation::where('idPlace',$id)
			// ->where('aprobado', '=', '1')
		    // ->select(array('evaluation.*', DB::raw('AVG(voto) as promedio') ))
		    ->select(DB::raw('AVG(voto) as promedio'))
		    ->orderBy('promedio', 'DESC')
		    ->get('promedio');

		return round($resu[0]->promedio,0,PHP_ROUND_HALF_UP);
	}

	public function getPlaceAverageVoteReal($id){
		$resu =  Evaluation::where('idPlace',$id)
			// ->where('aprobado', '=', '1')
		    // ->select(array('evaluation.*', DB::raw('AVG(voto) as promedio') ))
		    ->select(DB::raw('AVG(voto) as promedio'))
		    ->orderBy('promedio', 'DESC')
		    ->get('promedio');

		return $resu[0]->promedio;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo "hello";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tmp');
	}

	public function store(Request $request)
	{
		$ev = new Evaluation;
        
        
        $ev->que_busca = $request->que_busca;
        $ev->le_dieron = $request->le_dieron;
        $ev->info_ok = $request->info_ok;
        $ev->privacidad_ok = $request->privacidad_ok;
        $ev->edad = $request->edad;
        $ev->genero = $request->genero;
        $ev->comentario = $request->comentario;
        $ev->voto = $request->voto;
        $ev->aprobado = 0;
        $ev->idPlace = $request->idPlace;
		
		$ev->save();


		//para el moto aprove panel
		$place = Places::find($request->idPlace);

		$place->cantidad_votos = $this->countEvaluations($request->idPlace);

		$place->rate = $this->getPlaceAverageVote($request->idPlace);
		$place->rateReal = $this->getPlaceAverageVoteReal($request->idPlace);
		
		$place->save();
		//========



		return $ev;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$evaluation = Evaluation::find($id);
		return $evaluation;
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
