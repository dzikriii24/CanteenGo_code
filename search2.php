<?php
include 'conect.php';
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5C065]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Hasil Pencarian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
        #btn-back:hover {
      background-color: white;
      color: #D23D2D;
    }

    #btn-back {
      background-color: #D23D2D;
      color: white;
    }
  .carousel-item {
    display: none;
  }

  .carousel-item.active {
    display: block;
  }

  #filter {
    position: absolute;
  }

  #search::placeholder {
    color: #31603D;
  }

  #search {
    background-color: #F8EECB;
    outline: none;
  }

  .hidden {
    display: none;
  }

  .visible {
    display: block;
  }

  @media (max-width: 768px) {
    #nav-menu {
      margin-bottom: 100px;
    }

    #settingsContent {
      margin-top: -120px;
      position: absolute;
    }
  }
</style>

<body class="bg-[#F5C065]">
  <div class="">
    <!-- Navbar,logo -->
    <div class="place-content-center items-center flex justify-center pt-4">
      <div class="navbar-center">
        <img id="image" src="image/cgso.png" class="h-28 w-28 mx-52" />
        <h2 class="text-center text-xl text-[#31603D]"><?php echo "<p id=dd>Selamat Datang di CanteenGo " . $_SESSION['username'] . " !!" . "</p>"; ?></h2>
      </div>
    </div>
    <br><br>
    </span>
    <div class="rounded-xl">
      <form action="search.php" method="POST">
      <div class="place-content-center items-center flex justify-center" id="">
        <label class="input input-bordered flex items-center mt-4 w-50 text-[#D23D2D]" id="search">
          <input type="text" class="grow " placeholder="Mau cari apa?" id="search" name="query" />
          <button type="submit" class="-mx-3 text-[#31603D]">Cari</button>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            color="#31603d"
            class="h-4 w-4 opacity-70 mx-7">
            <path
              fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
          <a href="homePage.php"><button id="btn-back" class="top-4 left-4 px-4 py-2 rounded-md -mx-2">
      Hapus Pencarian
    </button></a>
        </label>
      </div>
      </form>
      
      <!-- end -->
      <br>
      <!-- Promotion -->
      <div class="carousel w-full place-content-center cursor-pointer">
        <div id="item1" class="carousel-item w-full">
          <img
            src="image/Nasi Goreng Cihuy.png"
            class="w-full h-72 rounded-xl" />
        </div>
        <div id="item2" class="carousel-item w-full">
          <img
            src="image/burgerbangor.png"
            class="w-full h-72 rounded-xl" />
        </div>
      </div>
      <!-- end -->
    </div>
  </div>

  <br><br>
  <!-- Filter -->
  <div class="place-content-center items-center flex justify-center mt-4 mb-2">
    <details
      class="w-50 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
      <summary
        class="rounded-xl flex cursor-pointer items-center justify-between gap-2 bg-[#F8EECB] p-3 text-gray-900 transition">
        <span class="text-sm font-medium text-[#31603D]"> Filter Produk </span>

        <span class="transition group-open:-rotate-180">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-4"
            color="#31603D">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
          </svg>
        </span>
      </summary>

      <div class="" id="filter">
        <header class="flex items-center justify-between p-4">
          <span id="selected-count" class="text-sm text-[#D23D2D]">0 Terpilih</span>
          <button id="reset-button" type="button" class="text-sm text-[#D23D2D] underline underline-offset-4 mx-10">
            Reset
          </button>
        </header>

        <ul class="space-y-1 border-t p-4" id="filter">
          <li>
            <label for="FilterInStock" class="inline-flex items-center gap-2">
              <input type="checkbox" id="FilterInStock" class="size-5 rounded filter-checkbox" />
              <span class="text-sm font-medium text-[#D23D2D]"> Makanan </span>
            </label>
          </li>

          <li>
            <label for="FilterPreOrder" class="inline-flex items-center gap-2">
              <input type="checkbox" id="FilterPreOrder" class="size-5 rounded filter-checkbox" />
              <span class="text-sm font-medium text-[#D23D2D]"> Minuman </span>
            </label>
          </li>

          <li>
            <label for="FilterOutOfStock" class="inline-flex items-center gap-2">
              <input type="checkbox" id="FilterOutOfStock" class="size-5 rounded filter-checkbox" />
              <span class="text-sm font-medium text-[#D23D2D]"> Dessert </span>
            </label>
          </li>
        </ul>
      </div>
    </details>
    <!-- end -->
  </div>
  <!-- Produk -->
  <br><br><br>
  <section class="">
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
      <div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#D23D2D] font-bold sm:text-4xl">Hasil Pencarian <?php echo $_POST['query']?></h2>
      </div>
      <div class="container mx-auto text-center pt-6">
      <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
</div>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query'])) {
    $query = $_POST['query'];

    // Query untuk mencari data berdasarkan nama_produk
    $sqlies = "SELECT id, nama_produk, deskripsi, harga, foto_produk FROM produk WHERE nama_produk LIKE ?";
    $stmte = $conn->prepare($sqlies);
    $searchTerm = "%" . $conn->real_escape_string($query) . "%"; // Menambahkan wildcard untuk pencarian
    $stmte->bind_param("s", $searchTerm);
    $stmte->execute();
    $result = $stmte->get_result();

    // Array untuk menyimpan produk yang ditemukan
    $produk_list = [];

    // Memeriksa apakah ada hasil
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Menambahkan produk ke array
            $produk_list[] = $row;
        }
    } else {
        echo "<p>Tidak ada hasil ditemukan untuk: " . htmlspecialchars($query) . "</p>";
    }

    $stmte->close();
    $_SESSION['produk_list'] = $produk_list; // Simpan hasil pencarian ke session
    $_SESSION['query'] = $query; // Simpan query ke session

    // Redirect ke halaman yang sama
    header("Location: " . $_SERVER['PHP_SELF']);
    exit(); // Pastikan untuk keluar setelah redirect
}
$produk_list = isset($_SESSION['produk_list']) ? $_SESSION['produk_list'] : [];


// Tampilkan hasil pencarian jika ada
// Tampilkan hasil pencarian jika ada
if (!empty($produk_list)) : ?>
    <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($produk_list as $produk) : ?>
            <div class="bg-[#F8EECB] block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-pink-500/10 hover:shadow-pink-500/10">
                <img src="<?php echo htmlspecialchars($produk['foto_produk']); ?>" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" class="w-full h-48 object-cover rounded-xl mb-4">

                <h2 class="mt-4 text-xl font-bold text-[#D23D2D]"><?php echo htmlspecialchars($produk['nama_produk']); ?></h2>

                <p class="mt-1 text-sm text-[#31603D]">
                    <?php echo htmlspecialchars($produk['deskripsi']); ?>
                </p>

                <h2 class="mt-4 text-l font-bold text-[#D23D2D]">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></h2>
                <br>
                <a href="produkPage.php?id=<?php echo $produk['id']; ?>">
                    <button class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-white transition hover:bg-[#31603D]">Beli</button>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php
endif;

?>

        
    </div>
  </section>
  <!-- end -->

  <script src="script.js"></script>
</body>

</html>