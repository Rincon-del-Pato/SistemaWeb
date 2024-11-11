<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemSize extends Model
{
    use HasFactory;

    protected $table = 'menu_item_sizes';

    // Definimos los atributos que se pueden asignar masivamente
    protected $fillable = [
        'menu_item_id',
        'size_id',
        'price',
    ];

    /**
     * Relación con el modelo MenuItem
     * Un MenuItemSize pertenece a un plato (MenuItem)
     */
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    /**
     * Relación con el modelo Size
     * Un MenuItemSize pertenece a un tamaño específico (Size)
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
