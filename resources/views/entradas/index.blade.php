@extends('layouts.app')

@section('botones')

    <a href="{{route('entradas.create')}}" class="btn btn-primary mr-2 text-white">Crear Entrada</a>

@endsection

@section('content')
    <h2 class="text-center mb-5">Lista de Entradas de <br><small>{{ $unidad }}</small></h2>

    <div class="col-md-10 mx-auto bg-light p3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Título</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entradas as $entrada) 
                    <tr>
                        <td>{{$entrada->titulo}}</td>
                        <td>{{$entrada->categoria->nombre}}</td>
                        <td>
                            {{-- <form action="{{ route('entradas.destroy', ['entradas' => $entrada->id]) }}" 
                                  method="POST">

                                @csrf
                                @method('DELETE')
                                <input type="submit" 
                                       class="btn btn-danger d-block w-100 mb-2" 
                                       value="Eliminar" 
                                       &times;>
                            </form> --}}
                            <eliminar-entrada entrada-id={{$entrada->id}}></eliminar-entrada>

                            <a href="{{ route('entradas.edit', ['entradas' => $entrada->id]) }}" 
                                class="btn btn-dark d-block mb-2">Editar</a>
                            {{-- <a href="/entradas/{{$entrada->id}}" class="btn btn-success mr-1">Ver</a> --}}
                            {{-- <a href="{{ action('EntradasController@show', ['entradas' => $entrada->id]) }}" class="btn btn-success mr-1">Ver</a> --}}
                            <a href="{{ route('entradas.show', ['entradas' => $entrada->id]) }}" 
                                class="btn btn-success d-block mb-2">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection

