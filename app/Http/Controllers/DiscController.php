<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disc;

class DiscController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit');

        if ($limit) {
            return response()->json(Disc::limit($limit)->get());
        }

        return response()->json(Disc::get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'speed' => 'required|string',
            'glide' => 'required|string',
            'turn' => 'required|string',
            'fade' => 'required|string',
            'image_url' => 'required|url',
        ]);

        $disc = Disc::create($request->all());

        return response()->json($disc);
    }

    public function show(Disc $disc)
    {
        return response()->json($disc);
    }

    public function update(Request $request, Disc $Disc)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'speed' => 'required|string',
            'glide' => 'required|string',
            'turn' => 'required|string',
            'fade' => 'required|string',
        ]);

        $Disc->update($request->all());

        return response()->json($Disc);
    }

    public function destroy(Disc $Disc)
    {
        $Disc->delete();

        return response()->json(['message' => 'Disc deleted']);
    }

}
