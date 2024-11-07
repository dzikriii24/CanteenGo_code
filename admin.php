<?php

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
  <title>Opening</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-[#F5C065] h-screen">
  <style>
    .simple-bar-chart {
      --line-count: 10;
      --line-color: currentcolor;
      --line-opacity: 0.25;
      --item-gap: 2%;
      --item-default-color: #060606;

      height: 10rem;
      display: grid;
      grid-auto-flow: column;
      gap: var(--item-gap);
      align-items: end;
      padding-inline: var(--item-gap);
      --padding-block: 1.5rem;
      padding-block: var(--padding-block);
      position: relative;
      isolation: isolate;
    }

    .simple-bar-chart::after {
      content: "";
      position: absolute;
      inset: var(--padding-block) 0;
      z-index: -1;
      --line-width: 1px;
      --line-spacing: calc(100% / var(--line-count));
      background-image: repeating-linear-gradient(to top, transparent 0 calc(var(--line-spacing) - var(--line-width)), var(--line-color) 0 var(--line-spacing));
      box-shadow: 0 var(--line-width) 0 var(--line-color);
      opacity: var(--line-opacity);
    }

    .simple-bar-chart > .item {
      height: calc(1% * var(--val));
      background-color: var(--clr, var(--item-default-color));
      position: relative;
      animation: item-height 1s ease forwards;
    }

    @keyframes item-height {
      from {
        height: 0;
      }
    }

    .simple-bar-chart > .item > * {
      position: absolute;
      text-align: center;
    }

    .simple-bar-chart > .item > .label {
      inset: 100% 0 auto 0;
    }

    .simple-bar-chart > .item > .value {
      inset: auto 0 100% 0;
    }
  </style>

  <div class="flex h-full">
    <!-- Sidebar -->
    <div class="md:w-56 w-full md:block hidden flex-col justify-between border-r bg-white flex-grow-0">
      <div>
        <div class="bg-[#F5C065] w-full p-4">
          <span class="grid h-10 w-20 place-content-center rounded-lg text-xs text-gray-600">
            <img alt="" src="image/cgso.png" class="object-cover" />
          </span>
        </div>

        <ul class="mt-6 space-y-1">
          <li>
            <a href="adminPenjualan.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-[#31603D] hover:text-white">Cek Penjualan</a>
          </li>
          <li>
            <a href="adminUser.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-[#31603D] hover:text-white">Cek User</a>
          </li>
          <li>
            <a href="adminPromosi.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-[#31603D] hover:text-white">Promosi Produk</a>
          </li>
          <li>
            <details class="group">
              <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                <span class="text-sm font-medium">Akun</span>
                <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </span>
              </summary>

              <ul class="mt-2 space-y-1 px-4">
                <li>
                  <button type="submit" class="w-full rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Edit Akun</button>
                  <button type="submit" class="w-full rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">Logout</button>
                </li>
              </ul>
            </details>
          </li>
        </ul>
      </div>

      <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 flex justify-between">
        <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
          <img alt="" src="https://i.pinimg.com/736x/5c/20/53/5c205367a84b2c684f28c5f076954667.jpg" class="w-10 h-10 rounded-full object-cover" />
          <div>
            <p class="text-xs">
              <strong class="block font-medium">Atmin CanteenGo</strong>
              <span> Admin123@gmail.com </span>
            </p>
          </div>
        </a>
      </div>
    </div>

    <!-- Main Content (Right Side) -->
    <div class="flex-1 p-6 overflow-auto">
      <div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#D23D2D] mt-10 -mb-5 font-bold sm:text-4xl">Dashboard Admin</h2>
      </div>
      <br><br>
      <!-- Content Table -->
      <h1>Chart Pengguna</h1>
      <div class="simple-bar-chart">
        <div class="item" style="--clr: #5EB344; --val: 80">
          <div class="label">Pengguna</div>
          <div class="value">80%</div>
        </div>
      </div>
<br><br>
      <h1>Chart Penjualan</h1>
      <div class="simple-bar-chart">
        <div class="item" style="--clr: #5EB344; --val: 80">
          <div class="label">Penjualan</div>
          <div class="value">80%</div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
