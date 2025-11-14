<?php

namespace App\Http\Controllers;

use App\Models\OurPrinciple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePrincipleRequest;

class OurPrincipleController extends Controller
{
    public function index()
    {
        $principles = OurPrinciple::orderByDesc('id')->paginate(10);
        return view('admin.principles.index', compact('principles'));
    }

    public function create()
    {
        return view('admin.principles.create');
    }

    public function store(StorePrincipleRequest $request)
    {
        DB::transaction(function() use($request){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            if($request->hasFile('icon')){
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            OurPrinciple::create($validated);
        });
        
        return redirect()->route('admin.principles.index');
    }

    public function show($id)
    {
        $principle = OurPrinciple::findOrFail($id);
        return view('admin.principles.show', compact('principle'));
    }

    public function edit($id)
    {
        $principle = OurPrinciple::findOrFail($id);
        return view('admin.principles.edit', compact('principle'));
    }

    public function update(Request $request, $id)
    {
        $principle = OurPrinciple::findOrFail($id);
        
        DB::transaction(function() use($request, $principle) {
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'subtitle' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if($request->hasFile('thumbnail')) {
                if($principle->thumbnail) {
                    Storage::delete('public/' . $principle->thumbnail);
                }
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            } else {
                $validated['thumbnail'] = $principle->thumbnail;
            }

            if($request->hasFile('icon')) {
                if($principle->icon) {
                    Storage::delete('public/' . $principle->icon);
                }
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            } else {
                $validated['icon'] = $principle->icon;
            }

            $principle->update($validated);
        });

        return redirect()->route('admin.principles.index');
    }

    public function destroy($id)
    {
        $principle = OurPrinciple::findOrFail($id);
        
        DB::transaction(function() use ($principle){
            if($principle->thumbnail) {
                Storage::delete('public/' . $principle->thumbnail);
            }
            if($principle->icon) {
                Storage::delete('public/' . $principle->icon);
            }
            
            $principle->delete();
        });
        
        return redirect()->route('admin.principles.index');
    }
}