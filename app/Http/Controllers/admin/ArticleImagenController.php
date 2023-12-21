<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ArticleImage;
use Illuminate\Support\Facades\Storage;

class ArticleImagenController extends Controller
{
    public function destroy(ArticleImage $imagen) {
        
        Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        $imagen->delete();

        $notificacion = "Imagen eliminada correctamente";
        return back()->with(compact('notificacion'));
    }
}
