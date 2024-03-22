<label class="checkbox">
    <input type="hidden" name="{{$name}}" value="0">
    <input type="checkbox" name="{{$name}}" value="{{old($name) ?? ($value ?? '')}}">
    {{$label}}
    @error($name)<span>{{$message}}</span>@enderror
</label>
