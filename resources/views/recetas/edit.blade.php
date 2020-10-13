@extends('layouts.app')

@section('styles')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')

    {{--{{$receta}}--}}
    <a class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold" href="{{route('recetas.index')}}">
        <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
        Volver
    </a>

@endsection

@section('content')

    <h2 class="text-center mb-5">Editar Receta: {{$receta->titulo}}</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('recetas.update', ['receta'=> $receta->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf

                @method('put')
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>

                    <input type="text" 
                        name="titulo" 
                        class="form-control @error('titulo') is-invalid @enderror" id="titulo" 
                        placeholder="Titulo Receta"
                        value="{{$receta->titulo}}"
                    >

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select 
                        name="categoria" 
                        id="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror">
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria['id']}}" 
                            {{ $receta->categoria_id == $categoria['id'] ? 'selected' : ''}}>
                            {{$categoria['nombre']}}</option>
                        @endforeach
                        
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparacion">Preparacion</label>

                    <input id="preparacion" type="hidden" name="preparacion" value="{{$receta->preparacion}}">

                    <trix-editor class="form-control @error('preparacion') is-invalid @enderror"
                        input="preparacion"></trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="ingredientes">Ingredientes</label>

                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{ $receta->ingredientes}}">

                    <trix-editor class="form-control @error('ingredientes') is-invalid @enderror"
                        input="ingredientes"></trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Elige la imagen</label>

                    <input 
                        class="form-control @error('imagen') is-invalid @enderror"
                        id="imagen" 
                        type="file"
                        name="imagen"
                        >

                        <div class="mt-4">
                            <p>Imagen actual:</p>
                            <img src="/storage/{{$receta->imagen}}" style="width:300px">
                        </div>

                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                        @enderror    
                </div>    

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>
            </form>
        </div>

    </div>
   

@endsection

 @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
 @endsection