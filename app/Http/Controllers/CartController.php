<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Material;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
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

        return redirect()->back();
    }
    public function destroy($id)
    {
        $cartItem = Cart::where(['id' => $id])->first();
        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->back();
    }
    public function increase($id)
    {

        $cartItem = Cart::where(['id' => $id])->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        }
        return redirect()->back();
    }
    public function decrease($id)
    {
        $cartItem = Cart::where(['id' => $id])->first();
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            }
        }
        return redirect()->back();
    }
    public function setQuantity(Request $request, $id)
    {
        
        $cartItem = Cart::findOrFail($id);
        dd($cartItem);
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
        return redirect()->back();
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
        return redirect()->back();
    }
    public function pay(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        if ($cartItems->count() > 0) {
            $invoiceNumber = $request->filled('invoiceNumber') ? $request->invoiceNumber : rand();
            while (Invoice::where('invoiceNumber', $invoiceNumber)->exists()) {
                $invoiceNumber = rand();
            }

            $invoice = Invoice::create([
                'user_id' => auth()->user()->id,
                'invoiceNumber' => $invoiceNumber,
                'date' => now(),
            ]);

            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                if (is_null($cartItem->unitPrice) || $cartItem->unitPrice == 0) {
                    return redirect()->route('invoice.create')->with('error', 'پێویستە هەموو مادەکان نرخیان بۆ دابنێی');
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

            return redirect()->route('invoice.index')->with('message', 'Invoice Added Successfully');
        }

        return redirect()->back()->with('error', 'Cart is empty.');
    }
}
