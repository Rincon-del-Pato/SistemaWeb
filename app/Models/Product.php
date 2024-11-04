class Product extends Model
{
    protected $fillable = ['name', 'description', 'image_producto', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size')
                    ->withTimestamps();
    }
}
