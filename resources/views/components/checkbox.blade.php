<label class="checkbox">
    <input type="hidden" name="{{$name}}" value="0">
    <input type="checkbox" name="{{$name}}" value="1" @checked(old($name) ?? false)>
    {{$label}}
    @error($name)<span>{{$message}}</span>@enderror
</label>
