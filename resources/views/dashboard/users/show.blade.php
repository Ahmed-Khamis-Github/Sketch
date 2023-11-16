@extends('layouts.dashboard')

@section('page-title','Show User Information')


@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
     <li class="breadcrumb-item active">Show</li>
@endsection


@section('content')
<a href="{{ route('dashboard.users.index') }}" class="btn  btn-primary  mb-2">Back</a>


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
              Email
          </th>
          <th style="width: 30%">
              Image
          </th>

           <th style="width: 30%">
              Created At
          </th>
          

      </tr>
  </thead>
  <tbody>
           <tr>
            <td>
              {{ $user->id }}
            </td>
            <td>{{ $user->name }}</td>

              <td>
                  <a>{{ $user->email }}</a>
              </td>
             <td>
                @if($user->image)
                <img src="{{ asset('uploads/'.$user->image) }}" alt="" height="200px">
                @else
                <img src="https://winaero.com/blog/wp-content/uploads/2017/12/User-icon-256-blue.png" alt="" height="50px">
            @endif
             </td>
             <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>


            
          </tr>

    </tbody>
</table>


@endsection