@extends('layouts.app')

@section('botones')
    <a href="{{route('entradas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection

@section('content')

<article class="contenido-entarda">
    
    <h1 class="text-center mb-4">{{$entradas->titulo}}</h1>

    <div class="imagen-entrada">
        <img src="/storage/{{ $entradas->imagen }}" alt="imagen_entrada" class="w-80">
    </div>
    <div class="entrada-meta mt-3">
        <p>
            <span class="font-weight-bold text-primary">Categoría: </span>
            {{ $entradas->categoria->nombre }}
        </p>
        <p>
            <span class="font-weight-bold text-primary">Unidad Administrativa: </span>
            {{ $unidad }}
        </p>
        <p>
            <span class="font-weight-bold text-primary">Responsable: </span>
            {{ $entradas->autor->name }}
        </p>
        <p>
            <span class="font-weight-bold text-primary">Fecha de publicación: </span>
            @php
               $fecha = $entradas->created_at
            @endphp
            <fecha-format fecha="{{$fecha}}"></fecha-format>
        </p>

    </div>
    <div class="contenido-entrada">
        <h2 class="my-3 text-primary text-center">Contenido</h2>
        <p>{!! $entradas->contenido !!}</p>
    </div>
</article>
    
@endsection