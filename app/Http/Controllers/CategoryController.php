<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'name'         => 'required',
        ]);

        //create category
        Category::create([
            'name'         => $request->name,
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'name'         => 'required',
        ]);

        $category = Category::findOrFail($id);

        //create category
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
