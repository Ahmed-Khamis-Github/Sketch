  
    @if(session()->has($type))
    <div class="mb-2">
        <div class="alert alert-success">
            {{session($type) }}
        </div>
    </div>
    @endif
 