<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Material;
use App\Models\Report;
use App\Models\User;
use App\Services\ActivityService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        // Fetch invoices
        $invoices = Invoice::with(['invoiceItems', 'user'])
            ->OfUser($user_id)->OfSearch($search)
            ->OfDateRange($date_range, $custom_start_date, $custom_end_date)
            ->orderByDesc('id')->get();
        $users = User::all();

        if ($request->isMethod('post')) {

            $data = [
                'message' => $message,
                'withItems' => $withItems,
                'showNote' => $showNote,
                'invoices' => $invoices,
            ];
            // return view('pdf.index',['data' => $data]);
            $pdf = Pdf::loadView('pdf.invoice', ['data' => $data]);
            $pdf->getDomPDF()->getOptions()->setDefaultFont('nrt');

            ActivityService::log('ڕیپۆرتەکان', 'ڕیپۆرتێکی وەسڵەکانی دابەزاند', auth()->id(), "green");
            return $pdf->download('invoices report ' . now() . '.pdf');
        }
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

        // Fetch invoices
        $activities = Activity::with('user')
            ->OfUser($user_id)
            ->OfDateRange($date_range, $custom_start_date, $custom_end_date)
            ->orderByDesc('id')->get();
        $users = User::all();

        if ($request->has('generateActivityPdf')) {

            // return view('pdf.index',['data' => $data]);
            $pdf = Pdf::loadView('pdf.activity', ['activities' => $activities]);
            $pdf->getDomPDF()->getOptions()->setDefaultFont('nrt');

            ActivityService::log('ڕیپۆرتەکان', 'ڕیپۆرتێکی ئەکتیڤیتیەکانی  دابەزاند', auth()->id(), "green");
            return $pdf->download('activities report  ' . now() . '.pdf');
        }
        ActivityService::log('ڕیپۆرتەکان', 'سەیری لیستی ڕیپۆرتی ئەکتیڤیتیەکانی کرد', auth()->id(), "blue");

        return view('report.activity', compact('users', 'activities'));
    }
}
