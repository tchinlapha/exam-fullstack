<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$q = DB::table('product')->leftJoin('product_category','product.product_category_id','product_category.id');
		$q->leftJoin('store','product.store_id','store.id');
		$q->select('product.*','product_category.name as category_name', 'store.name as store_name');
		$q->where($_GET);
		$data = $q->get();
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
			'store_id' => 'required|integer',
			'product_category_id' => 'required|integer',
			'name' => 'required|max:255',
			'description' => 'required|max:255',
			'price' => 'numeric',
			'unit' => 'required'
		];

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
			return ['result'=>0, 'message'=>$validator->errors()];
		}

		$req = $request->all();

		if(!DB::table('store')->where('id', $req['store_id'])->count()){
			return ['result'=>0, 'message'=>'Store Id is invalid.'];
		}

		if(!DB::table('product_category')->where('id', $req['product_category_id'])->count()){
			return ['result'=>0, 'message'=>'Product Category Id is invalid.'];
		}

		$arr = [
			"store_id" => $req['store_id'],
			"product_category_id" => $req['product_category_id'],
			"name" => $req['name'],
			"description" => $req['description'],
			"price" => $req['price'],
			"unit" => $req['unit']
		];

		$result = DB::table('product')->insert($arr);
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
			$data = DB::table('product')->where('id',$id)->first();
			if($data){
				$data->store = DB::table('store')->where('id',$data->store_id)->first();
				$data->category = DB::table('product_category')->where('id',$data->product_category_id)->first();
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
				'store_id' => 'required|integer',
				'product_category_id' => 'required|integer',
				'name' => 'required|max:255',
				'description' => 'required|max:255',
				'price' => 'numeric',
				'unit' => 'required'
			];

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) {
				return ['result'=>0, 'message'=>$validator->errors()];
			}

			$req = $request->all();

			if(!DB::table('store')->where('id', $req['store_id'])->count()){
				return ['result'=>0, 'message'=>'Store Id is invalid.'];
			}

			if(!DB::table('product_category')->where('id', $req['product_category_id'])->count()){
				return ['result'=>0, 'message'=>'Product Category Id is invalid.'];
			}

			$arr = [
				"store_id" => $req['store_id'],
				"product_category_id" => $req['product_category_id'],
				"name" => $req['name'],
				"description" => $req['description'],
				"price" => $req['price'],
				"unit" => $req['unit']
			];

			$result = DB::table('product')->where('id', $id)->update($arr);
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
		$result = 0;
		$message = "Require id for delete.";
		if($id){
			$result = DB::table('product')->where('id', $id)->delete();
			$message = $result ? "Successfully.":"Error.";
		}
		return ['result'=>$result, 'message'=>$message];
	}
}
