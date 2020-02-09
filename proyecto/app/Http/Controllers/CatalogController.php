<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;

class CatalogController extends Controller {
    function getIndex()
    {
    	return view('catalog.index')->with('arrayPeliculas', Movie::all());
    }

    function getShow($id)
    {
    	return view('catalog.show',array('arrayPeliculas' => Movie::findOrFail($id)));
    }

    function getEdit($id)
    {
	$movies = DB::table('movies')->find($id);
	return view('catalog.edit',array('id' => $id));
    }

    function getCreate()
    {
    	return view('catalog.create');
    }

	function postCreate(Request $request){

		$datos = $request->validate([
			'year'=>'required|numeric',
			'title'=>'required|string',
			'director'=>'required|string',
			'poster'=>'required',
			'synopsis'=>'required'
		});
		$id = Movie::create($datos);
		session()->flash('notify','Datos actualizados');
		return redirect('catalog');
	}
	function putEdit(Request $request,$id)
	{
		$datos = $request->validate([
			'year'=>'required|numeric',
			'title'=>'required|string',
			'director'=>'required|string',
			'poster'=>'required',
			'synopsis'=>'required'
		});
	Movie::whereId($id)->update($datos);
	session()->flash('notify','Datos actualizado');
	return redirect('catalog/show/, $id);
	}

	function putRent(Request $request, $id) {
		Movie::whereId($id)->update([
			'rented'=>true]);
		session()->flash('notify','La pelicula se ha alquilado');
		return redirect('catalog/show/,'.$id);
	}

	function deleteMovie(Request $request, $id) {
		Movie::whereId($id)->delete();
		session()->flash('notify','La pelicula se elimino');
		return redirect('catalog');
}
