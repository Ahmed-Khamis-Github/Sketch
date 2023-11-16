@props([
    'type'=>'text' ,
    'name' ,
    'value'=>''  
])


<input
  type="{{ $type  }}" 
  class="form-control @error($name) is-invalid @enderror"
  name="{{ $name }}"
  value="{{ old( $name, $value) }}"
  {{ $attributes }}
  >

@error($name)
    <div class="text-danger">
        {{ $message }}
    </div>
@enderror
