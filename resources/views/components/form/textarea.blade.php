@props([
    'name', 'value'=>''
])

<textarea
 class="form-control" 
 name="{{$name}}"
 id="Description" 
 rows="3">
{{ old($name, $value) }}
</textarea>

@error($name)
    <div class="text-danger">
        {{ $message }}
    </div>
@enderror