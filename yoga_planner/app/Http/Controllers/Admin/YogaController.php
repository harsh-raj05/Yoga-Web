<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YogaSession;

class YogaController extends Controller
{
    public function index()
    {
        $yoga = YogaSession::all();
        return view('admin.yoga.index', compact('yoga'));
    }

    public function create()
    {
        return view('admin.yoga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'goal' => 'required',
            'level' => 'required',
            'duration' => 'required|integer'
        ]);

        YogaSession::create($request->all());

        return redirect()->route('admin.yoga')->with('success', 'Yoga added!');
    }

    public function destroy($id)
    {
        YogaSession::findOrFail($id)->delete();
        return back()->with('success', 'Deleted successfully');
    }
}
