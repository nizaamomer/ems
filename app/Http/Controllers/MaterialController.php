<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use App\Services\ActivityService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = Material::where("active", true)->OfSearch($request->input('search'))
            ->orderByDesc('id')->paginate(15)->withQueryString();
        $categorycount = Material::count();
        ActivityService::log('Material', 'Viewed Material List', auth()->id());

        return view('material.index', compact('materials', 'categorycount'));
    }
    public function create()
    {
        ActivityService::log('Material', 'Viewed Material Create Form', auth()->id());

        return view('material.create');
    }
    public function store(MaterialRequest $request)
    {
        Material::create($request->validated());
        ActivityService::log('Material', 'Created Material', auth()->id());

        return redirect()
            ->route('material.index')
            ->with('success', 'مادە زیادکرا بە سەرکەوتووی');
    }

    public function edit(Material $material)
    {
        ActivityService::log('Material', 'Viewed Material Edit Form', auth()->id());

        return view('material.edit', compact('material'));
    }

    public function update(MaterialRequest $request, Material $material)
    {

        $material->update($request->validated());
        ActivityService::log('Material', 'Updated Material', auth()->id());

        return redirect()
            ->route('material.index')
            ->with('success', 'مادەکە تازەکرایەوە بە سەرکەوتووی');
    }

    public function destroy(Material $material)
    {
        $material->active = false;
        $material->update();
        ActivityService::log('Material', 'Deleted Material', auth()->id());

        return redirect()->back()->with('success', 'مادەکە سڕایەوە بە سەرکەوتووی');
    }
}
