<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeditationSession;

class MeditationController extends Controller
{
    public function index()
    {
        $meditation = MeditationSession::all();
        return view('admin.meditation.index', compact('meditation'));
    }

    public function create()
    {
        return view('admin.meditation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'duration' => 'required|integer'
        ]);

        MeditationSession::create($request->all());

        return redirect()->route('admin.meditation')->with('success', 'Meditation added!');
    }

    public function destroy($id)
    {
        MeditationSession::findOrFail($id)->delete();
        return back()->with('success', 'Deleted successfully');
    }
}