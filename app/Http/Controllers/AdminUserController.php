<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [            
            'title' => 'Manajemen User',
            'user' => User::with('roles')->get(),
            'content' => 'admin.user.index'
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'roles' => Role::all(), // Fetch all roles
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            're_password' => 'required|same:password',
            'role' => 'required|exists:roles,name', // Validate role
        ]);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Create the user
        $user = User::create($data);

        // Assign the role
        $user->assignRole($data['role']);

        return redirect('/admin/user')->with('success', 'Data Telah ditambahkan!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $data = [
            'user' => $user,
            'roles' => Role::all(), // Get all available roles
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        // Validate the input
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            're_password' => 'same:password',
            'role' => 'required|exists:roles,name', // Validate role
        ]);

        // Update password if provided
        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;    
        }

        // Update the user
        $user->update($data);

        // Sync the role (update the user’s role)
        $user->syncRoles($data['role']);

        return redirect('/admin/user')->with('success', 'Data Telah diedit!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user')->with('success', 'Data Telah dihapus!!');
    }
}

