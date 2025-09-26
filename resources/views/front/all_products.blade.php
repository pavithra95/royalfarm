<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Royal Fresh – Products</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      background: #fef9f2;
      font-family: 'Poppins', Arial, sans-serif;
      color: #3b2f2f;
      min-height: 100vh;
    }
    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 28px 10px 50px 10px;
    }
    .category-section {
      border-radius: 16px;
      margin-bottom: 46px;
      padding: 30px 26px 32px 26px;
      box-shadow: 0 2px 14px rgba(128,78,36,0.07);
      /* Individual bg colors below for each category */
    }
    .category-header {
      text-align: center;
      margin-bottom: 36px;
      position: relative;
    }
    .category-title {
      font-size: 2.1em;
      font-weight: 700;
      color: #7d5b38;
      margin-bottom: 7px;
      letter-spacing: 2px;
      padding-bottom: 5px;
      border-bottom: 2.5px solid #c6ad78;
      display: inline-block;
    }
    .category-icon {
      display: inline-block;
      background: #e6d8bc;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      margin-top: 8px;
      margin-bottom: 3px;
      overflow:hidden;
      vertical-align:middle;
    }
    .category-icon img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
    }
    .products-row {
      display: flex;
      gap: 24px;
      justify-content: center;
      margin-bottom: 24px;
      flex-wrap: nowrap;
    }
    .product-card {
      background: #fffdfa;
      border-radius: 13px;
      box-shadow: 0 2px 14px rgba(186,153,88,0.10);
      border: 2.5px solid #e3d1b5;
      width: 31%;
      min-width: 280px;
      margin: 0;
      padding: 22px 14px 18px 14px;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: box-shadow 0.18s, border-color 0.23s;
      position: relative;
    }
    .product-card:hover {
      box-shadow: 0 10px 40px rgba(158,117,47,0.20);
      border-color: #c99427;
      z-index:2;
    }
    .product-image {
      width: 100%;
      height: 165px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 19px;
      box-shadow: 0 2px 10px #baa0683b;
      background: #f7ecdc;
    }
    .product-title {
      text-align: center;
      font-size: 1.17em;
      font-weight: 700;
      color: #62451c;
      margin-bottom: 13px;
      letter-spacing: .009em;
      font-family: 'Poppins', Arial, sans-serif;
      line-height: 1.22;
    }
    .product-price {
      font-weight: bold;
      font-size: 1.18em;
      color: #579ecc;
      margin-bottom: 13px;
      letter-spacing: 0.03em;
    }
    .product-weight-label {
      font-weight: 500;
      font-size: 0.98em;
      color: #7e6947;
      margin-bottom: 10px;
    }
    select.product-weight {
      margin-left: 8px;
      border-radius: 7px;
      padding: 4px 9px;
      border: 1.6px solid #e0c9a6;
      background: #f4e8c3;
      color: #6f5c2b;
      font-weight: 500;
      font-size: 1em;
      outline: none;
      transition: border-color 0.2s;
    }
    select.product-weight:hover, select.product-weight:focus {
      border-color: #cba950;
    }
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 9px;
      margin: 18px 0 17px 0;
      justify-content: center;
    }
    .quantity-controls button {
      background: #9e8329;
      border: none;
      color: #fff;
      border-radius: 5px;
      padding: 8px 14px;
      font-weight: bold;
      font-size: 1.13em;
      cursor: pointer;
      user-select: none;
      transition: background 0.18s;
      box-shadow: 0 2px 4px #c9b27833;
    }
    .quantity-controls button:hover {
      background: #d4b85e;
    }
    .quantity-controls input {
      width: 40px;
      border: 2px solid #d6bb7e;
      border-radius: 8px;
      text-align: center;
      font-size: 1em;
      font-weight: 600;
      padding: 6px 0;
      color: #6e5622;
      background: #fffced;
      outline: none;
      user-select: none;
    }
    .add-cart-btn {
      background: #e6c15b;
      color: #664e13;
      border: none;
      border-radius: 7px;
      font-weight: 700;
      padding: 10px 0;
      font-size: 1.04em;
      width: 93%;
      margin-top: 5px;
      cursor: pointer;
      letter-spacing: 0.04em;
      box-shadow: 0 4px 8px #baa05f34;
      transition: background 0.18s, box-shadow 0.2s;
    }
    .add-cart-btn:hover {
      background: #fde09b;
      color: #a37523;
      box-shadow: 0 7px 24px #e0bc7244;
    }
    @media (max-width: 1025px) {
      .container {
        padding: 8px 4px 28px 4px;
      }
      .products-row {
        flex-wrap: wrap;
        gap: 16px;
      }
      .product-card {
        width: 46%;
        min-width: 220px;
      }
    }
    @media (max-width: 700px) {
      .products-row {
        flex-direction: column;
        gap: 19px;
      }
      .product-card {
        width: 100%;
        min-width: unset;
      }
    }
  </style>
</head>
<body>
    @include('front.header')
  <div class="container">

    <!-- Dairy Products -->
    @foreach($categories as $category)
<section class="category-section" style="background:#f6e7d4">
    <div class="category-header">
        <span class="category-title">{{ $category->name }} Products</span>
    </div>

    <div class="products-row">
        @foreach($category->products as $product)
            <div class="product-card" 
     data-title="{{ strtolower($product->product_name) }}" 
     data-type="{{ strtolower($category->name) }}">

                <img class="product-image" src="{{ asset('images/product_images/' . $product->featured_image) }}" alt="{{ $product->name }}">
                <div class="product-title" >{{ $product->product_name }}</div>
                 @if($product->variant_type == 'simple')
                <div class="product-price">AED {{ $product->s_price }}</div>
                @else
                <div class="product-price">From AED {{ $product->Productvariants->min('price') }}</div>
                @endif

                <div class="product-weight-label">
                    Weight:
                    <select class="product-weight">
                         @if($product->variant_type == 'simple')
                            <option value="{{ $product->s_weight }} {{$product->Sunit->name}}">{{ $product->s_weight }} {{$product->Sunit->name}}</option>
                        @else

                        @foreach($product->Productvariants as $w)
                            <option value="{{ $w->weight }} {{$product->unit->name}}">{{ $w->weight }} {{$product->unit->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="quantity-controls">
                    <button onclick="updateQuantity(this, -1)">-</button>
                    <input type="number" value="1" min="1" readonly>
                    <button onclick="updateQuantity(this, 1)">+</button>
                </div>

                <button class="add-cart-btn">Add to Cart</button>
            </div>
        @endforeach
    </div>
</section>
@endforeach



  </div>
    @include('front.footer')
  <script>
    function updateQuantity(btn, change) {
      const input = btn.parentElement.querySelector('input[type=number]');
      let current = parseInt(input.value);
      current += change;
      if (current < 1) current = 1;
      input.value = current;
    }
     function scrollToProducts(e) {
      e && e.preventDefault();
      document.querySelector('#products').scrollIntoView({ behavior: 'smooth' });
    }

    // Filtering products based on search input
   function filterProducts() {
  const input = document.getElementById('searchInput').value.trim().toLowerCase();
  const cards = document.querySelectorAll('.product-card');

  cards.forEach((card) => {
    const title = card.getAttribute('data-title');
    const type = card.getAttribute('data-type');
    card.style.display =
      title.includes(input) || type.includes(input) ? 'flex' : 'none';
  });
}

  </script>
</body>
</html>
