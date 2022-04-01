<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

class StoreController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = DB::table('store')->get();
		$result = 1;
		return ['result'=>$result, 'data'=>$data];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'name' => 'required|max:255',
			'description' => 'required|max:255',
			'phone' => 'required|max:10|digits:10',
			'address' => 'required'
		];

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
			return ['result'=>0, 'message'=>$validator->errors()];
		}

		$req = $request->all();

		$arr = [
			"name" => $req['name'],
			"description" => $req['description'],
			"phone" => $req['phone'],
			"address" => $req['address']
		];

		$result = DB::table('store')->insert($arr);
		$message = $result ? "Successfully.":"Error.";
		return ['result'=>$result, 'message'=>$message];
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$result = 0;
		$data = null;
		if($id){
			$data = DB::table('store')->where('id',$id)->first();
			if($data){
				$result = 1;
			}
		}
		return ['result'=>$result, 'data'=>$data];
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{

		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$result = 0;
		$message = "Require id for update.";
		if($id){
			$rules = [
				'name' => 'required|max:255',
				'description' => 'required|max:255',
				'phone' => 'required|max:10|digits:10',
				'address' => 'required'
			];

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) {
				return ['result'=>0, 'message'=>$validator->errors()];
			}

			$req = $request->all();

			$arr = [
				"name" => $req['name'],
				"description" => $req['description'],
				"phone" => $req['phone'],
				"address" => $req['address']
			];

			$result = DB::table('store')->where('id', $id)->update($arr);
			$message = $result ? "Successfully.":"Error.";
		}
		return ['result'=>$result, 'message'=>$message];
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
