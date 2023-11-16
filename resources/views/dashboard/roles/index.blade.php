@extends('layouts.dashboard')

@section('page-title','Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')

    <div class="mb-2">
        @can('categories.create')
        <a href="{{ route('dashboard.roles.create') }}" class="btn  btn-primary mr-3">Create</a>
        @endcan
 
     </div>

    <x-alert type='success' />

    

    <table class="table">
        <thead class="thead">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                
                <th scope="col">Created_AT</th>
                <th colspan="2"> </th>

            </tr>
        </thead>
        <tbody>

            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{  $role->name }}</td>
                    
                    <td>{{ \Carbon\Carbon::parse($role->created_at)->format('Y-m-d') }}</td>

                    <td>
                             
                        <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-outline-success">Edit</a>
 
                    </td>
                    <td>
                             
                        <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn  btn-outline-danger">Delete</button>
                        </form>
 
                    </td>

                </tr>
            @empty
                <td colspan="7">
                    <div class="alert alert-danger">
                        No Roles Found !
                    </div>
                </td>
            @endforelse

    </table>
    {{ $roles->withQueryString()->links() }}


@endsection
