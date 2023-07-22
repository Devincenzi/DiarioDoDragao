@extends('layout.app')

@section('content')

    <home v-bind:listalocalizacoes="{{ json_encode($locais) }}"></home>
@endsection