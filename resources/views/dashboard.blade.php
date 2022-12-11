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
                <p class="text-gray-800 text-sm mb-3 font-bold">0 <span class="font-normal">Seguidores</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">0 <span class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->posts->count() }} <span
                        class="font-normal">Posts</span></p>

                @auth
                    <form action="" method="POST">
                        @csrf
                        <input type="submit"
                            class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                            value="Seguir">
                    </form>

                    <form action="" method="POST">
                        @csrf
                        <input type="submit"
                            class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                            value="Dejar de Seguir">
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Mis Publicaciones</h2>

        @if ($posts->count())
            <!--Imprimiendo los post de los usuarios-->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <!--PASANDO DOS VAIABLES - USER AND POST-->
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post"
                                {{ $post->imagen }}>
                        </a>
                    </div>
                @endforeach

            </div class="my-10">
            <!--PAGINACION LARAVEL-->
            {{ $posts->links('pagination::simple-tailwind') }}
            <!---->
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">
                Aun no has realizado publicaciones
            </p>
        @endif

    </section>
@endsection