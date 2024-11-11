<?php 
include 'conect.php';

session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5F7F8]">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Promosi Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
        #btn-back:hover {
      background-color: #F4CE14;
      color: #D23D2D; 
    }

    #btn-back {
      background-color: #D23D2D;
      color: #F4CE14;
    }
    
    @media (max-width: 768px){
    #gambar{
        margin-left: 30px;
        margin-top: 10px;
    }
    #formulir{
        margin-top: 100px;
        padding-bottom: 50px;

    }
    #kirim{
        width: 200px;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
  }
</style>

<body class="bg-[#F5F7F8]">
<button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md">
      Back
</button>

<div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#45474B] mt-10 -mb-5 font-bold sm:text-4xl">Promosikan Produk Anda!</h2>
        <p class="mt-10 text-[#495E57]" id="caption">
          Silahkan Isi Formulir Dibawah Ini Jika Ingin Mempromosikan Produk
        </p>
</div>

<section class="bg-[#F5F7F8]">
  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5 bg-[#F4CE14] rounded-xl">
      <div class="lg:col-span-2 lg:py-12">
        <div class="relative h-64 w-full sm:h-96 lg:h-full">
          <img
            id="gambar"
            alt=""
            src="image/promo.png"
            class="absolute inset-0 h-96 w-96 object-cover mx-16 rounded-xl"
          />
        </div>
      </div>

      <div class="rounded-lg bg-[#495E57] p-8 shadow-lg lg:col-span-3 lg:p-12">
        <form id="formulir" class="space-y-4">
          <div>
            <label class="sr-only" for="namaProduk">Nama Produk</label>
            <input
              class="w-full rounded-lg bg-[#F5F7F8] p-3 text-sm outline-none text-[#D23D2D] placeholder:text-[#495E57]"
              placeholder="Nama Produk"
              type="text"
              id="namaProduk"
            />
          </div>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label class="sr-only" for="harga">Harga</label>
              <input
                class="w-full rounded-lg bg-[#F5F7F8] p-3 text-sm outline-none text-[#D23D2D] placeholder:text-[#495E57]"
                placeholder="Harga"
                type="number"
                id="harga"
              />
            </div>

            <div>
              <label class="sr-only" for="link_produk">Link Produk</label>
              <input
                class="w-full rounded-lg bg-[#F5F7F8] p-3 text-sm outline-none text-[#D23D2D] placeholder:text-[#495E57]"
                placeholder="Masukan Link Produk"
                type="text"
                id="link_produk"
              />
            </div>
            <div>
              <label class="sr-only" for="foto_produk">Link Foto</label>
              <input
                class="w-full rounded-lg bg-[#F5F7F8] p-3 text-sm outline-none text-[#D23D2D] placeholder:text-[#495E57]"
                placeholder="Masukan Link Foto (G-Drive)"
                type="text"
                id="foto_produk"
              />
              <p class="text-[#F5F7F8] text-sm mt-2">*Akses Link Foto Harus Diubah Menjadi Anyone with the link</p>
            </div>

            <div>
              <label class="sr-only" for="deskripsi">Caption (Opsional)</label>
              <textarea
                class="w-full rounded-lg border-gray-200 p-3 text-sm bg-[#F5F7F8] outline-none text-[#D23D2D] placeholder:text-[#495E57]"
                placeholder="Caption (Opsional)"
                rows="8"
                id="deskripsi"
              ></textarea>
            </div>

            <div>
              <button
                type="submit"
                id="submit"
                class="inline-block w-full rounded-lg bg-[#D23D2D] px-5 p-3 font-medium text-[#F5F7F8] sm:w-auto hover:bg-[#F4CE14]"
              >
                Kirim
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  function goBack() {
    window.history.back();
  }


  document.getElementById('formulir').addEventListener('submit', function(e) {
    e.preventDefault();

    const namaProduk = document.getElementById('namaProduk').value;
    const harga = document.getElementById('harga').value;
    const linkProduk = document.getElementById('link_produk').value;
    const linkFoto = document.getElementById('foto_produk').value;
    const deskripsi = document.getElementById('deskripsi').value;

    if (namaProduk && harga && linkProduk) {
      const message = `Hallo, saya ingin mempromosikan produk saya, untuk detail produk ada dibawah ini : \n\nNama Produk: ${namaProduk}\nHarga: Rp. ${harga}\nLink Produk: ${linkProduk}\nLink Foto: ${linkFoto}\nDeskripsi: ${deskripsi}`;

     
      const encodedMessage = encodeURIComponent(message);

     
      const whatsappUrl = `https://wa.me/6285156296580?text=${encodedMessage}`;

     
      window.location.href = whatsappUrl;
    } else {
      alert('Silakan isi semua data produk');
    }
  });
</script>

</body>
</html>
