<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $title = 'Users';
    protected $menu = 'users';
    protected $directory = 'admin.users';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['users'] = User::where('role', operator: 'Siswa')->latest()->get();

        return view($this->directory . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        return view($this->directory . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if($user) {
            return redirect()->route('users.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil ditambahkan!'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal ditambahkan!'
            ]);
        }
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
    public function edit(string $id)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['user'] = User::findOrFail($id);

        return view($this->directory . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:5',
            'role' => 'required'
        ]);

        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role']
        ];

        if($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $updateProcess = $user->update($updateData);

        if($updateProcess) {
            return redirect()->route('users.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Diubah!'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal Diubah!'
            ]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if($user) {
            $user->delete();

            return redirect()->route('users.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Dihapus!'
            ]);
        } else {
             return redirect()->route('users.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal Dihapus!'
            ]); 
        }
    }
}
