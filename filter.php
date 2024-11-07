

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk yang Ditemukan</title>
  <!-- Include CSS & JS -->
</head>
<body>
  <h2 class="text-3xl"></h2>
  <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
    
  </div>
</body>
</html>


<?php
include 'conect.php';
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}


$sql = "SELECT id, nama_produk, foto_produk, deskripsi, harga, jenis_produk FROM produk ORDER BY id";
$result = $conn->query($sql);

$produk_list = []; // Inisialisasi array kosong

if ($result->num_rows > 0) {
  // Menyimpan nama dan gambar produk ke dalam array
  while ($row = $result->fetch_assoc()) {
    $produk_list[] = [
      'id' => $row['id'],
      'nama_produk' => htmlspecialchars($row['nama_produk']),
      'foto_produk' => htmlspecialchars($row['foto_produk']),
      'deskripsi' => htmlspecialchars($row['deskripsi']),
      'harga' => htmlspecialchars($row['harga'])
    ]; // Tambahkan data produk ke array
  }
} else {
  echo "<p>Tidak ada produk yang ditemukan.</p>";
}


$sql = "SELECT id, nama_produk, foto_produk, deskripsi, harga, jenis_produk FROM produk";

// Jika ada filter berdasarkan jenis produk, modifikasi query SQL
if (isset($_GET['jenis_produk']) && !empty($_GET['jenis_produk'])) {
  $categories = $_GET['jenis_produk'];
  $categories = array_map(function($category) {
    return "'" . $category . "'";
  }, $categories);
  
  $sql .= " WHERE jenis_produk IN (" . implode(',', $categories) . ")";
}

$sql .= " ORDER BY id";
$result = $conn->query($sql);

$produk_list = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $produk_list[] = [
      'id' => $row['id'],
      'nama_produk' => htmlspecialchars($row['nama_produk']),
      'foto_produk' => htmlspecialchars($row['foto_produk']),
      'deskripsi' => htmlspecialchars($row['deskripsi']),
      'harga' => htmlspecialchars($row['harga']),
      'jenis_produk' => htmlspecialchars($row['jenis_produk']),
    ];
  }
} else {
  echo "<p>Tidak ada produk yang ditemukan.</p>";
}


?>


<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5C065]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opening</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
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
  .group:hover .group-hover\:opacity-100 {
    opacity: 1; /* Menampilkan teks saat hover */
    transition-opacity: 200ms; /* Waktu transisi saat teks muncul */
}
</style>

<body class="bg-[#F5C065]">
  <div class="">
    <ul class="menu menu-horizontal rounded-box place-items-end flex justify-betwen" id="nav-menu">
      <li class="relative group inline-block">
      <a class="group hover:bg-white relative" href="index.php" onclick="return confirmLogout();">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        color="#D23D2D"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
    </svg>
    <span class="absolute left-1/2 -translate-x-1/2 mt-2 rounded-md bg-gray-800 text-white text-xs px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        Logout
    </span>
