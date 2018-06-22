<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class BackController extends Controller
{
    public function index(){
    	return view('layouts.base');
    }

    public function process(Request $request){
    	if($request->ajax()){
    		$matrix1 = [];
    		$matrix2 = [];
    		$variable = null;
    		if(!empty($request->file('file'))) {
                $file = $request->file('file');
                $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                $nombre = str_replace(' ', '_', $nombre);
                //\Storage::disk('users')->put($nombre,  \File::get($file));
                Excel::load($request->file('file'), function($reader) {
                	/*
					foreach ($reader->get() as $data) {
						$matrix2 = [
							'referencia' 	=> $data->title,
							'nombre' 		=> $data->author,
							'numero' 		=> $data->publication_year
						];
						$matrix1[] = $matrix2;
					}
					*/
					$variable = $reader->get();
				});
            }
            /*
            else
                $nombre = '';
			*/
            return response()->json([
	            'validations' => true, 
	            'matrix' => $variable
	        ]);
        }
    }
}
