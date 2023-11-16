@extends('layouts.dashboard')

@section('page-title', 'Create a new Role')
 

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')


    <form action={{ route('dashboard.roles.store') }} method="post">    
        @csrf

        @include('dashboard.roles._form',['button_name'=>'Create'])

    </form>

@endsection
