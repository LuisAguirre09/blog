<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\ArticleImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleDeleteController extends Controller
{
    public function index() {
        $miga='Artículos Borrados';
        
        $articulos=Article::withoutGlobalScope('activo')->onlyTrashed()->with(['user','theme'])->orderBy('id','desc')->get();
        return view('admin.articulosBorrados.index')->with(compact('miga','articulos'));
    }

    public function show($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $imagenes=ArticleImage::where('article_id',$id)->onlyTrashed()->get();
        $miga='Mostrar Artículo';
        return view('admin.articulosBorrados.show')->with(compact('miga','articulo','imagenes'));
    }

    public function restaurar($id) {
        $articulo = Article::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $articulo->restore();
        $notificacion = "El articulo se ha restaurado";
        return back()->with(compact('notificacion'));
    }

    public function destroy($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $imagenes=ArticleImage::where('article_id',$id)->onlyTrashed()->get();
        // return dd($imagenes);
        foreach($imagenes as $imagen)
        {
            // lo borramos físicamente
            Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        }
        $articulo->forceDelete();
        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));
    }
}
