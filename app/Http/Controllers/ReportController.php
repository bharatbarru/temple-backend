<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Donation, hall, puja, temple and temple tour reports - previewed on screen
 * and downloaded as Excel, both driven by the same filters.
 */
class ReportController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view-reports');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, ReportService $report)
    {
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Report' => $report->label(),
                'From' => $report->filter('from') ?: 'Any',
                'To' => $report->filter('to') ?: 'Any',
                'Source' => $report->filter('source') ?: 'All',
                'Payment Status' => $report->filter('payment_status') ?: 'All',
            ])
            ->log('Reports - ' . $description);
    }

    /**
     * Show a report with its filters and a preview of the rows.
     */
    public function index(Request $request)
    {
        $report = $this->report($request);

        $records = $report->query()->paginate(25)->withQueryString();

        return view('reports.index', [
            'report' => $report,
            'records' => $records,
            'summary' => $report->summary(),
            'types' => ReportService::types(),
            'sources' => ReportService::sources(),
            'paymentStatuses' => $report->paymentStatusOptions(),
        ]);
    }

    /**
     * Download the filtered report as an Excel file.
     */
    public function export(Request $request)
    {
        $report = $this->report($request);

        $this->activityLog('Exported ' . $report->label(), $report);

        return Excel::download(new ReportExport($report), $report->fileName());
    }

    /**
     * Build the report described by the request.
     */
    private function report(Request $request): ReportService
    {
        $filters = $request->validate([
            'type' => ['nullable', Rule::in(array_keys(ReportService::types()))],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'source' => ['nullable', Rule::in(array_keys(ReportService::sources()))],
            'payment_status' => ['nullable', 'string', 'max:100'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        return new ReportService($filters['type'] ?? null, $filters);
    }
}
