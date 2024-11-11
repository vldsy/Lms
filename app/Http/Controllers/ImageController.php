<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function index()
    {
        return Inertia::render('ImageUpload/Index', [
            'image' => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        // stores image to \public\images\

        /*
            Write Code Here for
            Store $imageName name in DATABASE from HERE
        */

        return Inertia::render('ImageUpload/Index', [
            'image' => $imageName,
        ]);
    }
}
