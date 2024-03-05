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
        $materials = Material::OfSearch($request->input('search'))
            ->orderByDesc('id')->paginate(10);
            $categorycount = Material::count();
        return view('Material.index', compact('materials','categorycount'));
    }
    public function create()
    {
        return view('Material.create');
    }
    public function store(MaterialRequest $request)
    {
        $data = $request->all();
        $image = $request->file('image')->hashName();
        $request->file('image')->move(public_path('category_images'), $image);
        $data['image'] = $image;
        Material::create($data);
        return redirect()->route('Material.index')
            ->with('success', 'Material created successfully');
    }

    public function show(Material $Material)
    {
        return view('Material.show', compact('Material'));
    }
    public function edit(Material $Material)
    {
        return view('Material.edit', compact('Material'));
    }

    public function update(Request $request, Material $Material)
    {
        $data = $request->all();
        // dd($data);
        if ($request->hasFile('image')) {
            if ($Material->image) {
                $oldImagePath = public_path('category_images/')  . $Material->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('image')->hashName();
            $request->file('image')->move(public_path('category_images'), $image);
            $data['image'] = $image;
        }
        $Material->update($data);
        return redirect()->route('Material.index')
            ->with('success', 'Material Update successfully');
    }

    public function destroy(Material $Material)
    {
        $imagePath = public_path('category_images/') . $Material->image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $Material->delete();
        return redirect()->back()->with('success', 'Material deleted successfully');
    }
}
