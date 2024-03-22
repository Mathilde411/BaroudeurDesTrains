@extends('templates.main')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    <div>
        <x-register-form></x-register-form>
    </div>
    <a href="{{route('login')}}">J'ai déjà un compte</a>
@endsection
