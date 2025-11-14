<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTeamRequest;

class OurTeamController extends Controller
{
    public function index()
    {
        $teams = OurTeam::orderByDesc('id')->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(StoreTeamRequest $request)
    {
        DB::transaction(function() use($request){
            $validated = $request->validated();

            if($request->hasFile('avatar')){
                $avatarPath = $request->file('avatar')->store('avatar', 'public');
                $validated['avatar'] = $avatarPath;
            }

            OurTeam::create($validated);
        });

        return redirect()->route('admin.teams.index');
    }

    public function show(OurTeam $ourTeam)
    {
        //
    }

    public function edit(OurTeam $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, OurTeam $team)
    {
        DB::transaction(function() use($request, $team) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if($request->hasFile('avatar')) {
                if($team->avatar) {
                    Storage::delete('public/' . $team->avatar);
                }
                $avatarPath = $request->file('avatar')->store('avatar', 'public');
                $validated['avatar'] = $avatarPath;
            } else {
                $validated['avatar'] = $team->avatar;
            }

            $team->update($validated);
        });

        return redirect()->route('admin.teams.index');
    }

    public function destroy(OurTeam $team)
    {
        DB::transaction(function() use ($team){
            $team->delete();
        });
        return redirect()->route('admin.teams.index');
    }
}