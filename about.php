<?php
include 'conect.php';

session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}
?>


<!DOCTYPE html class="bg-[#F5F7F8]">
<html lang="en" data-theme="light" class="bg-white">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Tentang Aplikasi</title>
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
    background-color: #F4CE14;
    color: #D23D2D;
  }

  #btn-back {
    background-color: #D23D2D;
    color: #F4CE14;
  }
</style>

<body class="bg-[#F5F7F8]">
  <footer class="bg-[#F5F7F8] lg:grid lg:grid-cols-5">
    <div class="relative block h-32 lg:col-span-2 lg:h-full">
      <img
        src="image/gbli.png"
        alt=""
        class="absolute inset-0 h-full w-full object-cover" />
    </div>
    <div class="px-4 py-16 sm:px-6 lg:col-span-3 lg:px-8">
      <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
        <div>
          <p>
          <p class="block text-2xl font-medium text-[#45474B] hover:opacity-75 sm:text-3xl">Tentang Aplikasi</p>
          </p>

          <ul class="mt-8 space-y-1 text-sm text-[#495E57]">
            <li>CanteenGo adalah sebuah aplikasi yang dirancang untuk mempermudah pengguna dalam melakukan pemesanan makanan di kantin secara digital. Aplikasi ini menghubungkan pengguna dengan berbagai pilihan menu yang tersedia di kantin, sehingga mereka dapat melakukan pemesanan dengan cepat, praktis, dan efisien.</li>
          </ul>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <p class="font-medium text-[#45474B]">Layanan Aplikasi</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="homePage.php" class="text-[#495E57] transition hover:opacity-75"> Memesan Produk </a>
              </li>

              <li>
                <a href="jualProduk.php" class="text-[#495E57] transition hover:opacity-75"> Menjual Produk </a>
              </li>

              <li>
                <a href="promosi.php" class="text-[#495E57] transition hover:opacity-75"> Mempromosikan Produk </a>
              </li>
            </ul>
          </div>

          <div>
            <p class="font-medium text-[#45474B]">Terima Kasih Kepada</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="https://www.instagram.com/alfianazt/" class="text-[#495E57] transition hover:opacity-75"> Alfian </a>
              </li>

              <li>
                <a href="https://www.instagram.com/ariqooo/" class="text-[#495E57] transition hover:opacity-75"> Ariq </a>
              </li>

              <li>
                <a href="https://www.instagram.com/dffanzm/" class="text-[#495E57] transition hover:opacity-75"> Daffa </a>
              </li>
              <li>
                <a href="https://www.instagram.com/sweswoz/" class="text-[#495E57] transition hover:opacity-75"> Dzikri </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="mt-12 border-t border-gray-100 pt-12">
        <div class="sm:flex sm:items-center sm:justify-between">
          <ul class="flex flex-wrap gap-4 text-xs">
            <li>
              <p class="text-[#495E57] transition hover:opacity-75">Version 1.0</p>
            </li>
          </ul>

          <p class="mt-8 text-xs text-[#495E57] sm:mt-0">
            &copy; 2024. CanteenGo. All rights reserved.
          </p>

        </div>
        <br>
        <p class="mt-8 text-xs text-[#495E57] sm:mt-0">
          Universitas Islam Negeri Sunan Gunung Djati
        </p>
        <br><br><br><br><br><br>
        <button id="btn-back" onclick="goBack()" class="top-4 left-4 px-4 py-2 rounded-md ">
          Back
        </button>
      </div>
    </div>
  </footer>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>