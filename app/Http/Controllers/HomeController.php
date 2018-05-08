<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RobbieP\CloudConvertLaravel\CloudConvert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function convert(Request $request){
        $converter = new CloudConvert();
        $from = pathinfo($request->file('files')->getClientOriginalName(), PATHINFO_EXTENSION);

        $types = $converter->input($from)->conversionTypes();
        try{
            $location = public_path() . '/tmp/';

            if (!file_exists($location)) {
                mkdir($location, 0777, true);
            }

            $files = glob($location . '*');
            foreach($files as $file){
                if(is_file($file))
                    unlink($file);
            }
            $name = time() . '.' . $from;
            $request->file('files')->move($location, $name);
            session(['filename' => $location . $name]);
            return view('select',compact('types','from'));

        }catch (Exception $e){
            return $e;
        }


    }
    public function info(){
        $types = new CloudConvert();
        $types = $types->input('pdf')->conversionTypes();
        dd($types);
    }
    public function select(Request $request){
        $convert = new CloudConvert('dQZCeOmKkbAuXJE2xTK4VaPwZXhJOzD6IiTSpx4c0ighs705k7GxpRHeFSKSKY63');
        $convert->file(session('filename'))->to($request->to);
        $name = basename(session('filename'),'.' . $request->from) .'.'. $request->to;
        return view('download',compact('name'));
    }

}
