<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
		$ra='this is a random variable';
		return view('pages.index', compact('ra'));
	}
	
	public function about(){
		return view ('pages.about');
	}
	
	public function services(){
		$data=array(
		 'title'=>'Services',
		 'services'=>['Web', 'Design', 'Random']
		);
		return view ('pages.services')->with($data);
	}
	public function cerita()
	{
		return view('pages.cerita');
	}
}
