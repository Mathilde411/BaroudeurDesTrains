@extends('templates.main')

@section('title', 'Chat')

@section('content')
    <div class="box">
        <x-conversation :conversation="$conversation"></x-conversation>
    </div>
@endsection

@pushonce('style')
    <style>
        .box {
            height: 50vh;
        }
    </style>
@endpushonce
