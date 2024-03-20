<label>
    {{$label}} :
    <input type="{{$type}}" name="{{$name}}" value="{{old($name) ?? ($value ?? '')}}">
    @error($name)<span>{{$message}}</span>@enderror
</label>
