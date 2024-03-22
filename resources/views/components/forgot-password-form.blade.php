<form action="{{route('password.forgot.post')}}" method="POST">
    @csrf
    <x-input label="Email" name="email" type="email"></x-input>
    <div class="end-btn">
        <input type="submit" value="Envoyer" class="btn main">
    </div>
</form>

@pushonce('style')
    @vite('resources/css/form.scss')
@endpushonce
