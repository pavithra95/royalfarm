<style>
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f8f8f8;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .logo img {
    height: 50px;
  }

  .search-container {
    /* flex-grow: 1; */
    margin: 0 20px;
  }

  #searchInput {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .nav-links a {
    margin-left: 20px;
    text-decoration: none;
    color: #333;
    font-weight: bold;
  }

  .nav-links a:hover {
    color: #007bff;
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
 <header>
    <div class="logo">
      <img src="Assets/logo.png" alt="Logo" />
      
    </div>
    <div class="search-container">
      <input
        type="text"
        id="searchInput"
        placeholder="Search products..."
        oninput="filterProducts()"
      />
    </div>
    <nav class="nav-links">
      <a href="/home">Home</a>
      <a href="#meat">Meat</a>
      <a href="#milk">Milk</a>
      <a href="/all-products">Products</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>