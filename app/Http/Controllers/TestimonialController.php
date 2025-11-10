<?php

namespace App\Http\Controllers; 

use App\Models\Testimonial;
use App\Models\ProjectClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTestimonialRequest;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('client')->orderByDesc('id')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $clients = ProjectClient::orderByDesc('id')->get();
        return view('admin.testimonials.create', compact('clients'));
    }

    public function store(StoreTestimonialRequest $request)
    {
        DB::transaction(function() use($request){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }
            
            Testimonial::create($validated);
        });

        return redirect()->route('admin.testimonials.index');
    }

    public function show(Testimonial $testimonial)
    {
        //
    }

    public function edit(Testimonial $testimonial)
    {
        $clients = ProjectClient::orderByDesc('id')->get();
        return view('admin.testimonials.edit', compact('testimonial', 'clients'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        DB::transaction(function() use($request, $testimonial){
            $validated = $request->validate([
                'message' => ['required', 'string', 'max:255'],
                'project_client_id' => ['required', 'integer'],
                'thumbnail' => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            ]);

            if($request->hasFile('thumbnail')){
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }
            
            $testimonial->update($validated);
        });

        return redirect()->route('admin.testimonials.index');
    }

    public function destroy(Testimonial $testimonial)
    {
        DB::transaction(function() use ($testimonial){
            $testimonial->delete();
        });
        return redirect()->route('admin.testimonials.index');
    }
}