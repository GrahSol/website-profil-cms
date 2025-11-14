<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Http\Requests\StoreHeroSectionRequest;
use App\Http\Requests\UpdateHeroSectionRequest;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero_sections = HeroSection::orderByDesc('id')->paginate(10);
        return view('admin.hero_sections.index', compact('hero_sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeroSectionRequest $request)
    {
        DB::transaction(function() use($request){
            $validated = $request->validated();

            if($request->hasFile('banner')){
                $bannerPath = $request->file('banner')->store('banners', 'public');
                $validated['banner'] = $bannerPath;
            }

            HeroSection::create($validated);
        });

        return redirect()->route('admin.hero_sections.index')
                         ->with('success', 'Hero section created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSection $heroSection)
    {
        return view('admin.hero_sections.show', compact('heroSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSection $heroSection)
    {
        return view('admin.hero_sections.edit', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $heroSection)
    {
        DB::transaction(function() use($request, $heroSection){
            
            $validated = $request->validate([
                'heading' => 'required|string|max:255',
                'subheading' => 'nullable|string',
                'achievement' => 'nullable|string|max:255',
                'path_video' => 'nullable|url',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Handle banner upload
            if($request->hasFile('banner')) {
                // Delete old banner
                if($heroSection->banner) {
                    Storage::delete('public/' . $heroSection->banner);
                }
                
                // Store new banner
                $bannerPath = $request->file('banner')->store('banners', 'public');
                $validated['banner'] = $bannerPath;
            } else {
                // Keep existing banner if no new file uploaded
                $validated['banner'] = $heroSection->banner;
            }

            $heroSection->update($validated);
        });

        return redirect()->route('admin.hero_sections.index')
                         ->with('success', 'Hero section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $heroSection)
    {
        DB::transaction(function() use ($heroSection){
            // Delete banner file if exists
            if($heroSection->banner) {
                Storage::delete('public/' . $heroSection->banner);
            }
            
            $heroSection->delete();
        });

        return redirect()->route('admin.hero_sections.index')
                         ->with('success', 'Hero section deleted successfully!');
    }
}