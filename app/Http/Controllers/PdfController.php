<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function index(){
        $users = User::get()->toArray();
        $pdf = Pdf::loadView('pdf.index', ['users' => $users]);
        return $pdf->download('users.pdf');
    }
}
