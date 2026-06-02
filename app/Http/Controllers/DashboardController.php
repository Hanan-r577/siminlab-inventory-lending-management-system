<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $menu = 'dashboard';
    protected $directory = 'admin.dashboard';

    public function index() {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        $data['total_siswa'] = User::where('role', 'Siswa')->count();
        $data['total_item'] = Item::count();
        $data['total_loan'] = Loan::where('status', 'Dipinjam')->count();

        return view('admin.dashboard' . '.index', $data);
    }

    public function profile() {
        $data['title'] = 'Profil Saya';
        $data['menu'] = 'profil';

        $data['loans'] = Loan::where('user_id', Auth::id())->with('item')->latest()->get();

        return view('student.profile', $data);
    }
}
