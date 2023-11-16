<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('users.view');
        
        $request = request();

        $users =User::search($request->query())->paginate(8) ;
    
        return view('dashboard.users.index',compact('users')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('users.create');

        $roles = Role::all() ;
        return view('dashboard.users.create',compact('roles')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
         
        $image = $this->uploadImage($request);

       $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image'=>$image
        ]);

        $user->roles()->attach($request->roles)  ;
        


         return redirect()->route('dashboard.users.index')->with('success','User Added Successfully') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.users.show',compact('user')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('users.update');

        $roles = Role::all();
        $user_roles = $user->roles()->pluck('id')->toArray();
        
        return view('dashboard.users.edit',compact('user','roles','user_roles')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        $old_image = $user->image;
        // dd($old_image) ;

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);


        if ($old_image && $data['image'] == null) {
            $data['image'] = $old_image;
        }

 
        if ($old_image && $old_image != $data['image']) {
             Storage::disk('uploads')->delete($old_image);
        }

        if( empty( $data['password'] ) && empty( $data['password_confirmation'] )  ){
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $user->update($data) ;
        $user->roles()->sync($request->roles);

        return redirect()->route('dashboard.users.index')->with('success','User Updated Successfully') ;
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( User $user)
    {
        Gate::authorize('users.delete');

        if ($user->image) {
            Storage::disk('uploads')->delete($user->image);
        }
        $user->delete() ;
        return redirect()->route('dashboard.users.index')->with('success','User Deleted Successfully') ;

    }


    protected function uploadImage(Request $request)
    {

        if (!$request->hasfile('image')) {

            return;
        }
        $file = $request->file('image');

        $path = $file->store('users', 'uploads');

        return $path;
    }


    public function userAssignments()
    {
        $users = User::all();
        $projects = Project::all();

        return view('dashboard.users.assign', compact('users', 'projects'));
    }

    public function assignUser(Request $request)
    {
        $userId = $request->input('user_id');
        $projectId = $request->input('project_id');

        $user = User::findOrFail($userId);
        $project = Project::findOrFail($projectId);

        $user->projects()->attach($project);

        return redirect()->route('dashboard.users.index')->with('success','User Assigned Successfully') ;
    }


    public function myProjects()
    {
        Gate::authorize('assign.view');

        $user = Auth::user();
         $projects = $user->projects;
 
        return view('dashboard.assigned-projects.index', compact('projects'));
    }
}
