<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('invoice.index', compact('invoices', 'users'));
    }
    public function create(Request $request)
    {
        $materials = Material::where("active", true)
            ->OfSearch($request->search)
            ->orderByDesc('code')->get();
        $cartItems = Cart::with('material')
            ->orderByDesc('id')
            ->get();
        return view(
            'invoice.create',
            compact('materials', 'cartItems',)
        );
    }
    public function show($id)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->findOrFail($id);
        if (!$invoice) {
            abort(404);
        }
        return view('invoice.show', compact('invoice'));
    }
    public function edit($id, Request $request)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->find($id);
        $materials = Material::where("active", true)
            ->OfSearch($request->search)
            ->orderByDesc('code')->get();

        // Empty cart
        Cart::where('user_id', auth()->user()->id)->delete();

        // Fill cart from invoice items
        foreach ($invoice->invoiceItems as $invoiceItem) {
            $cartItem = Cart::create([
                'material_id' => $invoiceItem->material_id,
                'user_id' => auth()->user()->id,
                'quantity' => $invoiceItem->quantity,
                'unitPrice' => $invoiceItem->unitPrice
            ]);
        }

        $cartItems = Cart::with('material')
            ->orderByDesc('id')
            ->get();

        return view(
            'invoice.edit',
            compact('materials', 'cartItems', 'invoice')
        );
    }



    public function updateee(Request $request, string $id)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->where('type', 'buy')->find($id);
        $invoice->status = $request->status;
        // dd($request->status);
        $invoice->save();
        if (!$invoice) {
            abort(404);
        }
        return redirect()->route('buyinvoice.index')->with('message', 'Invoice Update Succssfully');
    }
    public function update(Request $request, Invoice $invoice)
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        if ($cartItems->count() > 0) {
            //delete previews invoice items
            foreach ($invoice->invoiceItems as $invoiceItem) {
                $invoiceItem->delete();
            }

            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                if (is_null($cartItem->unitPrice) || $cartItem->unitPrice == 0) {
                    return redirect()->route('invoice.edit')->with('error', 'پێویستە هەموو مادەکان نرخیان بۆ دابنێی');
                }

                $material = Material::find($cartItem->material_id);
                $invoiceItem = InvoiceItem::create([
                    'material_id' => $material->id,
                    'invoice_id' => $invoice->id,
                    'quantity' => $cartItem->quantity,
                    'subTotal' => $cartItem->unitPrice * $cartItem->quantity,
                    'unitPrice' => $cartItem->unitPrice
                ]);
                $totalAmount += $invoiceItem->subTotal;
            }

            $invoice->totalAmount = $totalAmount;
            $invoice->save();

            // Delete cart items after updating the invoice
            Cart::where('user_id', auth()->user()->id)->delete();

            return redirect()->route('invoice.index')->with('message', 'Invoice Updated Successfully');
        }

        return redirect()->back()->with('error', 'Cart is empty.');
    }

    public function updatee($id, Request $request)
    {
        // Validate the request data
        $request->validate([
            // Add validation rules for your invoice fields
        ]);

        // Find the invoice by its ID
        $invoice = Invoice::findOrFail($id);

        // Update the invoice details
        $invoice->update([
            'field1' => $request->field1,
            'field2' => $request->field2,
            // Add more fields as needed
        ]);

        // Update or create invoice items
        foreach ($request->items as $item) {
            InvoiceItem::updateOrCreate(
                ['id' => $item['id']], // If an ID is provided, update the existing item
                [
                    'invoice_id' => $invoice->id,
                    'material_id' => $item['material_id'],
                    'quantity' => $item['quantity'],
                    'unitPrice' => $item['unitPrice'],
                    // Add more fields as needed
                ]
            );
        }

        // Optionally, you can also delete any invoice items that were not included in the request

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Invoice updated successfully.');
    }
    public function destroy($id)
    {
        $invoice = Invoice::with(['invoiceItems', 'user'])->find($id);
        if ($invoice) {
            $invoice->delete();
        }
        return redirect()->back()->with('message', 'وەسڵەکە بە سەرکەوتووی سڕایەوە');
    }
    public function addToCart(Request $request)
    {
        $materialID = $request->material_id;
        $cartItem = Cart::where(['material_id' => $materialID])->first();
        if (!$cartItem) {
            Cart::create([
                "material_id" => $materialID,
                "user_id" => auth()->user()->id,
                "quantity" => 1,
            ]);
        } else {
            $cartItem->quantity++;
            $cartItem->save();
        }

        return redirect()->route('invoice.create');
    }
    public function destroyy($id)
    {
        $cartItem = Cart::where(['id' => $id])->first();
        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('invoice.create');
    }
    public function increase(Invoice $invoice,$id,$iId)
    {

        $cartItem = Cart::where(['id' => $id])->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        }
        return redirect()->route("invoice.edit",$iId);
    }
    public function decrease($id)
    {
        $cartItem = Cart::where(['id' => $id])->first();
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            }
        }
        return redirect()->route('invoice.create');
    }
    public function setQuantity(Request $request, $id)
    {
        $cartItem = Cart::where(['id' => $id])->first();
        if (!$cartItem) {
            return redirect()->route('invoice.create')->with('error', 'Cart item not found');
        }
        $materialItem = Material::find($cartItem->material_id);
        if (!$materialItem) {
            return redirect()->route('invoice.create')->with('errors', 'Product not found');
        }
        $newQuantity = intval($request->input('quantity'));
        if ($newQuantity) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        }
        return redirect()->route('invoice.create');
    }
    public function setPrice(Request $request, $id)

    {
        info($request->all());
        $cartItem = Cart::where(['id' => $id])->first();
        if (!$cartItem) {
            return redirect()->route('invoice.create')->with('error', 'Cart item not found');
        }
        $materialItem = Material::find($cartItem->material_id);
        if (!$materialItem) {
            return redirect()->route('invoice.create')->with('errors', 'Product not found');
        }
        $newPrice = intval($request->input('price'));
        if ($newPrice) {
            $cartItem->unitPrice = $newPrice;
            $cartItem->save();
        }
        return redirect()->route('invoice.create');
    }
    public function pay(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        if ($cartItems->count() > 0) {
            $invoiceNumber = $request->filled('invoiceNumber') ? $request->invoiceNumber : null;

            if ($invoiceNumber) {
                if (Invoice::where('invoiceNumber', $invoiceNumber)->exists()) {
                    return redirect()->route('invoice.create')->with('error', 'Invoice number already exists.');
                }
            } else {
                do {
                    $invoiceNumber = rand();
                } while (Invoice::where('invoiceNumber', $invoiceNumber)->exists());
            }

            $invoice = Invoice::create([
                'user_id' => auth()->user()->id,
                'invoiceNumber' => $invoiceNumber,
                'date' => now(),
            ]);

            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                if (is_null($cartItem->unitPrice) || $cartItem->unitPrice == 0) {
                    return redirect()->route('invoice.create')->with('error', 'All materials must have a unit price set.');
                }

                $material = Material::find($cartItem->material_id);
                $invoiceItem = InvoiceItem::create([
                    'material_id' => $material->id,
                    'invoice_id' => $invoice->id,
                    'quantity' => $cartItem->quantity,
                    'subTotal' => $cartItem->unitPrice * $cartItem->quantity,
                    'unitPrice' => $cartItem->unitPrice
                ]);
                $totalAmount += $invoiceItem->subTotal;
                $invoice->totalAmount = $totalAmount;
                $invoice->update();

                $cartItem->delete();
            }

            return redirect()->route('invoice.index')->with('message', 'Invoice added successfully.');
        }

        return redirect()->back()->with('error', 'Cart is empty.');
    }
}
