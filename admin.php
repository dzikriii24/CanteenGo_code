<?php

include 'conect.php';

session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}

// Ambil data pengguna, penjualan, dan promosi per bulan dan tahun
$pengguna_data = $conn->query("SELECT bulan, tahun, jumlah_pengguna FROM statistik_pengguna ORDER BY tahun, bulan");
$penjualan_data = $conn->query("SELECT bulan, tahun, jumlah_penjualan FROM statistik_penjualan ORDER BY tahun, bulan");
$promosi_data = $conn->query("SELECT bulan, tahun, jumlah_promosi FROM statistik_promosi ORDER BY tahun, bulan");

// Format data untuk Chart.js
$bulan_array = [];
$pengguna_array = [];
$penjualan_array = [];
$promosi_array = [];

while ($row = $pengguna_data->fetch_assoc()) {
  $bulan_array[] = $row['bulan'] . "-" . $row['tahun'];
  $pengguna_array[] = $row['jumlah_pengguna'];
}

while ($row = $penjualan_data->fetch_assoc()) {
  $penjualan_array[] = $row['jumlah_penjualan'];
}

while ($row = $promosi_data->fetch_assoc()) {
  $promosi_array[] = $row['jumlah_promosi'];
}

// Fungsi untuk memperbarui statistik pengguna
function updateStatistikPengguna($conn) {
  $sql = "
      INSERT INTO statistik_pengguna (bulan, tahun, jumlah_pengguna)
      SELECT MONTH(tanggal_daftar) AS bulan, YEAR(tanggal_daftar) AS tahun, COUNT(*) AS jumlah_pengguna
      FROM user
      GROUP BY YEAR(tanggal_daftar), MONTH(tanggal_daftar)
      ON DUPLICATE KEY UPDATE jumlah_pengguna = VALUES(jumlah_pengguna);
  ";

  if (!$conn->query($sql)) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fungsi untuk memperbarui statistik promosi
function updateStatistikPromosi($conn) {
  $sql = "
      INSERT INTO statistik_promosi (bulan, tahun, jumlah_promosi)
      SELECT MONTH(tanggal_mulai) AS bulan, YEAR(tanggal_mulai) AS tahun, COUNT(*) AS jumlah_promosi
      FROM promosi
      GROUP BY YEAR(tanggal_mulai), MONTH(tanggal_mulai)
      ON DUPLICATE KEY UPDATE jumlah_promosi = VALUES(jumlah_promosi);
  ";

  if (!$conn->query($sql)) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fungsi untuk memperbarui statistik penjualan
function updateStatistikPenjualan($conn) {
  $sql = "
      INSERT INTO statistik_penjualan (bulan, tahun, jumlah_penjualan)
      SELECT MONTH(tanggal_diupload) AS bulan, YEAR(tanggal_diupload) AS tahun, COUNT(*) AS jumlah_penjualan
      FROM produk
      WHERE statuss = 'aktif'
      GROUP BY YEAR(tanggal_diupload), MONTH(tanggal_diupload)
      ON DUPLICATE KEY UPDATE jumlah_penjualan = VALUES(jumlah_penjualan);
  ";

  if (!$conn->query($sql)) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Panggil fungsi untuk memperbarui statistik
updateStatistikPengguna($conn);
updateStatistikPenjualan($conn);
updateStatistikPromosi($conn);

?>

<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5F7F8]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

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
            <a href="adminUser.php" class="block rounded-lg px-4 py-2 text-sm font-medium text-[#F5F7F8] hover:text-[#F4CE14]">Cek User</a>
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

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
      <div class="mx-auto max-w-lg text-center">
        <h2 class="text-3xl text-[#45474B] mt-3 -mb-5 font-bold sm:text-4xl">Dashboard</h2>
        <h3 class="text-2xl text-[#495E57] mt-3 -mb-5 font-bold sm:text-2xl">Grafik Jumlah Pengguna, Penjualan & Promosi</h3>
      </div>
      <br><br>
      <canvas id="chart"></canvas>

      <script>
        const labels = <?php echo json_encode($bulan_array); ?>;
        const penggunaData = <?php echo json_encode($pengguna_array); ?>;
        const penjualanData = <?php echo json_encode($penjualan_array); ?>;
        const promosiData = <?php echo json_encode($promosi_array); ?>;

        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [
              {
                label: 'Pengguna',
                data: penggunaData,
                borderColor: 'rgba(94, 179, 68, 1)',
                backgroundColor: 'rgba(94, 179, 68, 0.2)',
                fill: true,
              },
              {
                label: 'Penjualan',
                data: penjualanData,
                borderColor: 'rgba(210, 61, 45, 1)',
                backgroundColor: 'rgba(210, 61, 45, 0.2)',
                fill: true,
              },
              {
                label: 'Promosi',
                data: promosiData,
                borderColor: 'rgba(0, 0, 255, 1)',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
                fill: true,
              },
            ]
          },
          options: {
            responsive: true,
            scales: {
              x: {
                title: { display: true, text: 'Bulan-Tahun' }
              },
              y: {
                title: { display: true, text: 'Jumlah' }
              }
            }
          }
        });
      </script>
    </div>
  </div>
</body>

</html>
