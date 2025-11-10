<?php

namespace App\Http\Controllers;

use App\Models\CompanyStatistic;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStatisticRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = CompanyStatistic::orderByDesc('id')->paginate(10);
        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatisticRequest $request)
    {
        DB::transaction(function() use($request){
            $validated = $request->validated();

            if($request->hasFile('icon')){
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            CompanyStatistic::create($validated);
        });

        return redirect()->route('admin.statistics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyStatistic $companyStatistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyStatistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyStatistic $statistic)
    {
        DB::transaction(function() use($request, $statistic) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'goal' => 'required|string|max:255',
                'icon' => 'sometimes|image|mimes:png,jpg,jpeg|max:2048',
            ]);

            if($request->hasFile('icon')) {
                // Hapus icon lama jika ada
                if($statistic->icon && Storage::disk('public')->exists($statistic->icon)) {
                    Storage::disk('public')->delete($statistic->icon);
                }
                
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $statistic->update($validated);
        });

        return redirect()->route('admin.statistics.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyStatistic $statistic)
    {
        DB::transaction(function() use ($statistic) {
            // Hapus file icon saat delete
            if($statistic->icon && Storage::disk('public')->exists($statistic->icon)) {
                Storage::disk('public')->delete($statistic->icon);
            }
            $statistic->delete();
        });
        return redirect()->route('admin.statistics.index');
    }
}