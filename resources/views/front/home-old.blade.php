<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Royal Fresh - Meat & Milk Products</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', Arial, sans-serif;
      background: #ffe6a7;
      color: #2d2635;
    }
    header {
      background: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 4vw;
      box-shadow: 0 4px 24px #1800000d;
      position: sticky;
      top: 0;
      z-index: 999;
    }
    .logo {
      display: flex;
      align-items: center;
      font-size: 1.6em;
      font-weight: bold;
      color: #b22234;
      letter-spacing: 2px;
    }
    .logo img {
      height: 42px;
      margin-right: 12px;
    }
    .nav-links {
      display: flex;
      gap: 32px;
      align-items: center;
    }
    .nav-links a {
      text-decoration: none;
      color: #2d2635;
      font-size: 1.07em;
      font-weight: 500;
      transition: color 0.2s;
    }
    .nav-links a:hover {
      color: #b22234;
    }
    .search-container {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }
    #searchInput {
      padding: 10px 16px;
      border-radius: 24px;
      border: 1px solid #ccc;
      font-size: 1em;
      outline: none;
      width: 220px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.2s, border-color 0.2s;
    }
    #searchInput:focus {
      border-color: #b22234;
      box-shadow: 0 4px 12px rgba(178, 34, 52, 0.2);
    }
    /* Hero section */
    .hero {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 36px;
      background: #dda15e;
      padding: 56px 4vw 40px 4vw;
      border-radius: 0 0 40px 40px;
    }
    .hero-content {
      max-width: 440px;
    }
    .hero-title {
      font-size: 2.7em;
      font-weight: 700;
      margin: 0 0 15px;
    }
    .hero-desc {
      font-size: 1.13em;
      color: #5a5a5a;
      margin-bottom: 24px;
    }
    .cta-btn {
      background: #b22234;
      color: #fff;
      border: none;
      padding: 16px 38px;
      font-size: 1.08em;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 600;
      box-shadow: 0 4px 8px #b2223422;
      transition: background 0.2s;
    }
    .cta-btn:hover {
      background: #e33444;
    }
    .hero-images {
      display: flex;
      gap: 18px;
    }
    .hero-images img {
      border-radius: 24px;
      width: 180px;
      height: 180px;
      object-fit: cover;
      box-shadow: 0 2px 20px #a80d1733;
    }
    /* Products section */
    #products {
      padding: 64px 4vw 40px 4vw;
    }
    .section-title {
      font-size: 2em;
      margin-bottom: 36px;
      text-align: center;
      color: #b22234;
      text-shadow: 2px 0 #ffe3ee;
      letter-spacing: 2px;
    }
    .products-list {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
      margin-top: 18px;
    }
    .product-card {
      background: #fff;
      border-radius: 22px;
      box-shadow: 0 6px 18px #da01210f;
      width: 260px;
      padding: 20px 18px 18px 18px;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.2s, box-shadow 0.3s;
      position: relative;
    }
    .product-card:hover {
      transform: scale(1.045);
      box-shadow: 0 10px 32px #b2223422;
      z-index: 2;
    }
    .product-card img {
      width: 96px;
      height: 96px;
      object-fit: cover;
      border-radius: 18px;
      margin-bottom: 14px;
      border: 2.5px solid #ffe3ee;
      box-shadow: 0 2px 8px #b222341a;
    }
    .product-title {
      font-size: 1.19em;
      font-weight: 600;
      margin-bottom: 4px;
      text-align: center;
    }
    .product-type {
      font-size: 0.97em;
      color: #b22234;
      margin-bottom: 12px;
      font-weight: 500;
    }
    .product-price {
      color: #2d2635;
      font-size: 1.08em;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .add-cart-btn {
      background: #b22234;
      color: #fff;
      border: none;
      border-radius: 19px;
      padding: 7px 22px;
      cursor: pointer;
      font-size: 1em;
      margin-top: auto;
      font-weight: 500;
      transition: background 0.13s;
    }
    .add-cart-btn:hover {
      background: #73111e;
    }
    /* Responsive styles */
    @media (max-width: 900px) {
      .hero {
        flex-direction: column;
        padding: 36px 2vw 30px 2vw;
      }
      .hero-images img {
        width: 140px;
        height: 140px;
      }
      header {
        flex-direction: column;
        gap: 16px;
        padding: 16px;
      }
      .search-container {
        position: static;
        transform: none;
        width: 100%;
        text-align: center;
      }
      #searchInput {
        width: 80%;
      }
      .nav-links {
        gap: 18px;
      }
    }
    @media (max-width: 600px) {
      .hero-title {
        font-size: 2em;
      }
      #products {
        padding: 36px 1vw 26px 1vw;
      }
      .products-list {
        gap: 12px;
      }
    }
  </style>
</head>
<body>
  <!-- Header & Nav -->
  @include('front.header')

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-title">Get Fresh Meat & Milk Delivered</div>
      <div class="hero-desc">
        Handpicked, hygienic, and fresh farm meat & dairy. Fast delivery to
        your doorstep since 1997. Discover quality you deserve!
      </div>
      <button class="cta-btn" onclick="scrollToProducts(event)">See Our Collection</button>
    </div>
    <div class="hero-images">
      <img
        src="{{ asset('Assets/mt13.jpg') }}"
        alt="Meat"
      />
      <img
        src="{{ asset('Assets/ml1.jpg') }}"
        alt="Milk"
      />
    </div>
  </section>

  <!-- Products -->
  <section id="products">
    <div class="section-title">Our Products</div>
    <div class="products-list" id="productsList">
      @foreach ($products as $product)
      <!-- Meat Products using your Assets folder images -->
      <div class="product-card" data-title="{{ strtolower($product->product_name) }}" 
     data-type="{{ strtolower($product->category->name) }}">
        <img src="{{ asset('images/product_images/' . $product->featured_image) }}" alt="{{ $product->product_name }}" />
        <div class="product-title">{{ $product->product_name }}</div>
        <div class="product-type">{{$product->category->name}}</div>
        @if($product->variant_type == 'simple')
        <div class="product-price">AED {{ $product->s_price }}/{{$product->s_weight}} {{$product->Sunit->name}}</div>
        @else
        <div class="product-price">From AED {{ $product->Productvariants->min('price') }}/{{ $product->Productvariants->min('weight') }}  </div>
        @endif
        <button class="add-cart-btn">Add to Cart</button>
      </div>
   
      @endforeach
    </div>
  </section>

  @include('front.footer')
  <script>
    // Scroll to products section
    function scrollToProducts(e) {
      e && e.preventDefault();
      document.querySelector('#products').scrollIntoView({ behavior: 'smooth' });
    }

    // Filtering products based on search input
    function filterProducts() {
      const input = document
        .getElementById('searchInput')
        .value.trim()
        .toLowerCase();
      const cards = document.querySelectorAll('.product-card');
      cards.forEach((card) => {
        const title = card.getAttribute('data-title').toLowerCase();
        const type = card.getAttribute('data-type').toLowerCase();
        card.style.display =
          title.includes(input) || type.includes(input) ? 'flex' : 'none';
      });
    }
  </script>
</body>
</html>