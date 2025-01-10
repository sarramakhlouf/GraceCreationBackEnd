<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index(Request $request)
    {
    $query = Admin::query();
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
    }
    $admins = $query; 
    return view('auth.admins.index', compact('admins'));
    }
}
