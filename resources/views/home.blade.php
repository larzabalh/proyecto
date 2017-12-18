@extends('template.main')
@section('titulo','HOME')
@section('content')

  BIENVENIDO: {{ auth()->user()->name}}
@endsection

@section('script')

@endsection
