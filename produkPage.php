<?php 
include 'conect.php';
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}

$productID = $_GET['id'];
// Query untuk mendapatkan detail produk
$sqlProduk = "SELECT p.nama_produk, p.deskripsi, p.harga, p.foto_produk, u.username AS penjual, u.nomerwa, u.fotoprofile 
              FROM produk p
              JOIN user u ON p.username_penjual = u.username
              WHERE p.id = ?";
$stmtProduk = $conn->prepare($sqlProduk);
$stmtProduk->bind_param("i", $productID);
$stmtProduk->execute();
$resultProduk = $stmtProduk->get_result();
$produk = $resultProduk->fetch_assoc();

// Cek apakah produk ada
if (!$produk) {
  echo "Produk tidak ditemukan.";
  exit;
}


?>

<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5C065]">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-[#F5C065]">
<button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md bg-[#D23D2D] text-white">
      Back
</button>
<section>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
      <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
        <img alt="Produk" src="<?php echo htmlspecialchars($produk['foto_produk']); ?>" />
      </div>

      <div class="lg:py-6 bg-[#F8EECB] px-12 rounded-xl">
        <h2 class="text-3xl font-bold sm:text-4xl text-[#D23D2D]"><?php echo htmlspecialchars($produk['nama_produk']); ?></h2>

        <p class="mt-4 text-[#31603D]"><?php echo htmlspecialchars($produk['deskripsi']); ?></p>

        <p class="text-2xl font-bold sm:text-2xl mt-4 text-[#D23D2D]">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
        
        <!-- Profil Penjual -->
        <div class="navbar mt-4">
          <div class="flex-none">
            <div class="dropdown dropdown-betwen">
              <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar outline-none border-none">
                <p class="text-xl font-bold mt-0 mb-3 text-[#31603D]">
                    Penjual
                </p>
                <div class="w-16 h-16 rounded-full">
                  <img src="<?php echo htmlspecialchars($produk['fotoprofile']); ?>" alt="Profile Penjual" />
                </div>
                <p class="text-sm mt-2 text-[#31603D] w-40"><?php echo htmlspecialchars($produk['penjual']); ?></p>
              </div>
              <ul tabindex="0" class="menu menu-sm dropdown-content text-[#D23D2D] hover:text-[#31603D] z-[1] mt-3 mx-20 w-40 p-1">
                <li>
                  <a href="profilePenjual.php?username=<?php echo urlencode($produk['penjual']); ?>">
                    Profile Penjual
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <a href="https://wa.me/<?php echo htmlspecialchars($produk['nomerwa']); ?>?text=Hallo%20<?php echo urlencode($produk['penjual']); ?>%2C%20saya%20tertarik%20dengan%20produk%20<?php echo urlencode($produk['nama_produk']); ?>%20yang%20Anda%20jual%20di%20CanteenGo."
          class="mt-28 inline-block rounded bg-[#D23D2D] px-8 mb-8 py-3 text-sm font-medium text-white transition hover:bg-[#31603D]">
          Hubungi Penjual
        </a>
      </div>
    </div>
  </div>
</section>
<script>
    function goBack() {
      window.history.back();
    }
</script>
</body>
</html>
