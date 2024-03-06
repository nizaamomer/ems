<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function scopeOfSearch($query, $search)
    {
        return $search !== null
            ? $query->where(function ($query) use ($search) {
                $query->where('subTotal', 'like', "%$search")
                    ->orWhereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search")
                            ->orWhere('code', 'like', "%$search")
                            ->orWhere('price', 'like', "%$search");
                    })
                    ->orWhereHas('invoice', function ($q) use ($search) {
                        $q->where('code', 'like', "%$search")
                            ->orWhereHas('user', function ($q2) use ($search) {
                                $q2->where('name', 'like', "%$search");
                            });
                    });
            })
            : $query;
    }
    public function scopeOfUser($query, $user_id)
    {
        return $query->whereHas('invoice', function ($q) use ($user_id) {
            $q->ofUser($user_id);
        });
    }
    public function scopeOfStatus($query, $status)
    {
        return $query->whereHas('invoice', function ($q) use ($status) {
            if ($status === 'paid') {
                $q->where('status', 'paid');
            } elseif ($status === 'unpaid') {
                $q->where('status', 'unpaid');
            } else {
                return $q;
            }
        });
    }



    public function scopeOfSupplier($query, $supplier_id)
    {
        return $query->whereHas('invoice', function ($q) use ($supplier_id) {
            if ($supplier_id !== null) {
                $q->where('supplier_id', $supplier_id);
            }
        });
    }

    public function scopeWithDateRange($query, $dateRange, $customStartDate = null, $customEndDate = null)
    {
        return $query->whereHas('invoice', function ($q) use ($dateRange, $customStartDate, $customEndDate) {
            $q->OfDateRange($dateRange, $customStartDate, $customEndDate);
        });
    }

    public function scopeOfDateRange($query, $dateRange, $customStartDate = null, $customEndDate = null)
    {
        $currentDate = now();

        if ($dateRange === 'today') {
            return $query->whereDate('date', $currentDate->toDateString());
        } elseif ($dateRange === 'this_week') {
            return $query->whereBetween('date', [
                $currentDate->startOfWeek(),
                $currentDate->endOfWeek()
            ]);
        } elseif ($dateRange === 'last_week') {
            return $query->whereBetween('date', [
                $currentDate->copy()->subWeek()->startOfWeek(),
                $currentDate->copy()->subWeek()->endOfWeek()
            ]);
        } elseif ($dateRange === 'this_month') {
            return $query->whereBetween('date', [
                $currentDate->startOfMonth(),
                $currentDate->endOfMonth()
            ]);
        } elseif ($dateRange === 'last_month') {
            return $query->whereBetween('date', [
                $currentDate->copy()->subMonth()->startOfMonth(),
                $currentDate->copy()->subMonth()->endOfMonth()
            ]);
        } elseif ($customStartDate && $customEndDate) {
            return $query->whereBetween('date', [$customStartDate, $customEndDate]);
        } elseif (!$customStartDate && $customEndDate) {
            return $query->whereDate('date', '<=', $customEndDate);
        } elseif ($customStartDate && !$customEndDate) {
            return $query->whereDate('date', '>=', $customStartDate);
        }

        return $query;
    }
}
