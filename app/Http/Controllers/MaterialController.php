<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = Material::where("active", true)->OfSearch($request->input('search'))
            ->orderByDesc('id')->paginate(10)->withQueryString();
        $categorycount = Material::count();
        return view('material.index', compact('materials', 'categorycount'));
    }
    public function create()
    {
        return view('material.create');
    }
    public function store(MaterialRequest $request)
    {
        Material::create($request->validated());
        return redirect()
            ->route('material.index')
            ->with('success', 'مادە زیادکرا بە سەرکەوتووی');
    }

    public function edit(Material $material)
    {
        return view('material.edit', compact('material'));
    }

    public function update(MaterialRequest $request, Material $material)
    {

        $material->update($request->validated());
        return redirect()
            ->route('material.index')
            ->with('success', 'مادەکە تازەکرایەوە بە سەرکەوتووی');
    }

    public function destroy(Material $material)
    {
        $material->active = false;
        $material->update();
        return redirect()->back()->with('success', 'مادەکە سڕایەوە بە سەرکەوتووی');
    }
}
