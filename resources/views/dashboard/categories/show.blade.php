@extends('layouts.dashboard')

@section('page-title','Show Category Information')


@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">categories</a></li>
     <li class="breadcrumb-item active">Show</li>
@endsection


@section('content')
<a href="{{ route('dashboard.categories.index') }}" class="btn  btn-primary  mb-2">Back</a>


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
          

      </tr>
  </thead>
  <tbody>
           <tr>
            <td>
              {{ $category->id }}
            </td>
            <td>{{ $category->name }}</td>

              <td>
                  <a>{{ $category->description }}</a>
              </td>
           
              <td>{{ \Carbon\Carbon::parse($category->created_at)->format('Y-m-d') }}</td>


            
          </tr>

    </tbody>
</table>


@endsection