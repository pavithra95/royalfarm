{{-- resources/views/partials/category_products.blade.php --}}
@foreach($categories as $category)
  @if($category->products->isNotEmpty())
  <section class="category-section">
    <div class="category-header">
      <h2 class="category-title">{{ $category->name }} Products</h2>
    </div>
    <div class="products-grid">
      @foreach($category->products as $product)
        <div class="product-card">
          <img class="product-image" src="{{ asset('images/product_images/' . $product->featured_image) }}" alt="{{ $product->product_name }}">
          <div class="product-title">{{ $product->product_name }}</div>
          @if($product->variant_type == 'simple')
            <div class="product-price">AED {{ $product->s_price }}</div>
          @else
            <div class="product-price">From AED {{ $product->Productvariants->min('price') }}</div>
          @endif
          <button class="add-cart-btn"><i class="fas fa-cart-plus"></i> Add to Cart</button>
        </div>
      @endforeach
    </div>
  </section>
  @endif
@endforeach
