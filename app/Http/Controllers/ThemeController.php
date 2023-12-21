<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    // Muestra los temas de los articulos
    public function show(Theme $tema) {

        // $articulos = $tema->articles()->where('activo', '=', 1)->with(['imagenes'])->orderBy('id', 'desc')->paginate(3);
        // return view('tema.articulos')->with(compact('tema', 'articulos'));

        $usuarioAutenticado = true;
        $usuarioBloqueado = false;
        $usuarioVerificado = true;

        if($tema->suscripcion)
        {
            if(auth()->check()) {

                if(!is_null(auth()->user()->email_verified_at)) {
                    if(auth()->user()->bloqueado) {
                        $usuarioBloqueado = true;
                        return view('tema.articulos')->with(compact('tema','usuarioAutenticado', 'usuarioBloqueado', 'usuarioVerificado'));  
                    }
                    $articulos = $tema->articles()->with(['imagenes'])->orderBy('id','desc')->paginate(3);
                    return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado', 'usuarioBloqueado', 'usuarioVerificado'));  
                }    
                $usuarioVerificado = false;
                return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));
            }
            $usuarioAutenticado=false;
            return view('tema.articulos')->with(compact('tema', 'usuarioAutenticado', 'usuarioBloqueado', 'usuarioVerificado'));  

           
        }
        $articulos = $tema->articles()->with(['imagenes'])->orderBy('id','desc')->paginate(3);
        return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado', 'usuarioBloqueado', 'usuarioVerificado'));  
    }

   
}
