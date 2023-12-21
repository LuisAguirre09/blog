<?php

namespace App\Jobs;

use App\Theme;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BorrarTema implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $tema;
    public function __construct(Theme $tema)
    {
        $this->tema = $tema;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tema = $this->tema;
        $articulos = $tema->articles()->with(['imagenes'])->get();
        foreach ($articulos as $articulo) {
            foreach($articulo->imagenes as $imagen) {
                // Borramos las imagenes
                Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
            }
        }
        $tema->delete();
    }
}
