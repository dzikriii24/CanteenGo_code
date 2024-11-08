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
      background-color: #F8EECB;
      color: #D23D2D;
    }

    #btn-back {
      background-color: #D23D2D;
      color: white;
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
<body class="bg-[#f5c065]">
<button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
      Back
    </button>
<div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#D23D2D] mt-10 -mb-5 font-bold sm:text-4xl">Promosi Produk Penjual</h2>
        <p class="mt-10 text-[#31603D]" id="caption">
          Silahkan Silahkan Isi Foto untuk Mempromosikan Produk
        </p>
      </div>
<section class="bg-[#F5C065]">
  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5 bg-[#F8EECB] rounded-xl">
      <div class="lg:col-span-2 lg:py-12">
      <div class="relative h-64 w-full sm:h-96 lg:h-full">
    <img
    id="gambar"
      alt=""
      src="https://i.pinimg.com/564x/79/07/cf/7907cf59304e7a9aca3fde929a829b59.jpg"
      class="absolute inset-0 h-96 w-96 object-cover mx-16 rounded-xl"
    />
  </div>
      </div>

      <div class="rounded-lg mb-20 bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
        <form action="#" class="space-y-4" id="formulir">
            <div class="bg-[#F8EECB] p-3 w-full rounded-lg  outline-none text-[#31603D]">
                <p>Masukan Foto Produk</p>
                <br><br>
            <input type="file" class="file-input w-full max-w-xs outline-none"aaccept=".jpg,.png" />
            </div>
    <br><br><br><br><br>
    <div class="flex justify-end">
            <button
              type="submit"
              id="kirim"
              class="inline-block w-full rounded-lg bg-[#D23D2D] px-5 p-3 font-medium text-white sm:w-auto position-absolute"
            >
              Kirim
            </button>
          </div>
          <br><br>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script src="script.js">
</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.querySelector('input[type="file"]');
    const imagePreview = document.querySelector('.relative img');

    fileInput.addEventListener('change', function (event) {
      const file = event.target.files[0];

      if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
        const reader = new FileReader();

        reader.onload = function (e) {
          imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
      } else {
        alert('Format gambar harus JPG atau PNG');
        fileInput.value = '';
      }
    });
  });
</script>

</body>

</html>