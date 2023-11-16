@extends('layouts.dashboard')

@section('page-title', 'Edit the Role')
 

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">roles</li>
    <li class="breadcrumb-item active">edit</li>
@endsection

@section('content')


    <form action={{ route('dashboard.roles.update', $role->id) }} method="post" enctype="multipart/form-data" >
        @csrf
        @method('put')

        @include('dashboard.roles._form',['button_name'=>'Update'])

    </form>

@endsection
