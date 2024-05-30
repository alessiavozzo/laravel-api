<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ColorGenerator;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types=Type::all();
        return view('admin.types.index', compact('types'));
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
    public function store(StoreTypeRequest $request)
    {
        $validated=$request->validated();
        $slug=Str::slug($validated['name'], '-');
        $validated['slug'] = $slug;
        $color= ColorGenerator::randomColor();
        $validated['color'] = $color;
        Type::create($validated);
        return to_route('admin.types.index')->with('message', 'New type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        /* return view('admin.types.show', compact('type')); */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated=$request->validated();
        $slug=Str::slug($validated['name'], '-');
        $validated['slug'] = $slug;
        $type->update($validated);
        return to_route('admin.types.index')->with('message', "Type $type->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', "Type $type->name deleted successfully");
    }

    /* private function randomColor(){
        return '#' . dechex(rand(0, 10000000));
    } */
}

