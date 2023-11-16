@extends('layouts.dashboard')

@section('page-title','Assign User For a Project')

 

@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
     <li class="breadcrumb-item active">Assign</li>
@endsection

  @section('content')
  <form method="post" action="{{ route('dashboard.user.assign') }}" class="mt-3">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="project_id">Select Project:</label>
                <select name="project_id" id="project_id" class="form-control">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Assign User to Project</button>
</form>
 
	 
@endsection



 