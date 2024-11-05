<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Services\ActivityService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Exports\ReportsExport;

class ReportController extends Controller
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Report::class);

        $reportsQuery = $this->activityService->getActivitiesQuery($request, Report::class);

        if ($reportsQuery instanceof \Illuminate\Support\Collection) {
            $reports = $reportsQuery;
        } else {
            $reports = $reportsQuery->paginate(5);
        }

        return view('report.index', compact('reports'));
    }

    public function export($id)
    {
        $report = Report::with([
            'client.user',
            'maintenance.computer',
            'maintenance.activity'
        ])->findOrFail($id);

        $timestamp = now()->format('Y_m_d_His');
        return Excel::download(new ReportExport($report), 'report_' . $id . '_' . $timestamp . '.xlsx');
    }

    public function exportAll(Request $request)
    {
        $reportsQuery = $this->activityService->getActivitiesQuery($request, Report::class);

        if ($reportsQuery instanceof \Illuminate\Support\Collection) {
            $reports = $reportsQuery;
        } else {
            $reports = $reportsQuery->get();
        }

        $timestamp = now()->format('Y_m_d_His');
        return Excel::download(new ReportsExport($reports), 'all_reports_' . $timestamp . '.xlsx');
    }

    public function exportPdf($id)
    {
        $report = Report::with([
            'client.user',
            'maintenance.computer',
        ])->findOrFail($id);

        $pdf = Pdf::loadView('report.pdf', compact('report'));
        $timestamp = now()->format('Y_m_d_His');
        return $pdf->download('report_' . $id . '_' . $timestamp . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $report = Report::find($id);

        $this->authorize('view', $report);

        return view('report.show', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportRequest $request, Report $report): RedirectResponse
    {
        $this->authorize('update', $report);
        $report->update($request->validated());

        return Redirect::route('reports.index')
            ->with('success', 'Report updated successfully');
    }
}
