<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $user = Auth::user();
        $role = $user->role;

        return view('backend.bandung.user.index', compact('users', 'role'));
    }

    public function getUser(Request $request)
    {
        // $idDriver = $request->input('id');

        // Query untuk ambil user
        $getDriver = DB::table('users as us')
            ->leftJoin('cabang as cb', 'cb.id', '=', 'us.cabang_id')
            ->select(
                'us.id',
                'us.name',
                'us.username',
                'us.email',
                'us.role',
                'cb.nama_cabang'
            )
            ->get();

        return response()->json(['data' => $getDriver]);
    }
}
