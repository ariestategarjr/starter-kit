<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitController extends Controller
{
    public function index(): View
    {
        $units = Unit::latest()->paginate(10);

        return view('pages.units.index', compact('units'));
    }

    public function create(): View
    {
        return view('pages.units.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'         => 'required',
        ]);

        //create category
        Unit::create([
            'name'         => $request->name,
        ]);

        //redirect to index
        return redirect()->route('units.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $unit = Unit::findOrFail($id);

        return view('pages.units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'name'         => 'required',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update([
            'name' => $request->name
        ]);

        return redirect()->route('units.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('units.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
