<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Material;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $materials = Material::where("active", true)->count();
        $invoices = Invoice::count();
        $expenseToThisMonth = Invoice::whereBetween('date', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('totalAmount');
        return view(
            'dashboard',
            compact(
                'invoices',
                'materials',
                'users',
                'expenseToThisMonth'
            )
        );
    }
}
