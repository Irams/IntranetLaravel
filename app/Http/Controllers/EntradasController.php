<?php

namespace App\Http\Controllers;

use App\CategoriaEntrada;
use App\entradas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class EntradasController extends Controller
{

    
    //Si quisieramos que la ruta intranet.test/entradas/create estuviera pública SIN autenticación:
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => 'create']);
    // }
    
    //Protegiendo las rutas de usuarios no autenticados
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Auth::user()->entradas->dd();
        // auth()->user()->entradas->dd();

        $unidad = auth()->user()->unid_admin;

        $entradas = auth()->user()->entradas;

        return view('entradas.index', compact('entradas', 'unidad'));

        // return view('entradas.index')->with('entradas', $entradas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Obtener las categorías SIN modelo
        // DB::table('categoria_entradas')->get()->pluck('nombre', 'id')->dd();
        // $categorias = DB::table('categoria_entradas')->get()->pluck('nombre', 'id');

        //Obtener las categorías CON Modelo
        $categorias = CategoriaEntrada::all(['id', 'nombre']);

        
        return view('entradas.create')->with('categorias', $categorias);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request['imagen']->store('upload-entradas', 'public'));

        //Validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'contenido' => 'required',
            'imagen' => 'required|image',
            
        ]);

        //la ruta imagen debemos recuperarla después de la validación:
        $ruta_imagen = $request['imagen']->store('upload-entradas', 'public');

        //Rezise de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        
        //Guardamos en servidor
        $img->save();

        //Almacenar en BD (Sin modelo)
        // DB::table('entradas')->insert([
        //     'titulo' => $data['titulo'],
        //     'contenido' => $data['contenido'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,//El helper Auth nos ayuda a saber que usuario es el que está autenticado, hay que exportarlo en la parte de arriba!
        //     'categoria_id' => $data['categoria'],
        // ]);

        //CON Modelo

        auth()->user()->entradas()->create([
            'titulo' => $data['titulo'],
            'contenido' => $data['contenido'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);

        // dd( $request->all() );

        //Redireccionar
        return redirect()->action('EntradasController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    
     //En versiones anteriores de Laravel
    // public function show($entradas)
    // {
    //     $entradas = Entradas::findOrFail($entradas);
    //     return $entradas;
    // }

    //La nueva forma:
    public function show(entradas $entradas)
    {
        //Obtenemos la unidad administrativa consultando la tabla de user
        $unidad = auth()->user()->unid_admin;
        // dd($unidad);
        //Retornamos la vista y le pasamos entradas y lo que obtuvimos de unidad
        return view('entradas.show', compact('entradas', 'unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function edit(entradas $entradas)
    {
        $categorias = CategoriaEntrada::all(['id', 'nombre']);
        // $unidad = auth()->user()->unid_admin;
        return view('entradas.edit', compact('categorias', 'entradas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entradas $entradas)
    {

        //Revisar el Policy
        $this->authorize('update', $entradas);
        
        //Validación del Update
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'contenido' => 'required',
            
        ]);

        //Asignar los valores
        $entradas->titulo = $data['titulo'];
        $entradas->contenido = $data['contenido'];
        $entradas->categoria_id = $data['categoria'];

        //Si el usuario sube una nueva imgagen
        if(request('imagen')){
             //la ruta imagen debemos recuperarla después de la validación:
            $ruta_imagen = $request['imagen']->store('upload-entradas', 'public');

            //Rezise de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //Asignar al objeto
            $entradas->imagen = $ruta_imagen;
        }

        $entradas->save();

        //Redireccionar
        return redirect()->action('EntradasController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function destroy(entradas $entradas)
    {

        //Policy
        $this->authorize('delete', $entradas);

        //Eliminar receta
        $entradas->delete();


        //Redireccionar
        return redirect()->action('EntradasController@index');
       
    }
}
