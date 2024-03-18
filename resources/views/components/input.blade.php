<label>
    {{$label}} :
    <input type="{{$type}}" name="{{$name}}" value="{{old($name)}}">
    @error($name)<span>{{$message}}</span>@enderror
</label>
