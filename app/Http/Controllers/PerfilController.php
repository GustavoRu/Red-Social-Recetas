<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginacion
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(6);
        
        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //ejecutar policy
        //$this->authorize('view', $perfil);

        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //ejecutar el policy
        $this->authorize('update', $perfil);

        //dd($request['imagen']);
        //validar
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        //si el usuario sube una imagen
        if( $request['imagen']){
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();
            //crear una array de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        //asignar nombre y url
        auth()->user()->pagina_web = $data['url'];
        auth()->user()->name = $data['nombre'];
        $user = auth()->user()->save();

        //eliminar url y name de $data
        unset($data['url']);
        unset($data['nombre']);

        //asignar biografia y imagen
        auth()->user()->perfil()->update( array_merge(
            $data, 
            $array_imagen ?? []
        ));
        //Guardar informacion

        //redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
