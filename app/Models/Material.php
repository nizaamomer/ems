<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search !== null) {
            return $query->where(function ($query) use ($search) {
                $query->where('code', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }
        return $query;
    }
    public function scopeOfDateRange($query, $dateRange, $customStartDate = null, $customEndDate = null)
    {
        $currentDate = now();

        if ($dateRange === 'today') {
            return $query->whereDate('created_at', $currentDate->toDateString());
        } elseif ($dateRange === 'this_week') {
            return $query->whereBetween('created_at', [
                $currentDate->startOfWeek(),
                $currentDate->endOfWeek()
            ]);
        } elseif ($dateRange === 'last_week') {
            return $query->whereBetween('created_at', [
                $currentDate->copy()->subWeek()->startOfWeek(),
                $currentDate->copy()->subWeek()->endOfWeek()
            ]);
        } elseif ($dateRange === 'this_month') {
            return $query->whereBetween('created_at', [
                $currentDate->startOfMonth(),
                $currentDate->endOfMonth()
            ]);
        } elseif ($dateRange === 'last_month') {
            return $query->whereBetween('created_at', [
                $currentDate->copy()->subMonth()->startOfMonth(),
                $currentDate->copy()->subMonth()->endOfMonth()
            ]);
        } elseif ($customStartDate && $customEndDate) {

            return $query->whereBetween('created_at', [$customStartDate, $customEndDate]);
        } elseif (!$customStartDate && $customEndDate) {

            return $query->whereDate('created_at', '<=', $customEndDate);
        } elseif ($customStartDate && !$customEndDate) {

            return $query->whereDate('created_at', '>=', $customStartDate);
        }
        return $query;
    }
}
