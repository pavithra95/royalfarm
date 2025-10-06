<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Royal Fresh – Premium Products</title>
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

    /* === Main Content === */
    .main-content {
      margin-top: 100px;
      padding: 2rem 4vw;
    }
    .container {
      max-width: 1600px;
      margin: 0 auto;
      display: flex;
      gap: 2.5rem;
    }

    /* === Filter Sidebar - Fixed with Scroll === */
    .filter-sidebar {
      width: 280px;
      background: white;
      border-radius: 20px;
      padding: 2rem 1.5rem;
      box-shadow: var(--shadow-sm);
      border: 1px solid rgba(232, 225, 213, 0.5);
      height: calc(100vh - 140px);
      position: sticky;
      top: 120px;
      overflow-y: auto;
    }
    .filter-sidebar::-webkit-scrollbar {
      width: 6px;
    }
    .filter-sidebar::-webkit-scrollbar-track {
      background: var(--light-brown);
      border-radius: 10px;
    }
    .filter-sidebar::-webkit-scrollbar-thumb {
      background: var(--gold);
      border-radius: 10px;
    }
    .filter-sidebar h3 {
      font-size: 1.5rem;
      color: var(--primary-brown);
      margin-bottom: 1.5rem;
      padding-bottom: 12px;
      border-bottom: 2px solid var(--gold);
      font-family: 'Playfair Display', serif;
    }
    .filter-group {
      margin-bottom: 2rem;
    }
    .filter-group h4 {
      font-size: 1.1rem;
      color: var(--dark-brown);
      margin-bottom: 1rem;
      font-weight: 600;
    }
    .filter-options {
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
    }
    .filter-option {
      display: flex;
      align-items: center;
      gap: 0.8rem;
    }
    .filter-option input[type="checkbox"] {
      accent-color: var(--gold);
      width: 18px;
      height: 18px;
    }
    .filter-option label {
      font-size: 0.95rem;
      color: var(--dark-brown);
      cursor: pointer;
    }
    .price-range {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .price-inputs {
      display: flex;
      gap: 0.8rem;
    }
    .price-inputs input {
      width: 100%;
      border: 1.5px solid var(--light-brown);
      border-radius: 8px;
      padding: 0.7rem 0.8rem;
      background: white;
      color: var(--dark-brown);
      font-weight: 500;
      outline: none;
      transition: all 0.3s;
    }
    .price-inputs input:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(200, 169, 126, 0.2);
    }
    .price-slider {
      width: 100%;
      height: 6px;
      background: var(--light-brown);
      border-radius: 5px;
      outline: none;
      -webkit-appearance: none;
    }
    .price-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: var(--gold);
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      transition: all 0.3s;
    }
    .price-slider::-webkit-slider-thumb:hover {
      background: var(--primary-brown);
      transform: scale(1.1);
    }
    .filter-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }
    .filter-btn {
      flex: 1;
      padding: 0.9rem 0;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      font-size: 1rem;
      border: none;
    }
    .apply-btn {
      background: var(--primary-brown);
      color: white;
      box-shadow: var(--shadow-sm);
    }
    .reset-btn {
      background: transparent;
      color: var(--dark-brown);
      border: 1.5px solid var(--light-brown);
    }
    .apply-btn:hover {
      background: var(--dark-brown);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }
    .reset-btn:hover {
      background: var(--light-brown);
      border-color: var(--gold);
    }

    /* === Products Container === */
    .products-container {
      flex: 1;
    }
    .category-section {
      border-radius: 20px;
      margin-bottom: 3rem;
      padding: 2.5rem 2rem;
      box-shadow: var(--shadow-sm);
      background: white;
      border: 1px solid rgba(232, 225, 213, 0.5);
    }
    .category-header {
      text-align: center;
      margin-bottom: 2.5rem;
      position: relative;
    }
    .category-title {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--primary-brown);
      margin-bottom: 0.5rem;
      font-family: 'Playfair Display', serif;
      position: relative;
      display: inline-block;
      padding-bottom: 10px;
    }
    .category-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: var(--gold);
    }

    /* === Premium Product Cards - 4 per row === */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2rem;
      margin-bottom: 1.5rem;
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
      width: 140px;
      height: 140px;
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
      line-height: 1.3;
      height: 3.2rem;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
    .product-price {
      color: var(--dark-brown);
      font-size: 1.3rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }
    .product-weight-label {
      font-weight: 500;
      font-size: 0.95rem;
      color: var(--primary-brown);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    select.product-weight {
      border-radius: 8px;
      padding: 0.5rem 0.8rem;
      border: 1.5px solid var(--light-brown);
      background: white;
      color: var(--dark-brown);
      font-weight: 500;
      font-size: 0.95rem;
      outline: none;
      transition: all 0.3s;
      cursor: pointer;
    }
    select.product-weight:hover, select.product-weight:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(200, 169, 126, 0.2);
    }
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 1rem 0 1.2rem 0;
      justify-content: center;
    }
    .quantity-controls button {
      background: var(--primary-brown);
      border: none;
      color: white;
      border-radius: 8px;
      padding: 0.6rem 0.9rem;
      font-weight: bold;
      font-size: 1.1rem;
      cursor: pointer;
      user-select: none;
      transition: all 0.3s;
      box-shadow: var(--shadow-sm);
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .quantity-controls button:hover {
      background: var(--dark-brown);
      transform: translateY(-2px);
    }
    .quantity-controls input {
      width: 50px;
      border: 1.5px solid var(--light-brown);
      border-radius: 8px;
      text-align: center;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 0.6rem 0;
      color: var(--dark-brown);
      background: white;
      outline: none;
      user-select: none;
      transition: all 0.3s;
    }
    .quantity-controls input:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(200, 169, 126, 0.2);
    }
    .add-cart-btn {
      background: var(--primary-brown);
      color: white;
      border: none;
      border-radius: 25px;
      padding: 0.9rem 1.5rem;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
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

    /* === Responsive Overrides === */
    @media (max-width: 1400px) {
      .products-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }
    @media (max-width: 1200px) {
      .products-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 1024px) {
      .container {
        flex-direction: column;
        padding: 0;
      }
      .filter-sidebar {
        width: 100%;
        position: static;
        height: auto;
        max-height: 400px;
      }
      .products-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
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
      .main-content {
        margin-top: 140px;
        padding: 1rem 2vw;
      }
      .products-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .category-section {
        padding: 2rem 1.5rem;
      }
    }
    @media (max-width: 480px) {
      .products-grid {
        grid-template-columns: 1fr;
      }
      .category-title {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>
  <!-- === Premium Header === -->
  <header id="mainHeader">
    <div class="header-container">
      <div class="logo">
        <img src="Assets/logo.png" alt="Royal Fresh Logo" />
        Royal Fresh
      </div>
      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" placeholder="Search products..." oninput="filterProducts()" />
      </div>
      <nav class="nav-links">
        <a href="/home">Home</a>
        <a href="/all-products">Products</a>
        <a href="#features">Features</a>
        <a href="#testimonials">Testimonials</a>
        <a href="#contact">Contact</a>
      </nav>
    </div>
  </header>

  <!-- === Main Content === -->
  <div class="main-content">
    <div class="container">
      <!-- Filter Sidebar -->
      <aside class="filter-sidebar">
        <h3>Filter Products</h3>
        <form id="filterForm">
        
        <div class="filter-group">
          <h4>Categories</h4>
          <div class="filter-options">
             @foreach($categories as $category)
            <div class="filter-option">
               <input type="checkbox" name="categories[]" value="{{ $category->id }}">
              <label for="{{ $category->name }}">{{ $category->name }}</label>
            </div>
            @endforeach
           
          </div>
        </div>
        
        <div class="filter-group">
          <h4>Price Range</h4>
          <div class="price-range">
            <div class="price-inputs">
              <input type="number" name="min_price" placeholder="Min">
                <input type="number" name="max_price" placeholder="Max">
            </div>
            <!-- <input type="range" class="price-slider" min="0" max="100" value="100"> -->
          </div>
        </div>
        
        <!-- <div class="filter-group">
          <h4>Weight Options</h4>
          <div class="filter-options">
            <div class="filter-option">
              <input type="checkbox" id="250g">
              <label for="250g">250 grams</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="500g">
              <label for="500g">500 grams</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="1kg">
              <label for="1kg">1 kg</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="1l">
              <label for="1l">1 litre</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="2l">
              <label for="2l">2 litre</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="5l">
              <label for="5l">5 litre</label>
            </div>
          </div>
        </div> -->
        
        <!-- <div class="filter-group">
          <h4>Availability</h4>
          <div class="filter-options">
            <div class="filter-option">
              <input type="checkbox" id="in-stock" checked>
              <label for="in-stock">In Stock</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="out-of-stock">
              <label for="out-of-stock">Out of Stock</label>
            </div>
          </div>
        </div> -->
        
        <div class="filter-group">
          <h4>Ratings</h4>
          <div class="filter-options">
            <div class="filter-option">
              <input type="checkbox" id="rating5">
              <label for="rating5">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="rating4">
              <label for="rating4">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i> & above
              </label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="rating3">
              <label for="rating3">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i> & above
              </label>
            </div>
          </div>
        </div>
        
        <div class="filter-buttons">
          <button type="submit" class="filter-btn apply-btn">Apply Filters</button>
          <button type="reset" class="filter-btn reset-btn">Reset</button>
        </div>
        </form>
      </aside>
      
      <!-- Products Container -->
     
        
<main class="products-container" id="product-list">
    @include('front.partials.products', ['products' => $category->products])
</main>

          
      


       
      </main>
    </div>
  </div>

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

    // Update quantity function
    function updateQuantity(btn, change) {
      const input = btn.parentElement.querySelector('input[type=number]');
      let current = parseInt(input.value);
      current += change;
      if (current < 1) current = 1;
      input.value = current;
    }

    // Filter products by search
    function filterProducts() {
      const input = document.getElementById('searchInput').value.trim().toLowerCase();
      const cards = document.querySelectorAll('.product-card');
      cards.forEach((card) => {
        const title = card.querySelector('.product-title').textContent.toLowerCase();
        card.style.display = title.includes(input) ? 'flex' : 'none';
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

// document.getElementById('filterForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     let formData = new FormData(this);

//     fetch("{{ route('filter.products') }}?" + new URLSearchParams(formData), {
//         headers: { 'X-Requested-With': 'XMLHttpRequest' }
//     })
//     .then(res => res.json())
//     .then(data => {
//         document.getElementById('product-list').innerHTML = data.html;
//     });
// });


const filterForm = document.getElementById('filterForm');
const productList = document.getElementById('product-list');

// Apply filters
filterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    fetchProducts(new FormData(this));
});

// Reset filters
document.querySelector('.reset-btn').addEventListener('click', function(e) {
    e.preventDefault(); // prevent full page reload

    filterForm.reset(); // clear all inputs

    // Fetch products again with no filters
    fetch("{{ route('filter.products') }}", {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        productList.innerHTML = data.html;
    });
});

// Common fetch function
function fetchProducts(formData) {
    fetch("{{ route('filter.products') }}?" + new URLSearchParams(formData), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        productList.innerHTML = data.html;
    });
}

// Auto-submit on change
document.querySelectorAll('#filterForm input').forEach(input => {
    input.addEventListener('change', () => {
        filterForm.dispatchEvent(new Event('submit'));
    });
});


</script>

</body>
</html>