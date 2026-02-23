<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skate;
use Illuminate\Http\Request;

class SkateController extends Controller
{
    public function index()
    {
        $skates = Skate::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.skates.index', compact('skates'));
    }

    public function create()
    {
        return view('admin.skates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'size' => 'required|integer|min:30|max:47',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('skates', 'public');
            $validated['image'] = $path;
        }

        Skate::create($validated);

        return redirect()->route('admin.skates.index')
            ->with('success', 'Коньки успешно добавлены');
    }

    public function edit(Skate $skate)
    {
        return view('admin.skates.edit', compact('skate'));
    }

    public function update(Request $request, Skate $skate)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'size' => 'required|integer|min:30|max:47',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('skates', 'public');
            $validated['image'] = $path;
        }

        $skate->update($validated);

        return redirect()->route('admin.skates.index')
            ->with('success', 'Коньки успешно обновлены');
    }

    public function destroy(Skate $skate)
    {
        $skate->delete();
        return redirect()->route('admin.skates.index')
            ->with('success', 'Коньки успешно удалены');
    }
}