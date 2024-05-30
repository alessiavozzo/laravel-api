<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\Type;
use App\Helpers\ColorGenerator;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies=Technology::orderByDesc('id')->paginate(7);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $validated = $request->validated();

        $slug = Str::slug($validated['name'], '-');
        $validated['slug'] = $slug;

        $color = ColorGenerator::randomColor();
        $validated['color'] = $color;
        
        Technology::create($validated);

        return to_route('admin.technologies.index')->with('message', 'New technology created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        $projects = $technology->projects()->orderBy('id', 'desc')->get();
        $types=Type::all();
        return view('admin.technologies.show', compact('technology', 'projects', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {       

        $validated = $request->validated();
        $slug = Str::slug($validated['name'], '-');
        $validated['slug'] = $slug;
        $technology->update($validated);
        return to_route('admin.technologies.index')->with('message', "Technology $technology->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', "Type $technology->name deleted successfully");
    }
}
