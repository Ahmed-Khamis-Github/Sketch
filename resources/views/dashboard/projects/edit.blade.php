@extends('layouts.dashboard')

@section('page-title','Update Porject')

 

@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.projects.index') }}">Projects</a></li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

  @section('content')
	<form action="{{ route('dashboard.projects.update',$project->id) }}" method="POST">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="form-group">
				<label for="cateName">Name</label>
				<input type="text" name="name" class="form-control" id="cateName" placeholder="Name" value="{{ old('name',$project->name) }}">
				@error('name')
					<div style="color: red; font-weight: bold"> {{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Description</label>
				<textarea class="form-control" name="description" id="exampleFormControlTextarea1"  placeholder="Enter The Description" rows="3">{{ old('description',$project->description) }}</textarea>
				@error('description')
				<div style="color: red; font-weight: bold"> {{ $message }}</div>
			@enderror
			  </div>

			  <div class="form-group">
				<label for="Category_Name">Category</label>
									  <select class="form-control"  name="category_id">
 										  @foreach ($categories as $category)
											  <option value="{{ $category->id }}"  @selected(@old('category_id',$project->category_id) == $category->id)>{{ $category->name }}
											  </option>
										  @endforeach
									  </select>
			  </div>
			  @error('category_id')
			  <div style="color: red; font-weight: bold"> {{ $message }}</div>
		  @enderror
			  <div class="form-group">
				<label for="deadline">Deadline:</label>
				<input type="date" class="form-control" id="deadline" name="deadline" placeholder="Select deadline" value="{{ old('deadline',$project->deadline) }}">
			</div>
			@error('deadline')
			<div style="color: red; font-weight: bold"> {{ $message }}</div>
		@enderror
			
		<div class="form-group">
			<label for="status">Status:</label>
			<select class="form-control" id="status" name="status">
				<option value="Pending" @selected(old('status',$project->status)=="Pending")>Pending</option>
				<option value="In Progress" @selected(old('status',$project->status)=="In Progress")>In Progress</option>
				<option value="Completed" @selected(old('status',$project->status)=="Completed")>Completed</option>
			</select>
		</div>
		@error('status')
			<div style="color: red; font-weight: bold"> {{ $message }}</div>
		@enderror
           


			<button type="submit" class="btn btn-primary mt-2">Update</button>

			 
			 
		</div>
		<!-- /.card-body -->
		 
	</form>
 
	 
@endsection



 