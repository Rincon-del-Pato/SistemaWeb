public function create(Table $table)
{
    $categories = Category::all();
    $products = [];
    
    foreach ($categories as $category) {
        $products[$category->id] = Product::where('category_id', $category->id)
            ->with('sizes') 
            ->get();
    }

    return view('orders.create', compact('categories', 'products', 'table'));
}
