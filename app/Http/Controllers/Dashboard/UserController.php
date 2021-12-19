<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if(auth()->user()->cannot('read users')) {
            return abort(403);
        }

        $users = User::where([
            [function ($query) use ($request) {
                if($term = $request->search){
                    $query->where('first_name' , 'LIKE', '%' . $term . '%')
                        ->orWhere('last_name' , 'LIKE', '%' . $term . '%')
                        ->orWhereRaw("concat(first_name, ' ', last_name) like '%{$term}%' ");
                }
            }]
        ])
            ->latest()
            ->paginate(2);



        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->cannot('create users')) {
            return abort(403);
        }

        $roles = Role::all();

        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'password' => 'required|string|max:255|password|confirmed',
            'role_name' => 'nullable|string|max:255'
        ]);

        $requestData = $request->except('_token', 'password', 'password_confirmation');

        $passHashed = Hash::make($request->password);

        $requestData['password'] = $passHashed;

        $user = User::create($requestData);

        $request->role_name ? $user->assignRole($request->role_name) : false;

        session()->flash('success', __('User Successfully Created !'));

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        if(auth()->user()->cannot('update users')) {
            return abort(403);
        }

        $roles = Role::all();

        $userRole = $user->getRoleNames()->isEmpty() ? 'customer' : $user->getRoleNames()[0];

        return view('dashboard.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'role_name' => 'nullable|string|max:255'
        ]);

        $requestData = $request->except(['_token', '_method']);

        $user->update($requestData);

        if($request->role_name) {
            $user->syncRoles([$request->role_name]);
        }

        session()->flash('success', __('User Successfully Updated !'));

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        $user->delete();

        session()->flash('success', __('Successfully Deleted !'));

        return redirect()->route('dashboard.users.index');
    }
}
