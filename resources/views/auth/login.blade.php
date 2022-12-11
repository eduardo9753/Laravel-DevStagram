<!--TRAENDO LA PLANTILLA PRINCIPAL CON LOS ESTILO EN UNA DIRECTIVA-->
@extends('layouts.app')


@section('titulo')
    Inicia Sesión en DevStagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen login de Usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <!--Despejar la validacion del HTML5 'novalidate'-->
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <!--Imprimientdo el Mensaje de Error est se validad en : LoginController->store -->
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo</label>
                    <input id="email" name="email" type="email" placeholder="Tu correo"
                        class="border p-2 w-full rounded-lg @error('email') border-red-500 @enderror" type="text"
                        value="{{ old('email') }}">
                    <!--Para mantener la escritura sin borrarla-->
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Tu contraseña"
                        class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror" type="text">
                    <!--Para mantener la escritura sin borrarla-->
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> <label for="remember" class="text-gray-500 text-sm">
                        Mantener mi sesión abierta</label>
                </div>

                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-center text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
