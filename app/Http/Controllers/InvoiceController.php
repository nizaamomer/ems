<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Material;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoicesQuery = Invoice::with(['invoiceItems', 'user'])
            ->OfUser($request->user_id)
            ->OfSearch($request->search)
            ->OfDateRange($request->date_range, $request->custom_start_date, $request->custom_end_date);
        $invoices = $invoicesQuery->get();

        $users = User::all();
        ActivityService::log('وەسڵەکان', 'سەیری لیستی وەسڵەکانی کرد', auth()->id(), "blue");

        return view('invoice.index', compact('invoices', 'users'));
    }
    public function create(Request $request)
    {
        $materials = Material::where("active", true)
            ->OfSearch($request->search)
            ->orderByDesc('code')->get();
        $cartItems = Cart::with('material')->where(['type' => 'create', 'user_id' => auth()->user()->id])
            ->orderByDesc('id')
            ->get();
        ActivityService::log('وەسڵەکان', 'فۆرمی زیادکردنی وەسڵی کردەوە', auth()->id(), "orange");

        return view(
            'invoice.create',
            compact('materials', 'cartItems',)
        );
    }
    public function destroyy($id)
    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'edit',
            'user_id' => auth()->user()->id
        ])->first();
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back();
    }
    public function show($id)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->findOrFail($id);
        if (!$invoice) {
            abort(404);
        }
        ActivityService::log('وەسڵەکان', 'سەیری وردەکاری وەسڵێکی کرد', auth()->id(), "blue");

        return view('invoice.show', compact('invoice'));
    }

    public function edit($id, Request $request)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->find($id);
        $materials = Material::where("active", true)
            ->OfSearch($request->search)
            ->orderByDesc('code')->get();

        // Check if cart is already filled
        $cartItems = Cart::where([
            'user_id' => auth()->user()->id,
            'type' => 'edit'
        ])->exists();

        if (!$cartItems) {
            // Empty cart
            Cart::where([
                'user_id' => auth()->user()->id,
                'type' => 'edit'
            ])->delete();

            // Fill cart from invoice items
            foreach ($invoice->invoiceItems as $invoiceItem) {
                $cartItem = Cart::create([
                    'material_id' => $invoiceItem->material_id,
                    'user_id' => auth()->user()->id,
                    'quantity' => $invoiceItem->quantity,
                    'unitPrice' => $invoiceItem->unitPrice,
                    "type" => "edit"
                ]);
            }
        }

        $cartItems = Cart::with('material')
            ->where([
                'type' => 'edit',
                'user_id' => auth()->user()->id
            ])
            ->orderByDesc('id')
            ->get();

        return view(
            'invoice.edit',
            compact('materials', 'cartItems', 'invoice')
        );
    }
    public function addToCart(Request $request)
    {
        $materialID = $request->material_id;
        $cartItem = Cart::where([
            'material_id' => $materialID,
            'user_id' => auth()->user()->id,
            'type' => 'edit'
        ])->first();
        info($cartItem);
        if (!$cartItem) {
            Cart::create([
                "material_id" => $materialID,
                "user_id" => auth()->user()->id,
                "quantity" => 1,
                "type" => "edit",
            ]);
        } else {
            $cartItem->quantity++;
            $cartItem->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->find($id);
        if ($invoice) {
            $invoice->delete();
        }
        ActivityService::log('وەسڵەکان', ' وەسڵێکی سڕیەوە ', auth()->id(), "red");

        return redirect()->back()->with('message', 'وەسڵەکە بە سەرکەوتووی سڕایەوە');
    }

    public function increase($id)
    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'edit',
            'user_id' => auth()->user()->id
        ])->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        }
        return redirect()->back();
    }
    public function decrease($id)
    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'edit',
            'user_id' => auth()->user()->id
        ])->first();
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            }
        }
        return redirect()->back();
    }
    public function setQuantity(Request $request, $id)
    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'edit',
            'user_id' => auth()->user()->id
        ])->first();
        if (!$cartItem) {
            return redirect()->back()->with('error', 'هەڵەیەک ڕوویدا');
        }
        $materialItem = Material::find($cartItem->material_id);
        if (!$materialItem) {
            return redirect() - back()->with('errors', 'هەڵەیەک ڕوویدا');
        }
        $newQuantity = intval($request->input('quantity'));
        if ($newQuantity) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        }
        return redirect()->back();
    }
    public function setPrice(Request $request, $id)

    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'edit',
            'user_id' => auth()->user()->id
        ])->first();
        if (!$cartItem) {
            return redirect()->back()->with('error', 'هەڵەیەک ڕوویدا');
        }
        $materialItem = Material::find($cartItem->material_id);
        if (!$materialItem) {
            return redirect()->back()->with('errors', 'هەڵەیەک ڕوویدا');
        }
        $newPrice = intval($request->input('price'));
        if ($newPrice) {
            $cartItem->unitPrice = $newPrice;
            $cartItem->save();
        }
        return redirect()->back();
    }

    public function UpdateInvoice(Request $request)
    {
        $cartItems = Cart::where(['user_id' => auth()->user()->id, 'type' => "edit"])->get();
        if ($cartItems->count() > 0) {
            $invoiceNumber = $request->filled('invoiceNumber') ? $request->invoiceNumber : null;
            $currentInvoiceNumber = $request->currentInvoiceNumber;

            // Check if the invoice number already exists (ignoring the current invoice number)
            if ($invoiceNumber && Invoice::where('invoiceNumber', $invoiceNumber)->where('invoiceNumber', '!=', $currentInvoiceNumber)->exists()) {
                return redirect()->back()->with('error', 'Invoice number already exists.');
            }

            $invoice = Invoice::findOrFail($request->invoice_id);

            // Update the invoice attributes
            $invoice->invoiceNumber = $invoiceNumber ?? $invoice->invoiceNumber; // Keep the current invoice number if not provided
            $invoice->date = now(); // Update the date
            $invoice->totalAmount = 0; // Reset the total amount

            // Check if all materials have a unit price set
            foreach ($cartItems as $cartItem) {
                if (is_null($cartItem->unitPrice) || $cartItem->unitPrice == 0) {
                    return redirect()->back()->with('error', 'All materials must have a unit price set.');
                }
            }

            // Delete existing invoice items
            $invoice->invoiceItems()->delete();

            // Process the cart items
            foreach ($cartItems as $cartItem) {
                $material = Material::find($cartItem->material_id);
                $invoiceItem = InvoiceItem::create([
                    'material_id' => $material->id,
                    'invoice_id' => $invoice->id,
                    'quantity' => $cartItem->quantity,
                    'subTotal' => $cartItem->unitPrice * $cartItem->quantity,
                    'unitPrice' => $cartItem->unitPrice
                ]);
                $invoice->totalAmount += $invoiceItem->subTotal;
            }

            $invoice->save();

            Cart::where(['user_id' => auth()->user()->id, 'type' => 'edit'])->delete();
            ActivityService::log('وەسڵەکان', 'زانیاریەکانی وەسڵێکی تازەکردەوە', auth()->id(), "green");

            return redirect()->route('invoice.index')->with('message', 'Invoice updated successfully.');
        }

        return redirect()->back()->with('error', 'Cart is empty.');
    }
}