</a>

        <!-- Tooltip -->
        
      </li>

      <li>
        <a class="hover:bg-white" id="settingsButton">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            color="#D23D2D"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </a>
      </li>
    </ul>
    <div id="settingsContent" class="hidden">
      <div class="flex h-40 flex-col justify-betwen position-absolute">
        <div class="px-4 py-6">
          <span class="font-medium font-bold font-xl text-[#31603D]">Pengaturan</span>
          <br><br>
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary
              class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2">
              <span class="text-sm font-medium text-[#D23D2D] hover:text-[#31603D]"> Akun </span>
              <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-5"
                  viewBox="0 0 20 20"
                  fill="currentColor">
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </span>
            </summary>
            <ul class="mt-2 space-y-1 px-4">
              <li>
                <a
                  href="profileUser.php"
                  class="block rounded-lg px-4 py-2 text-sm font-medium text-[#31603D] hover:text-[#D23D2D]">
                  Profile Anda
                </a>
              <li>
              <li>
                <a
                  href="editProfile.php"
                  class="block rounded-lg px-4 py-2 text-sm font-medium text-[#31603D] hover:text-[#D23D2D]">
                  Edit Profile
                </a>
              <li>
                <a
                  href="jualProduk.php"
                  class="block rounded-lg px-4 py-2 text-sm font-medium text-[#31603D] hover:text-[#D23D2D]">
                  Jual Produk
                </a>
              </li>
              <li>
                <a
                  href="promosi.php"
                  class="block rounded-lg px-4 py-2 text-sm font-medium text-[#31603D] hover:text-[#D23D2D]">
                  Promosi Produk
                </a>
              </li>
            </ul>
          </details>
        </div>
      </div>
    </div>
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
          <button type="submit" class="mx-3 text-[#31603D]">Cari</button>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            color="#31603d"
            class="h-4 w-4 opacity-70">
            <path
              fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
          
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

      <form method="GET" action="filter.php">
  <div id="filter">
    <a class="flex items-center justify-between p-4">
      <span id="selected-count" class="text-sm text-[#D23D2D]">0 Terpilih</span>
      <button id="reset-button" type="reset" class="text-sm text-[#D23D2D] underline underline-offset-4 mx-10">
        Reset
      </button>
      <a href="homePage.php" id="reset-button" class="text-sm text-[#D23D2D] underline underline-offset-4 mx-10 -mt-3">Kembali</a>
      
    </a>
    <ul class="space-y-1 border-t p-4">
      <li>
        <label for="FilterMakanan" class="inline-flex items-center gap-2">
          <input type="checkbox" name="jenis_produk[]" value="Makanan" id="FilterMakanan" class="size-5 rounded filter-checkbox" />
          <span class="text-sm font-medium text-[#D23D2D]">Makanan</span>
        </label>
      </li>
      <li>
        <label for="FilterMinuman" class="inline-flex items-center gap-2">
          <input type="checkbox" name="jenis_produk[]" value="Minuman" id="FilterMinuman" class="size-5 rounded filter-checkbox" />
          <span class="text-sm font-medium text-[#D23D2D]">Minuman</span>
        </label>
      </li>
      <li>
        <label for="FilterDessert" class="inline-flex items-center gap-2">
          <input type="checkbox" name="jenis_produk[]" value="Dessert" id="FilterDessert" class="size-5 rounded filter-checkbox" />
          <span class="text-sm font-medium text-[#D23D2D]">Dessert</span>
        </label>
      </li>
    </ul>
  </div>
  <button type="submit" class="hidden"></button> <!-- Submit button for form -->
</form>

    </details>
    <!-- end -->
  </div>
  <!-- Produk -->
  <br><br><br>
  <section class="">
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
      <div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#D23D2D] font-bold sm:text-4xl">Produk yang Ditemukan</h2>
      </div>
      <div class="container mx-auto text-center pt-6">
      <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($produk_list as $produk) : ?>
        <div class="bg-[#F8EECB] block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-pink-500/10 hover:shadow-pink-500/10">
        <img src="<?php echo $produk['foto_produk']; ?>" alt="<?php echo $produk['nama_produk']; ?>" class="w-full h-56 object-cover rounded-xl mb-4">
            <h2 class="mt-4 text-xl font-bold text-[#D23D2D]"><?php echo $produk['nama_produk']; ?></h2>

            <p class="mt-1 text-sm text-[#31603D]">
            <?php echo $produk['deskripsi']; ?>
            </p>

            <h2 class="mt-4 text-l font-bold text-[#D23D2D]">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></h2>
            <br>
            <a href="produkPage.php?id=<?php echo $produk['id']; ?>">
                <button class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-white transition hover:bg-[#31603D]">Beli</button>
            </a>
        </div>
    <?php endforeach; ?>

</div>

        
    </div>
  </section>
  <!-- end -->
   <script>
     function confirmLogout() {
    return confirm("Apakah Anda yakin ingin log out?");
}
   </script>
  <script src="script.js"></script>
</body>

</html>
