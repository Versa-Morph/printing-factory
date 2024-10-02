<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::latest('id')->paginate(3)
        ]);
    }

    public function profile($id)
    {
        $data['user'] = User::find($id);

        return view('users.profile', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
                ->withSuccess('New user is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $input = $request->all();
 
        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
        
        $user->update($input);

        $user->syncRoles($request->roles);

        return redirect()->back()
                ->withSuccess('User is updated successfully.');
    }

    public function updateProfile(Request $request, $id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Validate the request data
            $request->validate([
                'username'      => 'required|string',
                'old_password'  => [
                    'nullable',
                    function ($attribute, $value, $fail) use ($request, $user) {
                        // Only check old password if new password is being set
                        if ($request->filled('new_password') && !Hash::check($value, $user->password)) {
                            $fail('The old password is incorrect.');
                        }
                    },
                ],
                'new_password'  => 'nullable|string|min:8|different:old_password',
                'email'         => 'required|email|unique:users,email,' . $user->id,
                'avatar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update user details
            $user->username = $request->input('username');
            $user->email = $request->input('email');

            // Check if old password matches before updating the password
            if ($request->filled('old_password') && $request->filled('new_password')) {
                if (Hash::check($request->input('old_password'), $user->password)) {
                    $user->password = bcrypt($request->input('new_password'));
                } else {
                    // Old password doesn't match, handle the error
                    return redirect()->back()->with('failed', "Old password doesn't match!");
                }
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/users/');
                $image->move($destinationPath, $name);
                $user->avatar = $name; // Assuming the column is named 'avatar'
            }

            $user->save();

            // Flash success message and redirect
            return redirect()->back()->with('success', "Update data profile successfully!");
        } catch (\Throwable $th) {
            // Flash error message and redirect on exception
            return redirect()->back()->with('failed', "Failed to update data profile!");
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
                ->withSuccess('User is deleted successfully.');
    }
}