<!--TRAENDO LA PLANTILLA PRINCIPAL CON LOS ESTILO EN UNA DIRECTIVA-->
@extends('layouts.app')




<!--La contenedores se pueden repetir pero el contenido cambia en cada vista que desarrolles-->
@section('titulo')
    {{ $post->titulo }}
@endsection





@section('contenido')
    <div class="container mx-auto md:flex">
        <!--CAJA PUBLICACION DE LA FOTO Y LOS LIKE-->
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="p-3 flex items-center gap-4">
                <!--SOLO LOS QUE ESTAN LOGIADOS PODRAN DAR LIKE-->
                @auth
                    <!--PARA VALIDAR SI EL USUARIO YA DIO SU LIKE-->
                    @if ($post->checkLike(auth()->user()))
                        <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                    <!--END : PARA VALIDAR SI EL USUARIO YA DIO SU LIKE-->
                @endauth
                <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">Likes</span></p>
            </div>


            <div>
                <!--POST / NOMBRE DE LA FUNCION(user) / NOMBRE DE LA VARIABLE que esta en el select(username)-->
                <!-- return $this->belongsTo(User::class)->select(['name','username']);-->
                <p class="font-bold"> {{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>

            
            <!--ELIMINAR PUBLICACION-->
            @auth
                <!--SI EL ID DEL POST QUE ESTA VIENDO ES IGUAL AL ID DE LA PERSONA QUE HA INICIADO SESSION
                                                                                        ENTONCES MOSTRAMOS EL BOTON DE ELIMINAR PUBLICACION-->
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Publicacion"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-10 cursor-pointer">
                    </form>
                @endif

            @endauth
            <!--END : ELIMINAR PUBLICACION-->
        </div>
        <!--END : CAJA PUBLICACION DE LA FOTO Y LOS LIKE-->




        <div class="md:w-1/2">
            <div class="shadow bg-white p-5 mb-5">
                <!--CAJA AGREGAR NUEVO COMENTARIO-->
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agregar un Nuevo Comentario</p>
                    <!--IMPRIMIENDO EL MENSAJE ComentarioController(store): -->
                    <!--//imprimir un mensaje                                                                                                                                                            return back()->with('mensaje', 'Comentario Realizado Correctamente');-->
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white uppercase font-bold text-center">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un
                                Comentario</label>
                            <textarea id="comentario" name="comentario" placeholder="Agrega un comentario :)"
                                class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror"></textarea>
                            <!--Mensaje de Validacion con 'validate()'-->
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-center text-white rounded-lg">
                    </form>
                @endauth
                <!--END: CAJA AGREGAR NUEVO COMENTARIO-->


                <!--LISTADO DE COMENTARIOS-->
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}">
                                    {{ $comentario->user->username }}
                                </a>
                                <p> {{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>
                <!--END - LISTADO DE COMENTARIOS-->
            </div>
        </div>
    </div>
@endsection
