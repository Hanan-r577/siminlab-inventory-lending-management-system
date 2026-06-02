<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    protected $title = 'Item';
    protected $menu = 'item';
    protected $directory = 'admin.item';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['items'] = Item::with('category')->latest()->get();

        return view($this->directory . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['categories'] = Category::all();

        return view($this->directory . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'unique_code' => 'nullable|unique:items',
            'condition' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('photos'), $imageName);
            $validatedData['photo'] = $imageName;
        }

        $item = Item::create($validatedData);

        if ($item) {
            return redirect()->route('item.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Ditambahkan!'
            ]);
        } else {
            return redirect()->route('item.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal ditambahkan!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['item'] = $item;

        $data['categories'] = Category::all();

        return view($this->directory . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'unique_code' => 'nullable|unique:items,unique_code,' . $item->id,
            'condition' => 'required',
        ]);

        $updateData = $validatedData;

        if ($request->hasFile('photo')) {
            if ($item->photo && File::exists(public_path('photos/' . $item->photo))) {
                File::delete(public_path('photos/' . $item->photo));
            }

            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('photos'), $imageName);
            $updateData['photo'] = $imageName;
        }

        $updateProcess = $item->update($updateData);


        if ($updateProcess) {
            return redirect()->route('item.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Diubah!'
            ]);
        } else {
            return redirect()->route('item.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal Diubah!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if ($item->photo && File::exists(public_path('photos/' . $item->photo))) {
            File::delete(public_path('photos/' . $item->photo));
        }

        $deleteProcess = $item->delete();

        if ($deleteProcess) {
            return redirect()->route('item.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil Dihapus!'
            ]);
        } else {
            return redirect()->route('item.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal Dihapus!'
            ]);
        }
    }
}
