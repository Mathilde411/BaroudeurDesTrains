<form action="{{route('register.post')}}" method="POST">
    @csrf
    <x-input label="Pseudo" name="pseudo" type="text"></x-input>
    <x-input label="Email" name="email" type="email"></x-input>
    <x-input label="Password" name="password" type="password"></x-input>
    <x-input label="Confirmation" name="password_confirmation" type="password"></x-input>
    <div class="end-btn">
        <input type="submit" value="S'inscrire" class="btn main">
    </div>
</form>

@pushonce('style')
    @vite('resources/css/form.scss')
@endpushonce
