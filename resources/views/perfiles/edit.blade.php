@extends('layouts.app')

@section('styles')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold" href="{{route('recetas.index')}}">
        <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
        Volver
    </a>
@endsection

@section('content')
    {{--{{$perfil->usuario}}--}}
    <h1 class="text-center">Editar mi perfil</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
        <form action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}"  method="POST"
            enctype="multipart/form-data"
            >
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nombre">Nombre</label>

                    <input type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" id="nombre" 
                        placeholder="Tu nombre"
                        value="{{$perfil->usuario->name}}"
                    >

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url">Sitio Web</label>

                    <input type="text" 
                        name="url" 
                        class="form-control @error('url') is-invalid @enderror" id="url" 
                        placeholder="Tu Sitio Web"
                        value="{{$perfil->usuario->pagina_web}}"
                    >

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">Biografia</label>

                    <input id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}">

                    <trix-editor class="form-control @error('biografia') is-invalid @enderror"
                        input="biografia"></trix-editor>
                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Tu imagen</label>

                    <input 
                        class="form-control @error('imagen') is-invalid @enderror"
                        id="imagen" 
                        type="file"
                        name="imagen"
                        >
                    @if($perfil->imagen)
                        
                    
                        <div class="mt-4">
                            <p>Imagen actual:</p>
                            <img src="/storage/{{$perfil->imagen}}" style="width:300px">
                        </div>

                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                        @enderror    
                    @endif    
                </div>  
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
 @endsection