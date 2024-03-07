<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Material;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $materials = Material::where("active", true)
            ->OfSearch($request->search)
            ->orderByDesc('code')->get();
        $cartItems = Cart::with('material')->where(['type' => 'create', 'user_id' => auth()->user()->id])
            ->orderByDesc('id')
            ->get();
        ActivityService::log('زیادکردنی وەسڵ', 'فۆرمی زیادکردنی وەسڵی کردەوە', auth()->id(), "orange");

        return view(
            'invoice.create',
            compact('materials', 'cartItems')
        );
    }

    public function addToCart(Request $request)
    {
        $materialID = $request->material_id;
        $cartItem = Cart::where(['material_id' => $materialID, 'user_id' => auth()->user()->id, 'type' => 'create'])->first();
        if (!$cartItem) {
            Cart::create([
                "material_id" => $materialID,
                "user_id" => auth()->user()->id,
                "quantity" => 1,
                "type" => "create",
            ]);
        } else {
            $cartItem->quantity++;
            $cartItem->save();
        }

        return redirect()->back();
    }
    public function destroy($id)
    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'create',
            'user_id' => auth()->user()->id
        ])->first();
        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->back();
    }
    public function increase($id)
    {
        $cartItem = Cart::where([
            'id' => $id,
            'type' => 'create',
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
            'type' => 'create',
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
            'type' => 'create',
            'user_id' => auth()->user()->id
        ])->first();
        if (!$cartItem) {
            return redirect()->route('invoice.create')->with('error', 'هەڵەیەک ڕوویدا');
        }
        $materialItem = Material::find($cartItem->material_id);
        if (!$materialItem) {
            return redirect()->route('invoice.create')->with('errors', 'هەڵەیەک ڕوویدا');
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
            'type' => 'create',
            'user_id' => auth()->user()->id
        ])->first();
        if (!$cartItem) {
            return redirect()->route('invoice.create')->with('error', 'هەڵەیەک ڕوویدا');
        }
        $materialItem = Material::find($cartItem->material_id);
        if (!$materialItem) {
            return redirect()->route('invoice.create')->with('errors', 'هەڵەیەک ڕوویدا');
        }
        $newPrice = intval($request->input('price'));
        if ($newPrice) {
            $cartItem->unitPrice = $newPrice;
            $cartItem->save();
        }
        return redirect()->back();
    }
    public function addInvoice(Request $request)
    {

        $cartItems = Cart::where(['user_id' => auth()->user()->id, 'type' => 'create'])->get();
        if ($cartItems->count() > 0) {
            $invoiceNumber = $request->filled('invoiceNumber') ? $request->invoiceNumber : null;

            if ($invoiceNumber) {
                if (Invoice::where('invoiceNumber', $invoiceNumber)->exists()) {
                    return redirect()->route('invoice.create')->with('error', 'پێشتر ژمارەی وەسڵ بەکارهاتووە');
                }
            } else {
                do {
                    $invoiceNumber = rand();
                } while (Invoice::where('invoiceNumber', $invoiceNumber)->exists());
            }

            foreach ($cartItems as $cartItem) {
                if (is_null($cartItem->unitPrice) || $cartItem->unitPrice == 0) {
                    return redirect()->route('invoice.create')->with('error', 'پێویستە نرخی هاموو مادەکان دیاری بکەی');
                }
            }

            $invoice = Invoice::create([
                'user_id' => auth()->user()->id,
                'invoiceNumber' => $invoiceNumber,
                'date' => now(),
            ]);

            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
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
            ActivityService::log('زیادکردنی وەسڵ', 'وەسڵێکی زیادکرد', auth()->id(), "green");

            return redirect()->route('invoice.index')->with('message', 'وەسڵەکە بە سەرکەوتووی زیادکرا');
        }

        return redirect()->back()->with('error', 'هیچ مادەیەک نادۆزرایەوە بۆ زیادکردن');
    }
}
