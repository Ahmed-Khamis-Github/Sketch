@extends('layouts.dashboard')

@section('page-title')
Categories    

@endsection



@section('breadcrumb')
    @parent
     <li class="breadcrumb-item active">categories</li>
@endsection


@section('content')

<div class="container"> 
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
   

<a href="{{ route('dashboard.categories.create') }}" class="btn  btn-primary  mb-2">create</a>


<table class="table table-striped projects">

  <thead>
      <tr>
          <th style="width: 5%">
            #
          </th>
          <th style="width: 20%">
              Name
          </th>
          <th style="width: 30%">
              Description
          </th>
          <th style="width: 30%">
              Created At
          </th>
          <th style="width: 30% ; text-align:center">
              Action
          </th>

      </tr>
  </thead>
  <tbody>
      @foreach ($categories as $category)
          <tr>
            <td>
              {{ $category->id }}
            </td>
            <td><a href={{ route('dashboard.categories.show',$category->id) }} >{{ $category->name }}</a></td>

              <td>
                  <a> {{ Str::limit($category->description, 20, '...') }}
                </a>
              </td>
              
              <td>
               {{ $category->created_at }}

            </td>

              <td class="project-actions text-center  p-0">

                  <a class="btn btn-info btn-sm" href="{{ route('dashboard.categories.edit', $category->id) }}">
                      <i class="fas fa-pencil-alt mr-1">
                      </i>
                      Edit
                  </a>

                  

                  <form method="post" action="{{ route('dashboard.categories.destroy', $category->id) }}"
                      style="display: inline-block ; margin:0">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm"
                      onclick="confirmDelete('{{ route('dashboard.categories.destroy', $category->id) }}')">
                          <i class="fas fa-trash mr-1">
                          </i>Delete</button>
                  </form>


              </td>
          </tr>

          </td>
          </tr>
      @endforeach
  </tbody>
</table>

</div>
  {{ $categories->links() }}
<script>
  function confirmDelete(deleteUrl) {
      if (window.confirm('Are you sure you want to delete this Category?')) {
          var form = document.createElement('form');
          form.setAttribute('method', 'POST');
          form.setAttribute('action', deleteUrl);
          var csrfField = document.createElement('input');
          csrfField.setAttribute('type', 'hidden');
          csrfField.setAttribute('name', '_token');
          csrfField.setAttribute('value', '{{ csrf_token() }}');
          var methodField = document.createElement('input');
          methodField.setAttribute('type', 'hidden');
          methodField.setAttribute('name', '_method');
          methodField.setAttribute('value', 'DELETE');
          form.appendChild(csrfField);
          form.appendChild(methodField);
          document.body.appendChild(form);
          form.submit();
      }
  }
</script>
    
@endsection