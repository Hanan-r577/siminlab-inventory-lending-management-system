<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $title = 'Category';
    protected $menu = 'category';
    protected $directory = 'admin.category';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['categories'] = Category::latest()->get();

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
        ]);

        $category = Category::create($validatedData);

        if ($category) {
            return redirect()->route('category.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil ditambahkan!'
            ]);
        } else {
            return redirect()->route('category.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal ditambahkan!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['category'] = $category;

        return view($this->directory . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $updateProcess = $category->update($validatedData);

        if ($updateProcess) {
            return redirect()->route('category.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Diubah!'
            ]);
        } else {
            return redirect()->route('category.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal Diubah!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $deleteProcess = $category->delete();

        if ($deleteProcess) {
            return redirect()->route('category.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Dihapus!'
            ]);
        } else {
            return redirect()->route('category.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal Dihapus!'
            ]);
        }
    }
}
