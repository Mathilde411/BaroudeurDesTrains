<label>
    <div>
        {{$label}} :
    </div>
    <input type="{{$type}}" name="{{$name}}" value="{{old($name) ?? ($value ?? '')}}">
    @error($name)<span class="error-message">{{$message}}</span>@enderror
</label>
