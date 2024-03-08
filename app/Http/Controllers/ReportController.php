<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Invoice;
use App\Models\User;
use App\Services\ActivityService;

use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function invoice(Request $request)
    {
        $search = $request->query('search');
        $date_range = $request->query('date_range');
        $custom_start_date = $request->query('custom_start_date');
        $custom_end_date = $request->query('custom_end_date');
        $user_id = $request->query('user_id');
        $supplier_id = $request->query('supplier_id');
        $status = $request->query('status');

        $message = $request->input('message');
        $withItems = $request->has('withItems');
        $showNote = $request->has('showNote');

        $invoices = Invoice::with(['invoiceItems', 'user'])
            ->OfUser($user_id)->OfSearch($search)
            ->OfDateRange($date_range, $custom_start_date, $custom_end_date)
            ->orderByDesc('id')->get();
        $users = User::all();

        // info($request->method());
        // if ($request->isMethod('POST')) {
        // info($request->method());
        $data = [
            'message' => $message,
            'withItems' => $withItems,
            'showNote' => $showNote,
            'invoices' => $invoices,
        ];
        $pdf = PDF::loadView('pdf.invoice',  compact('data'));
        return $pdf->stream("slaw.pdf");
        ActivityService::log('ڕیپۆرتەکان', 'ڕیپۆرتێکی وەسڵەکانی دابەزاند', auth()->id(), "green");
        return $pdf->download('invoices report ' . now() . '.pdf');
        // }
        ActivityService::log('ڕیپۆرتەکان', 'سەیری لیستی ڕیپۆرتی وەسڵەکانی کرد', auth()->id(), "blue");

        return view('report.invoice', compact('users', 'invoices'));
    }


    public function activity(Request $request)
    {

        $search = $request->query('search');
        $date_range = $request->query('date_range');
        $custom_start_date = $request->query('custom_start_date');
        $custom_end_date = $request->query('custom_end_date');
        $user_id = $request->query('user_id');
        $supplier_id = $request->query('supplier_id');
        $status = $request->query('status');

        // Fetch activities
        $activities = Activity::with('user')
            ->OfUser($user_id)
            ->OfDateRange($date_range, $custom_start_date, $custom_end_date)
            ->orderByDesc('id')->get();
        $users = User::all();

        if ($request->has('generateActivityPdf')) {
            $pdf = PDF::loadView('pdf.activity', compact('activities'));
            ActivityService::log('ڕیپۆرتەکان', 'ڕیپۆرتێکی ئەکتیڤیتیەکانی دابەزاند', auth()->id(), "green");
            return $pdf->download('activities_report_' . now() . '.pdf');
        }
        ActivityService::log('ڕیپۆرتەکان', 'سەیری لیستی ڕیپۆرتی ئەکتیڤیتیەکانی کرد', auth()->id(), "blue");

        return view('report.activity', compact('users', 'activities'));
    }
}
