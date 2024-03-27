@extends('templates.main')

@section('title', 'Profile')

@section('content')
    <div class="box" id="profile-box">
        <div id="container">
            <table>
                <tbody>
                <tr>
                    <th>Pseudo :</th>
                    <td class="set">{{$user->pseudo}}</td>
                </tr>

                @if(auth()->user()->id == $user->id)
                    <tr>
                        <th>Mail :</th>
                        <td class="set">{{auth()->user()->email}}</td>
                    </tr>
                @endif
                @foreach($fields as $key => $value)
                    <tr>
                        <th>{{$key}} :</th>
                        <td>{{$value}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="end-btn">
                <button class="btn main" id="modify-button">Modifier</button>
            </div>
        </div>

    </div>

    @pushonce('scripts')
        @vite('resources/js/profile.js')
    @endpushonce

@endsection
