<form action="{{route('login.post')}}" method="POST">
    @csrf
    <x-input label="Email" name="email" type="email"></x-input>
    <x-input label="Password" name="password" type="password"></x-input>
    <x-checkbox label="Rester connecté" name="remember"></x-checkbox>
    <div class="end-btn">
        <input type="submit" value="Se connecter" class="btn main">
    </div>
    <a href="{{$cerbairLink}}" class="btn main">
        <img width="40" src="{{Vite::asset('resources/images/IMT-noir.svg')}}"> Connexion</a>
</form>

@pushonce('style')
    @vite('resources/css/form.scss')
@endpushonce
