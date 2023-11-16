@extends('layouts.dashboard')

@section('page-title','Update Category')



@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

  @section('content')
	<form action="{{ route('dashboard.categories.update',$category->id) }}" method="POST">
		@csrf
		@method('put')
		<div class="card-body">
			<div class="form-group">
				<label for="cateName">Name</label>
				<input type="text" name="name" class="form-control" id="cateName" placeholder="Name" value="{{ old('name',$category->name) }}">
				@error('name')
					<div style="color: red; font-weight: bold"> {{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Description</label>
				<textarea class="form-control" name="description" id="exampleFormControlTextarea1"  placeholder="Enter The Description" rows="3">{{ old('description',$category->description) }}</textarea>
				@error('description')
				<div style="color: red; font-weight: bold"> {{ $message }}</div>
			@enderror
			  </div>

           


			<button type="submit" class="btn btn-primary mt-2">Update</button>

			 
			 
		</div>
		<!-- /.card-body -->
		 
	</form>
 
	 
@endsection



 