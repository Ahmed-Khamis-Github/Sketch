@extends('layouts.dashboard')

@section('page-title')
Users    

@endsection



@section('breadcrumb')
    @parent
     <li class="breadcrumb-item active">users</li>
@endsection


@section('content')

<div class="container"> 
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
   

<a href="{{ route('dashboard.users.create') }}" class="btn  btn-primary  mb-2">create</a>
<a href="{{ route('dashboard.user.assignments') }}" class="ml-2 btn  btn-secondary  mb-2">Assign For Project</a>

 
<div class="container-fluid mb-2">
    <h2 class="text-center display-6">Search</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form  action="{{ URL::current() }}" method="GET">
                <div class="input-group">

                    <input type="search" class="form-control form-control-lg" name="search" value="{{ request('search') }}"
                        placeholder="Search For User">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<table class="table table-striped projects">

  <thead>
      <tr>
          <th style="width: 1%">
            #
          </th>
          <th style="width: 20%">
              Name
          </th>
          <th style="width: 30%">
              Email
          </th>
          <th style="width: 5%">
              Image
          </th>
          <th style="width: 30% ; text-align:center">
              Action
          </th>

      </tr>
  </thead>
  <tbody>
      @foreach ($users as $user)
          <tr>
            <td>
              {{ $user->id }}
            </td>
            <td><a href={{ route('dashboard.users.show',$user->id) }} >{{ $user->name }}</a></td>

              <td>
                  <a>{{ $user->email }}</a>
              </td>
              
              <td>
                @if($user->image)
                <img src="{{ asset('uploads/'.$user->image) }}" alt="" height="100px">
                @else
                <img src="https://winaero.com/blog/wp-content/uploads/2017/12/User-icon-256-blue.png" alt="" height="50px">
            @endif

            </td>

              <td class="project-actions text-center  p-0">

                  <a class="btn btn-info btn-sm" href="{{ route('dashboard.users.edit', $user->id) }}">
                      <i class="fas fa-pencil-alt mr-1">
                      </i>
                      Edit
                  </a>

                 

                  <form method="post" action="{{ route('dashboard.users.destroy', $user->id) }}"
                      style="display: inline-block ; margin:0">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm"
                      onclick="confirmDelete('{{ route('dashboard.users.destroy', $user->id) }}')">
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
  {{ $users->links() }}
<script>
  function confirmDelete(deleteUrl) {
      if (window.confirm('Are you sure you want to delete this User?')) {
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