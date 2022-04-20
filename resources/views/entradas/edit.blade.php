@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a href="{{route('entradas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Editar Receta <em>{{$entradas->titulo}}</em></h2>

    {{-- {{$entradas}}    --}}

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" 
                  enctype="multipart/form-data"
                  action="{{ route('entradas.update', ['entradas' => $entradas->id]) }}" 
                  novalidate>
                @csrf

                {{-- PUT, PATCH y DELETE, no son métodos soportados por HTML, por eso Laravel inluye la directiva method() --}}
                @method('PUT') 
                <div class="form-group">
                    <label for="titulo">Titulo Entrada</label>

                    <input type="text"
                           name="titulo"
                           class="form-control @error('titulo') is-invalid @enderror"
                           id="titulo"
                           placeholder="Titulo entrada"
                           value="{{ $entradas->titulo }}">

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select name="categoria"
                            class="form-control @error('categoria') is-invalid @enderror" 
                            id="categoria">
                        <option value="">--Seleccione--</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}"
                                    {{ $entradas->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{$categoria->nombre}}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <input id="contenido"
                           type="hidden"
                           name="contenido"
                           value="{{ $entradas->contenido }}">
                    <trix-editor input="contenido"
                                 class="@error('contenido') is-invalid @enderror" >
                    </trix-editor>
                    @error('contenido')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Imagen de la entrada</label>
                    <input id="imagen"
                           type="file" 
                           class="form-control @error('imagen') is-invalid @enderror"
                           name="imagen">
                           <div class="mt-4">
                             <p>Imagen actual:</p> 
                             <img src="/storage/{{$entradas->imagen}}" style="width: 300px" alt="Imagen actual"> 
                           </div>
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="submit" 
                           class="btn btn-primary" 
                           value="Guardar Cambios">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
