<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected $title = 'Peminjaman';
    protected $menu = 'loan';
    protected $directory = 'admin.loan';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['loans'] = Loan::with(['user', 'item'])->latest()->get();

        return view($this->directory . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['users'] = User::where('role', 'Siswa')->get();

        $data['items'] = Item::all();

        return view($this->directory . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date'
        ]);

        $item = Item::findOrFail($validatedData['item_id']);
        if ($item->condition === 'Rusak') {
            return redirect()->route('loan.create')->withInput()->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Barang dalam kondisi rusak dan tidak bisa dipinjam.'
            ]);
        }

        $isBorrowed = Loan::where('item_id', $validatedData['item_id'])->where('status', 'Dipinjam')->exists();

        if ($isBorrowed) {
            return redirect()->route('loan.create')->withInput()->with([
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Barang ini sedang dipinjam oleh orang lain.'
            ]);
        }

        $loan = Loan::create($validatedData);

        if ($loan) {
            return redirect()->route('loan.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Peminjaman berhasil ditambahkan!'
            ]);
        } else {
            return redirect()->route('loan.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data Peminjaman gagal ditambahkan!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $loan->load(['user', 'item.category']);
        $data['loan'] = $loan;

        return view($this->directory . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['loan'] = $loan;

        $data['users'] = User::where('role', 'Siswa')->get();

        $data['items'] = Item::all();

        return view($this->directory . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date'
        ]);

        if ($loan->item_id != $validatedData['item_id']) {
            $newItem = Item::findOrFail($validatedData['item_id']);

            if ($newItem->condition === 'Rusak') {
                return redirect()->back()->withInput()->with([
                    'status' => 'danger',
                    'title' => 'Gagal',
                    'message' => 'Barang baru yang dipilih dalam kondisi rusak.'
                ]);
            }

            $isBorrowed = Loan::where('item_id', $validatedData['item_id'])->where('status', 'Dipinjam')->exists();

            if ($isBorrowed) {
                return redirect()->back()->withInput()->with([
                    'status' => 'danger',
                    'title' => 'Gagal',
                    'message' => 'Barang baru yang dipilih sedang dipinjam.'
                ]);
            }
        }

        $updateProcess = $loan->update($validatedData);

        if ($updateProcess) {
            return redirect()->route('loan.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data peminjaman berhasil Diubah!'
            ]);
        } else {
            return redirect()->route('loan.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data peminjaman gagal Diubah!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $deleteProcess = $loan->delete();

        if($deleteProcess) {
            return redirect()->route('loan.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data peminjaman berhasil Dihapus!'
            ]);
        } else {
             return redirect()->route('loan.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data peminjaman gagal Dihapus!'
            ]); 
        }
    }

    public function returnItem(Loan $loan) {
        if($loan->status == 'Dikembalikan') {
            return redirect()->route('loan.index')->with([
                'status' => 'info',
                'title' => 'Informasi',
                'message' => 'Barang ini sudah dikembalikan.'
            ]);
        }

        $loan->status = 'Dikembalikan';
        $loan->actual_return_date = now();
        $updateProcess = $loan->save();

        if($updateProcess) {
            return redirect()->route('loan.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data telah berhasil dikembalikan!'
            ]);
        } else {
             return redirect()->route('loan.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'Proses pengembalian barang gagal!'
            ]); 
        }
    }
}
