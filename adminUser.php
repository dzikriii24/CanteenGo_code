<?php
// Koneksi database
include 'conect.php';

session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}
// Query untuk mengambil produk dengan status 'pending'
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5F7F8]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Cek Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="bg-[#F5F7F8]">
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
<body class="bg-[#F5F7F8] h-screen">
  <div class="flex h-full">
    <!-- Sidebar -->
    <div class="md:w-56 w-full md:block hidden flex-col justify-between border-e bg-[#495E57] flex-grow-0">
      <div>
        <div class="bg-[#F5F7F8] w-full p-4">
          <span class="grid h-10 w-32 place-content-center rounded-lg text-xs text-gray-600">
            <img alt="" src="image/newlogo.png" class="size-20 w-full object-cover" />
          </span>
        </div>

        <ul class="mt-6 space-y-1">
          <li>
            <a href="adminPenjualan.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-[#F5F7F8] hover:text-[#F4CE14]">Cek Penjualan</a>
          </li>
          <li>
            <a href="adminUser.php" class="text-[#F4CE14] block rounded-lg px-4 py-2 text-sm font-medium hover:text-[#F4CE14]">Cek Pengguna</a>
          </li>
          <li>
            <a href="adminPromosi.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-[#F5F7F8] hover:text-[#F4CE14]">Promosi Produk</a>
          </li>
          <li>
            <a href="cekPromosi.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-[#F5F7F8] hover:text-[#F4CE14]">Cek Promosi Produk</a>
          </li>
          <li>
            <details class="group [&_summary::-webkit-details-marker]:hidden">
              <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-[#F5F7F8] hover:text-[#F4CE14]">
                <span class="text-sm font-medium"> Akun </span>
                <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </span>
              </summary>

              <ul class="mt-2 space-y-1 px-4">
                <li>
                  <form action="index.php" onclick="return confirmLogout();">
                    <button type="submit" class="w-full rounded-lg px-4 py-2 text-sm font-medium text-[#F5F7F8] hover:text-[#F4CE14]">Logout</button>
                  </form>
                </li>
              </ul>
            </details>
          </li>
        </ul>
      </div>

      <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 flex justify-betwen">
      <a href="admin.php" class="flex items-center gap-3 bg-[#F5F7F8] p-4">
          <img alt="" src="https://i.pinimg.com/736x/5c/20/53/5c205367a84b2c684f28c5f076954667.jpg" class="size-10 rounded-full object-cover" />
          <div>
            <p class="text-xs">
              <strong class="block font-medium text-[#45474B]">Atmin CanteenGo</strong>
              <span class="text-[#495E57]"> Admin123@gmail.com </span>
            </p>
          </div>
        </a>
      </div>
    </div>

    <!-- Main Content (Right Side) -->
    <div class="flex-1 p-6 overflow-auto">
      <a href="admin.php"><button id="btn-back" class="absolute top-4 left-60 px-4 py-2 rounded-md ">
      Dashboard
      </button></a>
        
      <div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#45474B] mt-10 -mb-5 font-bold sm:text-4xl">Check Pengguna</h2>
      </div>
      <br><br>
      <div class="rounded-xl putline-none">
      <div class="place-content-center items-center flex justify-center">
      <label class="input input-bordered flex items-center mt-4 w-50 text-[#D23D2D]">
        <input type="text" class="grow outline-none" placeholder="Cari Username" id="searchInput" onkeyup="searchUser()" />
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" color="#31603d" class="h-4 w-4 opacity-70">
          <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
        </svg>
      </label>
    </div>
    
      <!-- Content Table -->
      <div class="overflow-x-auto mt-10">
  <table class="table w-full border border-[#495E57]" id="userTable">
    <thead>
      <tr class="text-center bg-[#F4CE14]">
        <th class="text-[#45474B] border-b border-[#495E57]">Foto Profile</th>
        <th class="text-[#45474B] border-b border-[#495E57]">Nama Penjual</th>
        <th class="text-[#45474B] border-b border-[#495E57]">Instagram</th>
        <th class="text-[#45474B] border-b border-[#495E57]">Nomer WhatsApp</th>
        <th class="text-[#45474B] border-b border-[#495E57]">Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr class="text-center bg-white">
          <!-- Foto Profile -->
          <td class="border-b border-[#495E57]">
            <div class="flex items-center justify-center gap-3">
              <div class="avatar">
                <div class="rounded-lg h-16 w-16">
                  <img src="<?= $row['fotoprofile']; ?>" alt="Avatar">
                </div>
              </div>
            </div>
          </td>

          <!-- Nama Penjual -->
          <td class="text-[#495E57] border-b border-[#495E57]">
            <div class="font-bold"><?= $row['username']; ?></div>
            <div class="text-sm opacity-50"><?= $row['domisili']; ?></div>
          </td>

          <!-- Instagram -->
          <td class="text-[#495E57] border-b border-[#495E57]"><?= $row['userins']; ?></td>

          <!-- WhatsApp Number -->
          <td class="text-[#495E57] border-b border-[#495E57]"><?= $row['nomerwa']; ?></td>

          <!-- Detail (Lihat Profile dan Hapus Profile) -->
          <td class="border-b border-[#495E57]">
            <div class="mt-4 flex flex-wrap gap-4 text-center">
              <form method="post" action="deleteProfile.php" onclick="return hapusUser();">
                <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                <button type="submit" name="delete" class="block w-42 rounded px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700">Hapus Profile</button>
              </form>
              <a href="profilePenjual.php?username=<?= $row['username']; ?>" class="block w-42 rounded px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Lihat Profile</a>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

    </div>
  </div>

  <!-- Script for mobile menu toggle -->
  <script>
    document.getElementById('menu-button').addEventListener('click', function() {
      const sidebar = document.querySelector('.md\\:w-56');
      sidebar.classList.toggle('hidden');
    });

    function searchUser() {
    const input = document.getElementById("searchInput").value.toUpperCase();
    const rows = document.querySelectorAll(".user-row");

    rows.forEach(row => {
      const username = row.cells[1].innerText.toUpperCase();
      row.style.display = username.includes(input) ? "" : "none";
    });
  }
  function confirmLogout() {
    return confirm("Apakah Anda yakin ingin log out?");
}
function hapusUser() {
  return confirm("Apakah Anda yakin ingin menghapus profile ini?");
}

  </script>

</body>

</html>