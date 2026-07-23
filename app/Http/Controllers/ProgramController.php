<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortDir = $request->get('dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $programs = $query->paginate(10)->withQueryString();

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(StoreProgramRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        Program::create($data);

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Program berhasil ditambahkan!');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $data = $request->validated();

        // Handle image upload (replace old image)
        if ($request->hasFile('image')) {
            // Delete old image
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        $program->update($data);

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        // Delete image if exists
        if ($program->image) {
            Storage::disk('public')->delete($program->image);
        }

        $program->delete();

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Program berhasil dihapus!');
    }
}
