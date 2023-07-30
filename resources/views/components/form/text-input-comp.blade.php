@props(['name','type'=>'text'])
{{-- Um prop com chave valor indica seu valor default --}}
<div class="register form-item mb-3">
    <label class="register form-label" for="title">
        {{ucwords($name)}}
    </label>
    <textarea class="register form-control" type="{{$type}}" name="{{$name}}" required {{$attributes}}>{{$slot??old($name)}}</textarea>

    @error($name)
    <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
    @enderror
</div>
