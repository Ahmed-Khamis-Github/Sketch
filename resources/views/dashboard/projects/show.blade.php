@extends('layouts.dashboard')

@section('page-title','Show Project Information')


@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Projects</a></li>
     <li class="breadcrumb-item active">Show</li>
@endsection


@section('content')
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
            <th style="width: 30%">
                Description
            </th>
            <th style="width: 8%">
                Status
            </th>
            
  
        </tr>
    </thead>
    <tbody>
             <tr>
              <td>
                {{ $project->id }}
              </td>
              <td>{{ $project->name }}</td>
  
                <td>
                    <a> {{ $project->deadline ?? 'No Deadline' }}
                  </a>
                </td>
                
                <td>
                 {{$project->category->name}}
  
              </td>
              <td>
                {{$project->description}}
 
             </td>

             <td class="project-state">
                <span class="badge badge-success">{{ $project->status }}</span>
 
             </td>
  
            
            </tr>
  
            </td>
            </tr>
     </tbody>
  </table>

@endsection