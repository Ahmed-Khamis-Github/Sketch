<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =User::paginate(8) ;
    
        return view('dashboard.users.index',compact('users')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
         
        $image = $this->uploadImage($request);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image'=>$image
        ]);

        


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
        return view('dashboard.users.edit',compact('user')) ;
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

        return redirect()->route('dashboard.users.index')->with('success','User Updated Successfully') ;
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( User $user)
    {
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
}
