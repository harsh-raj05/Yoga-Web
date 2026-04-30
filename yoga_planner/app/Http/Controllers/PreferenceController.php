<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;

class PreferenceController extends Controller
{
    public function create()
    {
        $preference = Preference::where('user_id', auth()->id())->first();
        return view('preferences', compact('preference'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'age' => 'required|integer|min:10|max:100',
            'goal' => 'required',
            'experience_level' => 'required',
            'available_time' => 'required|integer|min:5|max:180',
        ]);

        Preference::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'age' => $request->age,
                'goal' => $request->goal,
                'experience_level' => $request->experience_level,
                'available_time' => $request->available_time,
            ]
        );

        return redirect('/dashboard')->with('success', 'Preferences saved successfully!');
    }
}