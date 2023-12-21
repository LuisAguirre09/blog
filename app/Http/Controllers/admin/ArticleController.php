<?php

namespace App\Http\Controllers\admin;

use App\Theme;
use App\Article;
use App\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $miga = 'Articulos';
        $todosArticulos = Article::count();
        $articulos = Article::withoutGlobalScope('activo')->with(['user', 'theme'])->orderBy('id', 'desc')->paginate(10);
        return view('admin.articulos.index')->with(compact('miga', 'articulos', 'todosArticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $miga = 'Añadir Articulo';
        return view('admin.articulos.create')->with(compact('miga'));
        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'titulo.required'=>'El campo Título no puede quedar vacio',
            'titulo.unique'=>'El Título de este articulo ya existe',
            'contenido'=>'El campo Contenido no puede quedar vacio',
            'foto0.mimes'=>'No es una imagen',
            'foto0.max'=>'Archivo demasiado grande',
            'foto1.mimes'=>'No es una imagen',
            'foto1.max'=>'Archivo demasiado grande',
            'foto2.mimes'=>'No es una imagen',
            'foto2.max'=>'Archivo demasiado grande'
        ];

        $rules=[
            'titulo'=>'required|unique:articles',
            'contenido'=>'required',
            'foto0' => 'mimes:jpeg,png|max:4048',
            'foto1' => 'mimes:jpeg,png|max:4048',
            'foto2' => 'mimes:jpeg,png|max:4048'
        ];

        $this->validate($request, $rules, $messages);

        $articulo = new Article($request->only('titulo', 'contenido', 'activo', 'theme_id'));
        // $articulo->titulo = $request->titulo;
        // $articulo->contenido = $request->contenido;
        // $articulo->activo = $request->activo;
        // $articulo->theme_id = $request->theme_id;
        $articulo->user_id = auth()->user()->id;
        // dd($articulo->theme_id);
        $articulo->save();

        // Guardar la imagen en nuestro proyecto

        for($i = 0; $i < 3; $i++) {

            if($request->hasFile('foto'.$i)) {
                $path = $request->file('foto'.$i)->store('public/imagenesArticulos');
                $nombreImagen = collect(explode('/', $path))->last();
                $extensionImagen = collect(explode('.', $path))->last();

                $imagen = Image::make(Storage::get($path));
                $imagen->resize(250,250);
                Storage::put($path, $imagen->encode($extensionImagen, 75));

                $imagen = new ArticleImage();
                $imagen->nombre = $nombreImagen;
                $imagen->article_id = $articulo->id;
                $imagen->save();
            }

        }

        $articuloTitulo = $articulo->titulo;
        $notificacion = "El articulo $articuloTitulo se ha añadido correctamente";
        return back()->with(compact('notificacion'));

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $miga='Mostrar Artículo';
        return view('admin.articulos.show')->with(compact('miga','articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Article::withoutGlobalScope('activo')->findOrFail($id);
        $miga = 'Editar Articulo';
        return view('admin.articulos.edit')->with(compact('articulo', 'miga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articulo = Article::withoutGlobalScope('activo')->findOrFail($id);
        $messages=[
            'titulo.required'=>'El campo Título no puede quedar vacio',
            'titulo.unique'=>'El Título de este articulo ya existe',
            'contenido'=>'El campo Contenido no puede quedar vacio',
            'foto1.mimes'=>'No es una imagen',
            'foto1.max'=>'Archivo demasiado grande',
            'foto2.mimes'=>'No es una imagen',
            'foto2.max'=>'Archivo demasiado grande',
            'foto3.mimes'=>'No es una imagen',
            'foto3.max'=>'Archivo demasiado grande'
        ];

        $rules=[
            'titulo' => ['required',Rule::unique('articles')->ignore($articulo->id)],
            'contenido'=>'required',
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048',
            'foto3' => 'mimes:jpeg,png|max:1048'
        ];

        $this->validate($request, $rules, $messages);

      
        // $articulo->activo = $request->activo;
        // $articulo->titulo = $request->titulo;
        // $articulo->theme_id = $request->theme_id;
        // $articulo->contenido = $request->contenido;
        // dd($articulo);
        // $articulo->save();
        $articulo->update($request->only('titulo','contenido','activo','theme_id'));

        // Guardar la imgagen en nuestro proyecto

        for($i=1;$i<4;$i++)
        {
            if($request->hasFile('foto'.$i))
            {
               $path = $request->file('foto'.$i)->store('public/imagenesArticulos');
               $nombreImagen = collect(explode('/', $path))->last();
               $extensionImagen = collect(explode('.', $path))->last();
               $imagen = Image::make(Storage::get($path));
               $imagen->resize(250,250);
               Storage::put($path,$imagen->encode($extensionImagen, 75));
               $imagen=new ArticleImage();
               $imagen->nombre = $nombreImagen;
               $imagen->article_id = $articulo->id;
               $imagen->save(); 
            }
        }

        // $articuloTitulo = $articulo->titulo;
        $miga = 'Articulos';
        $notificacion = "El articulo se ha actualizado correctamente";
        return redirect('admin/articulos')->with(compact('notificacion', 'miga'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        foreach($articulo->imagenes as $imagen)
        {
            // lo borramos físicamente
            Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        }
        $articulo->forceDelete();
        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));
    }
}
