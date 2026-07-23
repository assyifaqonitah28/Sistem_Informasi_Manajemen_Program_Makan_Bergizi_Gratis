<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', auth()->id())
            ->with(['distribution.program', 'distribution.beneficiary'])
            ->latest()
            ->paginate(10);

        return view('user.reports.index', compact('reports'));
    }

    public function create()
    {
        $distributions = Distribution::where('status', 'distributed')
            ->doesntHave('report')
            ->with(['program', 'beneficiary'])
            ->get();

        return view('user.reports.create', compact('distributions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'distribution_id' => ['required', 'exists:distributions,id', 'unique:reports,distribution_id'],
            'report_date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'distribution_id.unique' => 'Laporan untuk distribusi ini sudah pernah dibuat.',
            'image.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $data = $request->only(['distribution_id', 'report_date', 'description']);
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        Report::create($data);

        return redirect()->route('user.reports.index')
            ->with('success', 'Laporan berhasil dikirim! Menunggu verifikasi Admin.');
    }
}
