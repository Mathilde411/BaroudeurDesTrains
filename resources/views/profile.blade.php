@extends('templates.main')

@section('title', 'Profile')

@section('content')
    <div class="box">
        @foreach($fields as $key => $value)
            {{$key}} : {{$value}}
        @endforeach
    </div>
@endsection
