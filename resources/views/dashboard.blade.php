<!--TRAENDO LA PLANTILLA PRINCIPAL CON LOS ESTILO EN UNA DIRECTIVA-->
@extends('layouts.app')




<!--La contenedores se pueden repetir pero el contenido cambia en cada vista que desarrolles-->
@section('titulo')
    Perfil {{ $user->username }}
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <!--<img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                                                                    alt="Imagen del Usuario"> -->
                <img src="@if (!$user->imagen === '') {{ asset('perfiles') . '/' . $user->imagen }}
                 @else
                 {{ asset('img/usuario.svg') }} @endif"
                    alt="">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col md:justify-center py-10 md:py-10">
                <div class="flex items-center gap-4">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                    <!--PARA EDITAR LA INFORMACION DEL USUARIO-->
                    @auth
                        <!--SI EL ID DEL USURIO DE LA BASE DE DATOS ES IGUAL AL USUARIO QUE ESTA LOGEADO
                                                                                                                                                                                            ENTONCES ES LA MISMA PERSONA , EDITAMOS NUESTROS DATOS-->
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                    <!--END : PARA EDITAR LA INFORMACION DEL USUARIO-->
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->followers->count() }} <span
                        class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->following->count() }} <span
                        class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->posts->count() }} <span
                        class="font-normal">Posts</span></p>

                <!--BOTONES DE SEGUIR Y DEJAR DE SEGUIR-->
                @auth
                    <!--SI EL USUARIO ACTUAL ES DIFERENTE AL USUARIO QUE ESTA AUTENTICADO
                                                                                                        ENTONCES SI LO PUEDES SEGUI Y DEJAR DE SEGUIR -->
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <!--SI NO LO ESTA SIGUIENTE ENTONCES FORMULARIO DE SEGUIR-->
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Seguir">
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir">
                            </form>
                        @endif
                    @endif
                @endauth
                <!--END BOTONES DE SEGUIR Y DEJAR DE SEGUIR-->
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Mis Publicaciones</h2>

        <!--UTILIZANDO EL COMPONENTE-->
        <x-listar-post :posts="$posts" />

    </section>
@endsection
