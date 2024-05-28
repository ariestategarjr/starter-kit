<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('pages.categories.create');
    }

    public function store(Request $request): RedirectResponse
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
        // return redirect(route('categories.index'))->with('success', 'Berhasil Tambah Kategori!');
    }

    public function edit(string $id): View
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id): RedirectResponse
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

    public function destroy($id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
