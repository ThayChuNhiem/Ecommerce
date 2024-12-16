<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Revenue extends Model
{
    use HasFactory;

    protected $table = 'revenue';

    protected $fillable = [
        'product_id',
        'order_detail_id',
        'amount',
        'month',
        'year',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public static function calculateMonthlyRevenue($month, $year)
    {
        $orderDetails = OrderDetail::where('status', 3)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $totalAmount = 0;

        foreach ($orderDetails as $orderDetail) {
            $totalAmount += $orderDetail->amount; // Giả sử cột `amount` trong bảng `order_details`
        }

        return $totalAmount;
    }

    public static function calculateYearlyRevenue($year)
    {
        $orderDetails = OrderDetail::where('status', 3)
            ->whereYear('created_at', $year)
            ->get();

        $totalAmount = 0;

        foreach ($orderDetails as $orderDetail) {
            $totalAmount += $orderDetail->amount; // Giả sử cột `amount` trong bảng `order_details`
        }

        return $totalAmount;
    }
}