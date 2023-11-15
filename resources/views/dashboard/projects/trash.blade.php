@extends('layouts.dashboard')

@section('page-title','Trash Projects')
 



@section('breadcrumb')
    @parent
     <li class="breadcrumb-item active">Trash Projects</li>
@endsection


@section('content')

<div class="container"> 
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
   

<a href="{{ route('dashboard.projects.index') }}" class="btn  btn-primary  mb-2">Back</a>
 


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
            Deadline
          </th>
          <th style="width: 30%">
              Category
          </th>
          <th style="width: 30% ; text-align:center">
              Action
          </th>

      </tr>
  </thead>
  <tbody>
      @foreach ($projects as $project)
          <tr>
            <td>
              {{ $project->id }}
            </td>
            <td><a href={{ route('dashboard.projects.show',$project->id) }} >{{ $project->name }}</a></td>

              <td>
                  <a> {{ $project->deadline ?? 'No Deadline'}}
                </a>
              </td>
              
              <td>
               {{$project->category->name}}

            </td>

            <td class="project-actions text-right">
              <div class="row">
                  <div class="col">
                      <form style="display: inline" action="{{ route('dashboard.projects.trash.restore', $project->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button class="btn btn-info btn-sm" type="submit">
                              <i class="fas fa-trash"></i> Restore
                          </button>
                      </form>
                  </div>
                  <div class="col">
                      <form style="display: inline" action="{{ route('dashboard.projects.trash.delete', $project->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm" type="submit">
                              <i class="fas fa-trash"></i> Delete
                          </button>
                      </form>
                  </div>
              </div>
          </td>
          
          
          
          </tr>

          </td>
          </tr>
      @endforeach
  </tbody>
</table>

</div>
  {{ $projects->links() }}
<script>
  function confirmDelete(deleteUrl) {
      if (window.confirm('Are you sure you want to delete this Project?')) {
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