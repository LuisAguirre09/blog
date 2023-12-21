@component('mail::message')
# Introduction
# Hola {{ $usuario->name }}

{{$contenido}}

@component('mail::button', ['url' => config('app.url')])
Ir al Blog
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
