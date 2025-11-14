<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAboutRequest;
use App\Models\CompanyAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = CompanyAbout::orderByDesc('id')->paginate(10);
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutRequest $request)
    {
        DB::transaction(function() use($request) {
            $validated = $request->validated();

            if($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newAbout = CompanyAbout::create($validated);

            if(isset($validated['keypoints']) && is_array($validated['keypoints'])) {
                foreach($validated['keypoints'] as $keypoint) {
                    if(!empty(trim($keypoint))) {
                        $newAbout->keypoints()->create([
                            'name' => $keypoint,  
                            'achievement' => '',
                            'thumbnail' => '',
                            'type' => ''
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.abouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyAbout $companyAbout)
    {
        // Jika tidak digunakan, bisa dikosongkan atau dihapus
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyAbout $companyAbout)
    {
        return view('admin.abouts.edit', compact('companyAbout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyAbout $companyAbout)
    {
        DB::transaction(function() use($request, $companyAbout) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'keypoints' => 'nullable|array',
                'keypoints.*' => 'nullable|string|max:255'
            ]);

            if($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama jika ada
                if($companyAbout->thumbnail && Storage::exists('public/' . $companyAbout->thumbnail)) {
                    Storage::delete('public/' . $companyAbout->thumbnail);
                }
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            } else {
                $validated['thumbnail'] = $companyAbout->thumbnail;
            }

            $companyAbout->update($validated);

            // Update keypoints
            if(isset($validated['keypoints']) && is_array($validated['keypoints'])) {
                // Hapus keypoints lama
                $companyAbout->keypoints()->delete();
                
                // Buat keypoints baru
                foreach($validated['keypoints'] as $keypoint) {
                    if(!empty(trim($keypoint))) {
                        $companyAbout->keypoints()->create([
                            'name' => $keypoint,
                            'achievement' => '',
                            'thumbnail' => '',
                            'type' => ''
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.abouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyAbout $about)
    {
        DB::transaction(function() use ($about){
            $about->delete();
        });
        return redirect()->route('admin.abouts.index');
    }
}