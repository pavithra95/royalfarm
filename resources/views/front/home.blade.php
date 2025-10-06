<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Royal Fresh – Premium Meat & Milk Delivery</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-brown: #62451c;
      --light-brown: #f7ecdc;
      --accent-brown: #baa0683b;
      --dark-brown: #3d2b10;
      --cream: #fff9f0;
      --gold: #c8a97e;
      --shadow-sm: 0 2px 12px rgba(98, 69, 28, 0.08);
      --shadow-md: 0 4px 20px rgba(98, 69, 28, 0.12);
      --shadow-lg: 0 8px 30px rgba(98, 69, 28, 0.15);
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: var(--cream);
      color: var(--dark-brown);
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* === Premium Header === */
    header {
      background: rgba(255, 249, 240, 0.95);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      box-shadow: var(--shadow-sm);
      padding: 1rem 4vw;
      transition: all 0.3s ease;
    }
    header.scrolled {
      padding: 0.7rem 4vw;
      background: rgba(255, 249, 240, 0.98);
      backdrop-filter: blur(10px);
    }
    .header-container {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1.5rem;
    }
    .logo {
      display: flex;
      align-items: center;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--primary-brown);
      font-size: 1.6rem;
      font-family: 'Playfair Display', serif;
    }
    .logo img {
      height: 42px;
      margin-right: 12px;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }
    .nav-links {
      display: flex;
      gap: 2rem;
      align-items: center;
      flex-wrap: wrap;
      justify-content: center;
    }
    .nav-links a {
      text-decoration: none;
      color: var(--dark-brown);
      font-size: 1.05rem;
      font-weight: 500;
      transition: all 0.3s;
      padding: 0.5rem 0;
      position: relative;
    }
    .nav-links a:hover {
      color: var(--primary-brown);
    }
    .nav-links a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: var(--primary-brown);
      transition: width 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .nav-links a:hover::after {
      width: 100%;
    }
    .search-container {
      flex: 1;
      min-width: 240px;
      max-width: 360px;
      margin: 0 1.5rem;
      position: relative;
    }
    #searchInput {
      width: 100%;
      padding: 0.8rem 1.2rem 0.8rem 3rem;
      border-radius: 30px;
      border: 1px solid var(--light-brown);
      font-size: 1rem;
      outline: none;
      transition: all 0.3s;
      box-shadow: var(--shadow-sm);
      background: white;
    }
    #searchInput:focus {
      border-color: var(--gold);
      box-shadow: 0 4px 15px rgba(200, 169, 126, 0.2);
    }
    .search-icon {
      position: absolute;
      left: 1.2rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary-brown);
      font-size: 1.1rem;
    }

    /* === Premium Hero Section with Videos === */
    .hero {
      height: 100vh;
      min-height: 700px;
      display: flex;
      position: relative;
      overflow: hidden;
      margin-top: 80px;
    }
    .video-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
    }
    .video-panel {
      flex: 1;
      position: relative;
      overflow: hidden;
    }
    .video-panel video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .video-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .meat-panel .video-overlay {
      background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
    }
    .milk-panel .video-overlay {
      background: linear-gradient(to left, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
    }
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 4vw;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }
    .hero-title {
      font-size: clamp(2.5rem, 5vw, 4.5rem);
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: white;
      font-family: 'Playfair Display', serif;
      line-height: 1.1;
      text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .hero-subtitle {
      font-size: clamp(1.1rem, 2.5vw, 1.4rem);
      margin-bottom: 2.5rem;
      color: white;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      font-weight: 400;
      text-shadow: 0 1px 5px rgba(0,0,0,0.3);
    }
    .hero-btns {
      display: flex;
      gap: 1.5rem;
      justify-content: center;
      flex-wrap: wrap;
    }
    .btn {
      padding: 1rem 2.2rem;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .btn-primary {
      background: var(--primary-brown);
      color: white;
      border: 2px solid var(--primary-brown);
      box-shadow: 0 4px 15px rgba(98, 69, 28, 0.3);
    }
    .btn-primary:hover {
      background: var(--dark-brown);
      border-color: var(--dark-brown);
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(98, 69, 28, 0.4);
    }
    .btn-secondary {
      background: transparent;
      color: white;
      border: 2px solid white;
    }
    .btn-secondary:hover {
      background: white;
      color: var(--primary-brown);
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 255, 255, 0.2);
    }

    /* === Products Section === */
    #products {
      padding: 6rem 4vw;
      background: white;
      position: relative;
    }
    .section-title {
      font-size: clamp(2rem, 4vw, 3rem);
      margin-bottom: 1rem;
      text-align: center;
      color: var(--primary-brown);
      font-family: 'Playfair Display', serif;
      position: relative;
      padding-bottom: 20px;
    }
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: var(--gold);
    }
    .section-subtitle {
      text-align: center;
      color: #666;
      margin-bottom: 3rem;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      font-size: 1.1rem;
    }
    .category-tabs {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 50px;
      flex-wrap: wrap;
    }
    .category-tab {
      background: white;
      border: 1px solid #e8e1d5;
      padding: 12px 28px;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s;
      color: var(--dark-brown);
    }
    .category-tab.active {
      background: var(--primary-brown);
      color: white;
      border-color: var(--primary-brown);
      box-shadow: var(--shadow-sm);
    }
    .category-tab:hover:not(.active) {
      border-color: var(--primary-brown);
      color: var(--primary-brown);
    }
    .products-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
      justify-content: center;
    }
    .product-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem 1.5rem 1.5rem;
      position: relative;
      border: 1px solid rgba(232, 225, 213, 0.5);
    }
    .product-card:hover {
      transform: translateY(-12px);
      box-shadow: var(--shadow-lg);
    }
    .product-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-brown), var(--gold));
      transform: scaleX(0);
      transition: transform 0.5s;
    }
    .product-card:hover::before {
      transform: scaleX(1);
    }
    .product-image {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 1.5rem;
      border: 3px solid var(--light-brown);
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      transition: all 0.3s;
    }
    .product-card:hover .product-image {
      transform: scale(1.05);
      border-color: var(--gold);
    }
    .product-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      text-align: center;
      color: var(--dark-brown);
    }
    .product-type {
      font-size: 0.9rem;
      color: var(--primary-brown);
      margin-bottom: 0.8rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .product-price {
      color: var(--dark-brown);
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
    }
    .add-cart-btn {
      background: var(--primary-brown);
      color: white;
      border: none;
      border-radius: 25px;
      padding: 0.8rem 1.8rem;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.3s;
      margin-top: auto;
      width: 100%;
      max-width: 12rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 4px 10px rgba(98, 69, 28, 0.2);
    }
    .add-cart-btn:hover {
      background: var(--dark-brown);
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(98, 69, 28, 0.3);
    }

    /* === Features Section === */
    .features {
      padding: 6rem 4vw;
      background: var(--light-brown);
      position: relative;
    }
    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2.5rem;
      margin-top: 3rem;
    }
    .feature-card {
      background: white;
      border-radius: 20px;
      padding: 2.5rem 2rem;
      text-align: center;
      transition: all 0.4s;
      border: 1px solid rgba(232, 225, 213, 0.5);
      box-shadow: var(--shadow-sm);
      position: relative;
      overflow: hidden;
    }
    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-brown), var(--gold));
      transform: scaleX(0);
      transition: transform 0.5s;
    }
    .feature-card:hover::before {
      transform: scaleX(1);
    }
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-lg);
    }
    .feature-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary-brown), var(--gold));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      color: white;
      font-size: 2rem;
      box-shadow: 0 6px 15px rgba(98, 69, 28, 0.2);
    }
    .feature-title {
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--dark-brown);
    }
    .feature-desc {
      color: #666;
      line-height: 1.7;
    }

    /* === Testimonials Section === */
    .testimonials {
      padding: 6rem 4vw;
      background: white;
    }
    .testimonials-container {
      max-width: 1200px;
      margin: 0 auto;
    }
    .testimonial-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
    }
    .testimonial-card {
      background: var(--light-brown);
      border-radius: 20px;
      padding: 2.5rem 2rem;
      position: relative;
      box-shadow: var(--shadow-sm);
      transition: all 0.3s;
    }
    .testimonial-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }
    .testimonial-text {
      font-style: italic;
      margin-bottom: 1.5rem;
      color: var(--dark-brown);
      line-height: 1.7;
    }
    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .author-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--gold);
    }
    .author-info h4 {
      font-weight: 600;
      color: var(--primary-brown);
      margin-bottom: 5px;
    }
    .author-info p {
      color: #777;
      font-size: 0.9rem;
    }

    /* === Footer === */
    footer {
      background: var(--dark-brown);
      color: white;
      padding: 4rem 4vw 1.5rem;
    }
    .footer-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 3rem;
      margin-bottom: 3rem;
      max-width: 1400px;
      margin-left: auto;
      margin-right: auto;
    }
    .footer-column h3 {
      font-size: 1.4rem;
      margin-bottom: 1.5rem;
      color: var(--gold);
      position: relative;
      padding-bottom: 12px;
      font-family: 'Playfair Display', serif;
    }
    .footer-column h3::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 2px;
      background: var(--gold);
    }
    .footer-links {
      list-style: none;
    }
    .footer-links li {
      margin-bottom: 12px;
    }
    .footer-links a {
      color: #cccccc;
      text-decoration: none;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .footer-links a:hover {
      color: white;
      transform: translateX(5px);
    }
    .footer-links a i {
      width: 20px;
      text-align: center;
      color: var(--gold);
    }
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 1.5rem;
    }
    .social-link {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      transition: all 0.3s;
    }
    .social-link:hover {
      background: var(--gold);
      transform: translateY(-3px);
    }
    .copyright {
      text-align: center;
      padding-top: 2.5rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #aaaaaa;
      font-size: 0.9rem;
      max-width: 1400px;
      margin-left: auto;
      margin-right: auto;
    }

    /* === Responsive Overrides === */
    @media (max-width: 1024px) {
      .hero-title {
        font-size: 3.5rem;
      }
    }
    @media (max-width: 768px) {
      .header-container {
        flex-direction: column;
        gap: 1.2rem;
        padding-bottom: 1rem;
      }
      .logo {
        margin-bottom: 0.5rem;
      }
      .nav-links {
        gap: 1rem;
      }
      .search-container {
        width: 100%;
        max-width: 100%;
        margin: 0.5rem 0;
      }
      .hero {
        height: auto;
        min-height: 600px;
        padding: 4rem 0;
      }
      .video-container {
        flex-direction: column;
      }
      .video-panel {
        height: 50%;
      }
      .hero-btns {
        flex-direction: column;
        align-items: center;
      }
      .btn {
        width: 100%;
        max-width: 280px;
        justify-content: center;
      }
      .product-card {
        width: 100%;
      }
      .features-grid, .testimonial-cards {
        grid-template-columns: 1fr;
      }
    }
    @media (max-width: 480px) {
      .hero-title {
        font-size: 2.2rem;
      }
      .hero-subtitle {
        font-size: 1rem;
      }
      .products-list {
        grid-template-columns: 1fr;
      }
      .category-tabs {
        flex-wrap: wrap;
      }
      .category-tab {
        padding: 10px 20px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <!-- === Premium Header === -->
  <header id="mainHeader">
    <div class="header-container">
      <div class="logo">
        <img src="{{ asset('Assets/logo.png') }}" alt="Royal Fresh Logo" />
        Royal Fresh
      </div>
      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" placeholder="Search products..." oninput="filterProducts()" />
      </div>
      <nav class="nav-links">
        <a href="#">Home</a>
        <a href="/all-products">Products</a>
        <a href="#features">Features</a>
        <a href="#testimonials">Testimonials</a>
        <a href="#contact">Contact</a>
      </nav>
    </div>
  </header>

  <!-- === Premium Hero Section with Videos === -->
  <section class="hero">
    <div class="video-container">
      <div class="video-panel meat-panel">
        <video autoplay loop muted playsinline>
          <source src="{{ asset('Assets/meat.mp4') }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <div class="video-overlay"></div>
      </div>
      <div class="video-panel milk-panel">
        <video autoplay loop muted playsinline>
          <source src="{{ asset('Assets/milk.mp4') }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <div class="video-overlay"></div>
      </div>
    </div>
    <div class="hero-content">
      <h1 class="hero-title">Premium Quality Meat & Dairy</h1>
      <p class="hero-subtitle">Experience the finest selection of farm-fresh products, carefully sourced and delivered to your doorstep with uncompromising quality.</p>
      <div class="hero-btns">
        <a href="#products" class="btn btn-primary">
          <i class="fas fa-shopping-basket"></i> Shop Now
        </a>
        <a href="#features" class="btn btn-secondary">
          <i class="fas fa-play-circle"></i> Learn More
        </a>
      </div>
    </div>
  </section>

  <!-- === Products Section === -->
  <section id="products">
    <h2 class="section-title">Our Premium Selection</h2>
    <p class="section-subtitle">
      Carefully curated products that meet our stringent quality standards for freshness and taste
    </p>
    
    <div class="category-tabs">
      <div class="category-tab active" onclick="filterByCategory('all')">All Products</div>
      <div class="category-tab" onclick="filterByCategory('meat')">Meat Selection</div>
      <div class="category-tab" onclick="filterByCategory('dairy')">Dairy Products</div>
    </div>
    
    <div class="products-list" id="productsList">
      <!-- Meat Products -->
        @foreach ($products as $product)
      <div class="product-card" data-title="{{ strtolower($product->product_name) }}" 
     data-type="{{ strtolower($product->category->name) }}">
        <img src="{{ asset('images/product_images/' . $product->featured_image) }}" alt="{{ $product->product_name }}" class="product-image" />
        <h3 class="product-title">{{ $product->product_name }}</h3>
        <div class="product-type">{{ ucfirst($product->category->name) }}</div>
         @if($product->variant_type == 'simple')
         <div class="product-price">AED {{ $product->s_price }}/{{$product->s_weight}} {{$product->Sunit->name}}</div>
        @else
        <div class="product-price">From AED {{ $product->Productvariants->min('price') }}/{{ $product->Productvariants->min('weight') }} {{$product->unit->name}} </div>
        @endif
        <button class="add-cart-btn">
          <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
      </div>
      @endforeach
      
     
  </section>

  <!-- === Features Section === -->
  <section class="features" id="features">
    <h2 class="section-title">Why Choose Royal Fresh</h2>
    <p class="section-subtitle">
      We are committed to excellence in every aspect of our service and products
    </p>
    
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-award"></i>
        </div>
        <h3 class="feature-title">Premium Quality</h3>
        <p class="feature-desc">All our products undergo rigorous quality checks to ensure they meet the highest standards of freshness and taste.</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-truck"></i>
        </div>
        <h3 class="feature-title">Fast Delivery</h3>
        <p class="feature-desc">We deliver fresh products to your doorstep within 24 hours of ordering with our temperature-controlled logistics.</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-leaf"></i>
        </div>
        <h3 class="feature-title">Natural & Fresh</h3>
        <p class="feature-desc">Our products are sourced from trusted farms with no artificial additives, preservatives, or hormones.</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-headset"></i>
        </div>
        <h3 class="feature-title">24/7 Support</h3>
        <p class="feature-desc">Our dedicated customer support team is available round the clock to assist you with any queries or concerns.</p>
      </div>
    </div>
  </section>

  <!-- === Testimonials Section === -->
  <section class="testimonials" id="testimonials">
    <div class="testimonials-container">
      <h2 class="section-title">What Our Customers Say</h2>
      <p class="section-subtitle">
        Don't just take our word for it - hear from our satisfied customers
      </p>
      
      <div class="testimonial-cards">
        <div class="testimonial-card">
          <p class="testimonial-text">"The quality of meat from Royal Fresh is exceptional. I've been a customer for over two years and have never been disappointed. Their delivery is always on time and the products are consistently fresh."</p>
          <div class="testimonial-author">
            <img src="{{asset('Assets/customer1.jpg')}}" alt="Customer" class="author-avatar" />
            <div class="author-info">
              <h4>Rajesh Kumar</h4>
              <p>Regular Customer</p>
            </div>
          </div>
        </div>
        
        <div class="testimonial-card">
          <p class="testimonial-text">"As a restaurant owner, I rely on Royal Fresh for all my meat and dairy supplies. Their consistent quality and reliable delivery have helped me maintain the standards my customers expect."</p>
          <div class="testimonial-author">
            <img src="{{asset('Assets/customer2.jpg')}}" alt="Customer" class="author-avatar" />
            <div class="author-info">
              <h4>Priya Sharma</h4>
              <p>Restaurant Owner</p>
            </div>
          </div>
        </div>
        
        <div class="testimonial-card">
          <p class="testimonial-text">"The milk from Royal Fresh tastes exactly like it did when I was a child - pure and unadulterated. My family won't drink milk from anywhere else now. Thank you for bringing back real taste!"</p>
          <div class="testimonial-author">
            <img src="{{asset('Assets/customer3.jpg')}}" alt="Customer" class="author-avatar" />
            <div class="author-info">
              <h4>Anita Desai</h4>
              <p>Homemaker</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- === Footer === -->
  <footer id="contact">
    <div class="footer-container">
      <div class="footer-column">
        <h3>Royal Fresh</h3>
        <p>Premium quality meat and dairy products delivered fresh to your doorstep across India since 1997. Experience the difference that quality makes.</p>
        <div class="social-links">
          <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      
      <div class="footer-column">
        <h3>Quick Links</h3>
        <ul class="footer-links">
          <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
          <li><a href="/all-products"><i class="fas fa-chevron-right"></i> Products</a></li>
          <li><a href="#features"><i class="fas fa-chevron-right"></i> Features</a></li>
          <li><a href="#testimonials"><i class="fas fa-chevron-right"></i> Testimonials</a></li>
          <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h3>Contact Info</h3>
        <ul class="footer-links">
          <li><a href="#"><i class="fas fa-map-marker-alt"></i> 123 Fresh Street, Mumbai, India</a></li>
          <li><a href="tel:+911234567890"><i class="fas fa-phone"></i> +91-1234-567-890</a></li>
          <li><a href="mailto:info@royalfresh.com"><i class="fas fa-envelope"></i> info@royalfresh.com</a></li>
          <li><a href="#"><i class="fas fa-clock"></i> Mon-Sun: 8:00 AM - 10:00 PM</a></li>
        </ul>
      </div>
    </div>
    
    <div class="copyright">
      © 2025 Royal Fresh. All rights reserved. | Crafted with <i class="fas fa-heart" style="color: var(--gold);"></i> for discerning customers
    </div>
  </footer>

  <script>
    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.getElementById('mainHeader');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Filter products by category
    function filterByCategory(category) {
      const cards = document.querySelectorAll('.product-card');
      const tabs = document.querySelectorAll('.category-tab');
      
      // Update active tab
      tabs.forEach(tab => tab.classList.remove('active'));
      event.target.classList.add('active');
      
      // Show/hide products based on category
      cards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-type') === category) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // Filter products by search
    function filterProducts() {
      const input = document.getElementById('searchInput').value.trim().toLowerCase();
      const cards = document.querySelectorAll('.product-card');
      cards.forEach((card) => {
        const title = card.getAttribute('data-title').toLowerCase();
        const type = card.getAttribute('data-type').toLowerCase();
        card.style.display = title.includes(input) || type.includes(input) ? 'flex' : 'none';
      });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
</body>
</html>