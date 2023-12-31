<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Role;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('roles.view');

        $roles = Role::paginate(8) ;
        return view('dashboard.roles.index',compact('roles')) ;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('roles.create');

        $role=new Role() ;
        return view('dashboard.roles.create',compact('role')) ;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $request)
    {
        $role=Role::createWithAbilities($request) ;

        return redirect()->route('dashboard.roles.index')->with('success','Role Created Successfully') ;



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('roles.update');

        $role_abilities=$role->abilities()->pluck('type','ability')->toArray() ;
        // dd($role_abilities) ;
        return view('dashboard.roles.edit',compact('role','role_abilities')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolesRequest $request, Role $role)
    {
        $role->updateWithAbilities($request) ;

        return redirect()->route('dashboard.roles.index')->with('success','Role Updated Successfully') ;

    }

    /**
     * Remove the specified resource from storage.
     */
   
    public function destroy($id)
    {
        Gate::authorize('roles.delete');

        Role::destroy($id);
        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
