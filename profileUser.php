<?php
include 'conect.php';
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}

$username = $_SESSION['username'];



$sql = "SELECT userins, fotoprofile,domisili FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
  die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userins = $row['userins'];
  $foto_profile = $row['fotoprofile'] ? $row['fotoprofile'] : "image/default.jpg";
} else {
  $userins = "Username Instagram tidak ditemukan.";
  $foto_profile = "image/default.jpg";
}

$stmt->close();
$sqlProduk = "SELECT id, nama_produk, deskripsi, harga, foto_produk FROM produk WHERE username_penjual = ?";
$stmtProduk = $conn->prepare($sqlProduk);
$stmtProduk->bind_param("s", $username);
$stmtProduk->execute();
$resultProduk = $stmtProduk->get_result();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
  $id_produk = $_POST['id'];

  $sql = "DELETE FROM produk WHERE id = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
    echo "Error preparing statement: " . $conn->error;
    exit();
  }
  $stmt->bind_param("i", $id_produk);
  if ($stmt->execute()) {
    echo "Produk berhasil dihapus.";
  } else {
    echo "Gagal menghapus produk: " . $stmt->error;
  }
  $stmt->close();
  exit();
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-[#F5F7F8]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Profile Anda</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
   #btn-back:hover {
      background-color: #F5F7F8;
      color: #D23D2D; 
    }

    #btn-back {
      background-color: #D23D2D;
      color: #F4CE14;
    }
</style>

<body class="bg-[#F5F7F8]">

  <div class="bg-[#F4CE14]">
    <div class="avatar place-content-center flex justify-center pt-4 mb-2">
      <div class="w-24 rounded-full cursor-pointer" id="profilePic">
        <img src="<?php echo htmlspecialchars($foto_profile); ?>" alt="Foto Profil" class="w-24 rounded-full cursor-pointer" />
      </div>
    </div>
    <div id="imageModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-75">
      <div class="relative">
        <!-- Close button -->
        <button class="absolute top-0 right-0 text-white text-2xl" onclick="closeModal()">×</button>
        <!-- Image in modal -->
        <img id="modalImage" class="rounded-lg max-w-full max-h-screen" src="" alt="Preview" />
      </div>
    </div>
    <div class="mx-auto max-w-lg text-center">
      <h2 class="text-2xl font-bold sm:text-2xl text-[#45474B]"><?php echo "<p id=dd> " . $_SESSION['username'] . "</p>"; ?></h2>
      <p class="mt-4 text-[#495E57] flex justify-center text-lg">
        <a
          href="https://instagram.com/<?php echo htmlspecialchars($userins); ?>"
          rel="noopener noreferrer"
          target="_blank"
          class="text-[#495E57] transition hover:text-gray-700/75 px-1 mt-1">
          <span class="sr-only">Instagram</span>
          <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" color="#495E57">
            <path
              fill-rule="evenodd"
              d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
              clip-rule="evenodd" />
          </svg>
        </a>
        <a href="https://instagram.com/<?php echo htmlspecialchars($userins); ?>"><?php echo htmlspecialchars($userins); ?></a>
      </p>
      <p class="mt-4 text-[#495E57] flex justify-center text-lg">
      <a
          href="https://www.google.co.id/maps/place/<?php echo $row['domisili']; ?>"
          rel="noreferrer"
          color="#495E57"
          target="_blank"
          class="text-[#495E57] transition hover:text-gray-700/75 px-1 mt-1"
        >
          <span class="sr-only">Domisili</span>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#495E57">
  <path d="M12 2C8.686 2 6 4.686 6 8C6 11.419 9.635 16.232 11.323 18.291C11.662 18.744 12.338 18.744 12.677 18.291C14.365 16.232 18 11.419 18 8C18 4.686 15.314 2 12 2ZM12 10.5C10.896 10.5 10 9.604 10 8.5C10 7.396 10.896 6.5 12 6.5C13.104 6.5 14 7.396 14 8.5C14 9.604 13.104 10.5 12 10.5Z" fill="#495E57"/>
</svg>
        </a>
        <a  href="https://www.google.co.id/maps/place/<?php echo $row['domisili']; ?>" text-[#495E57]><?php echo $row['domisili']; ?></a>
      </p>



    </div>
    <span class="flex items-center mt-4">
      <span class="h-px flex-1 bg-[#45474B]"></span>
      <span class="shrink-0 px-0"></span>
      <span class="h-px flex-1 bg-[#45474B]"></span>
    </span>
  </div>
  <br>
  <div class="mx-auto max-w-lg text-center">
    <h2 class="text-3xl font-bold sm:text-3xl text-[#45474B]">Penjualan Anda</h2>
  </div>

  <section class="">
    <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
      Back
    </button>
    <div class="container mx-auto text-center pt-6">
      <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <?php while ($rowProduk = $resultProduk->fetch_assoc()): ?>
          <div class="bg-[#F4CE14] block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-pink-500/10 hover:shadow-pink-500/10">
            <img src="<?php echo htmlspecialchars($rowProduk['foto_produk']); ?>" alt="Produk Image" class="w-full h-56 object-cover rounded-xl mb-4">
            <h2 class="mt-4 text-xl font-bold text-[#45474B]"><?php echo htmlspecialchars($rowProduk['nama_produk']); ?></h2>
            <p class="mt-1 text-sm text-[#495E57]"><?php echo htmlspecialchars($rowProduk['deskripsi']); ?></p>
            <h2 class="mt-4 text-l font-bold text-[#D23D2D]">Rp. <?php echo number_format($rowProduk['harga'], 0, ',', '.'); ?></h2>
            <br>
            <div class="flex justify-center">
            <a href="produkPage.php?id=<?php echo $rowProduk['id']; ?>">
              <button class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#495E57]">Beli</button>
            </a>
            </div>
            <br>
            <div class="flex justify-center">
            <a href="#"
              data-id="<?php echo $rowProduk['id']; ?>"
              onclick="return confirmDelete(this)"
              class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#495E57]">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 9h12m-1 0l-.867 12.142A2.25 2.25 0 0 1 13.884 22H10.116a2.25 2.25 0 0 1-2.25-2.008L7 9m5-4.5V6m0-1.5h3m-3 0h-3m4.5 4.5v10.5m-6 0V9m10.5 0V9m-6.75-2.5h5.25m-5.25 0H6.75m0 0h10.5" />
</svg>
            </a>
            </div>

          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
  <script>
    const profilePic = document.getElementById('profilePic');
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    // Open modal and display the clicked image
    profilePic.addEventListener('click', function() {
      const imageSrc = profilePic.querySelector('img').src;
      modalImage.src = imageSrc;
      imageModal.classList.remove('hidden');
    });

    // Close modal
    function closeModal() {
      imageModal.classList.add('hidden');
    }

    function goBack() {
      window.history.back();
    }

    function confirmDelete(element) {
      if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
        var id_produk = element.getAttribute('data-id');
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true); // Mengirim ke halaman yang sama
        // Ganti 'hapusProduk.php' dengan script PHP yang menangani penghapusan
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
          if (xhr.status === 200) {
            alert(xhr.responseText); // Menampilkan pesan dari server
            location.reload(); // Memuat ulang halaman setelah penghapusan
          } else {
            alert("Terjadi kesalahan saat menghapus produk.");
          }
        };
        xhr.send("id=" + id_produk); // Kirim ID produk untuk dihapus
      }
      return false; // Mencegah default link action
    }
  </script>

</body>

</html>