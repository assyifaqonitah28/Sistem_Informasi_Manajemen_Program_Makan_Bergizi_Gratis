<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\UpdateReportRequest;
use App\Http\Requests\Admin\StoreReportRequest;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with(['distribution.program', 'distribution.beneficiary', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(15)->withQueryString();
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        $distributions = Distribution::where('status', 'distributed')
            ->doesntHave('report')
            ->with(['program', 'beneficiary'])
            ->get();

        return view('admin.reports.create', compact('distributions'));
    }

    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        $data['user_id'] = auth()->id();

        Report::create($data);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Laporan berhasil dibuat!');
    }

    public function show(Report $report)
    {
        $report->load(['distribution.program', 'distribution.beneficiary', 'user']);
        return view('admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        $report->load(['distribution.program', 'distribution.beneficiary']);
        return view('admin.reports.edit', compact('report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($report->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($report->image);
            }
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        $report->update($data);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Laporan berhasil diperbarui dan status diverifikasi!');
    }

    public function destroy(Report $report)
    {
        if ($report->image) Storage::disk('public')->delete($report->image);
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan dihapus.');
    }
}
