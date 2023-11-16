@extends('layouts.dashboard')

@section('page-title', 'Your Projects')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Your Projects</li>
@endsection

@section('content')
    <div class="container">

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
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($projects)
                    @forelse ($projects as $project)
                        <tr>
                            <td>
                                {{ $project->id }}
                            </td>
                            <td>{{ $project->name }}
                            </td>
                            <td>
                                <a> {{ $project->deadline ?? 'No Deadline' }}
                                </a>
                            </td>
                            <td>
                                {{ $project->category->name }}
                            </td>
                            <td class="project-state">
                              <span class="badge badge-success">{{ $project->status }}</span>
               
                           </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert-danger">You have no projects</div>
                            </td>
                        </tr>
                    @endforelse
                @else
                    <tr>
                        <td colspan="5">
                            <div class="alert-danger">You Got No Projects</div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
 
@endsection
