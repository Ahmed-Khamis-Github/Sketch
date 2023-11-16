{{-- <select 
name="{{ $name }}" 
{{ $attributes->class([
    'form-control' ,
    'form-select' ,
    'is-invalid'=>$errors->has($name)
])  }}
>
@foreach ($options as $value=>$text )
<option value="{{ $value }}" @selected($value==$selected)>{{ $text }}</option>
    
@endforeach
</select>  --}}

{{-- <x-form-feedback :name="$name" /> --}}
 


<div class="form-group">
     <select class="custom-select @error('{{ $name }}') is-invalid @enderror" name="{{ $name }}">
         @foreach ($options as $value=>$text)
            <option value="{{$value }}" @selected($value==$selected)>{{ $text }}</option>
        @endforeach
    </select>
    @error('{{ $name }}')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>