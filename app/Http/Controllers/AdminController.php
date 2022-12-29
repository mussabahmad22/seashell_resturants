<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Seashell;

class AdminController extends Controller
{

    public function logout()
    {

        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function users()
    {
        $query = Seashell::all();
        return view('users', compact('query'));
    }

    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users-seashell.xlsx');
    }

    public function delete(Request $request)
    {
        $query_id = $request->delete_seashell_id;
        $seashell = Seashell::findOrFail($query_id);
        $seashell->delete();
        return redirect()->back()->with('error', 'Data Deleted successfully');
    }
   



}
