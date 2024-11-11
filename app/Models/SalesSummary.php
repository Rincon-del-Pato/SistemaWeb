<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesSummary extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'total_revenue', 'total_orders', 'top_item_id', 'top_item_sales'];

    public function topItem()
    {
        return $this->belongsTo(MenuItem::class, 'top_item_id');
    }
}
