<!--TRAENDO LA PLANTILLA PRINCIPAL CON LOS ESTILO EN UNA DIRECTIVA-->
@extends('layouts.app')




<!--La contenedores se pueden repetir pero el contenido cambia en cada vista que desarrolles-->
@section('titulo')
    Crea una Nueva Publicacion
@endsection


<!--USO DEL STACK PARA EL CSS-->
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

<!--USO DEL STACK PARA EL JS-->
@push('script')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpush



@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Tutulo</label>
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo de la Publicación"
                        class="border p-2 w-full rounded-lg @error('titulo') border-red-500 @enderror" type="text"
                        value="{{ old('titulo') }}">
                    <!--Para mantener la escritura sin borrarla-->
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la Publicación"
                        class="border p-2 w-full rounded-lg @error('descripcion') border-red-500 @enderror" type="text">{{ old('descripcion') }}</textarea>
                    <!--Para mantener la escritura sin borrarla-->
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md-5">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Crear Publicación"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-center text-white rounded-lg">
            </form>
        </div>
    </div>
    

@endsection
