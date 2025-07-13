<?php

namespace App\Http\Controllers\Backend\Bandung\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalItem;

class RentalItemController extends Controller
{
    public function index()
    {
        $rental_item = RentalItem::all();
        return view('backend.bandung.rental_item.index', compact('rental_item'));
    }
}
