<!--TRAENDO LA PLANTILLA PRINCIPAL CON LOS ESTILO EN UNA DIRECTIVA-->
@extends('layouts.app')


@section('titulo')
    Registrate en DevStagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de Registro de Usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <!--Despejar la validacion del HTML5 'novalidate'-->
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Tu Nombre"
                        class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror" type="text"
                        value="{{ old('name') }}">
                    <!--Para mantener la escritura sin borrarla-->
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu Nombre de Usuario"
                        class="border p-2 w-full rounded-lg @error('username') border-red-500 @enderror" type="text"
                        value="{{ old('username') }}">
                    <!--Para mantener la escritura sin borrarla-->
                    <!--Mensaje de Validacion con 'validate()'-->
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

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
                    <label for="password_confirmation"
                        class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Repita su contraseña" class="border p-2 w-full rounded-lg" type="text">
                </div>

                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-center text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
