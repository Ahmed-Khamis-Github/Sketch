@extends('layouts.dashboard')

@section('page-title','Create A New User')

 

@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
     <li class="breadcrumb-item active">create</li>
@endsection

  @section('content')
	<form action="{{ route('dashboard.users.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="card-body">
			<div class="form-group">
				<label for="cateName">Name</label>
				<input type="text" name="name" class="form-control" id="cateName" placeholder="Name" value="{{ old('name') }}">
				@error('name')
					<div style="color: red; font-weight: bold"> {{ $message }}</div>
				@enderror
			</div>

            <div class="form-group">
				<label for="Email">Email</label>
				<input type="email" name="email" class="form-control" id="Email" placeholder="Email" value="{{ old('email') }}">
				@error('email')
					<div style="color: red; font-weight: bold"> {{ $message }}</div>
				@enderror
			</div>


            <div class="form-group">
				<label for="Password">Passowrd</label>
				<input type="password" name="password" class="form-control" id="Password" placeholder="Password" value="{{ old('password') }}">
				@error('password')
					<div style="color: red; font-weight: bold"> {{ $message }}</div>
				@enderror
			</div>
			 

            <div class="form-group">
				<label for="Password">Confim Password</label>
				<input type="password" name="password_confirmation" class="form-control" id="Password" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
				@error('password_confirmation')
					<div style="color: red; font-weight: bold"> {{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="exampleInputFile">File input</label>
				<div class="input-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="exampleInputFile" name="image">
						<label class="custom-file-label" for="exampleInputFile">Choose file</label>
					</div>
					<div class="input-group-append">
						<span class="input-group-text">Upload</span>
					</div>
				</div>
				<li class="list-inline-item">
					<img id="previewImage"  src="" height="80px">
				</li>
			</div>


			<button type="submit" class="btn btn-primary mt-2">Create</button>

			 
			 
		</div>
		<!-- /.card-body -->
		 
	</form>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		// Function to preview the uploaded image
		function previewImage(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#previewImage').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
	
		// Event listener to trigger the image preview when a file is selected
		$("#exampleInputFile").change(function() {
			previewImage(this);
		});
	</script>
@endsection



 