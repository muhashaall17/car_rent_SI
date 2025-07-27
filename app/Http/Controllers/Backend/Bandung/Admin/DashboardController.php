<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'super_admin') {
            // Kirim data ke view
            return view ('backend.bandung.dashboard.indexOwner', compact('role'));
        } elseif ($role === 'admin') {
            // Kirim data ke view
            return view ('backend.bandung.dashboard.index', compact('role'));
        } else {
            // Jika role tidak dikenali, kosongkan cabangs
            // Kirim data ke view
            return view('/', compact('role'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
