<!--TRAENDO LA PLANTILLA PRINCIPAL CON LOS ESTILO EN UNA DIRECTIVA-->
@extends('layouts.app')




<!--La contenedores se pueden repetir pero el contenido cambia en cada vista que desarrolles-->
@section('titulo')
    Pagina Pricipal
@endsection


@section('contenido')

   <!--UTILIZANDO EL COMPONENTE-->
   <x-listar-post :posts="$posts" />


@endsection
