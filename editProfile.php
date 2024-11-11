<?php
include 'conect.php';
require 'conect.php';
session_start();


if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}


if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  
  // Query untuk mendapatkan userins
  $sql = "SELECT username, email, nomerwa, domisili, userins, fotoprofile FROM user WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $userins = $row['userins'];
      $foto_profile = $row['fotoprofile'];
      $usernames = $row['username'];
      $email = $row['email'];
      $domisili = $row ['domisili'];
      $nomerwa = $row['nomerwa'];
  } else {
      $userins = "Username Instagram tidak ditemukan.";
      $foto_profile = "image/default.jpg";
      $usernames = "Username Tidak Terdaftar";
      $nomerwa = "Nomer WhatsApp Tidak Terdaftar";
      $email = "EmailTidak Terdaftar";
      $domisili = "Domisili Tidak Terdaftar";
  }
} else {
  echo "Anda belum login.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
  $usernames = $_SESSION['username'];
  $newUsername = $_POST['username'];
  $email = $_POST['email'];
  $nomerwa = $_POST['nomerwa'];
  $domisili = $_POST['domisili'];
  $userins = $_POST['userins'];

  // Upload foto profile jika ada file yang diunggah
  if (isset($_FILES['fotoprofile']) && $_FILES['fotoprofile']['error'] === UPLOAD_ERR_OK) {
    $fotoProfileName = uniqid() . '_' . basename($_FILES['fotoprofile']['name']); // Nama unik
    $fotoProfilePath = "uploads/$fotoProfileName";
    move_uploaded_file($_FILES['fotoprofile']['tmp_name'], $fotoProfilePath);
} else {
    // Ambil foto profil lama dari database jika tidak ada unggahan baru
    $fotoQuery = "SELECT fotoprofile FROM user WHERE username = ?";
    $stmt = $conn->prepare($fotoQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $fotoProfilePath = $row['fotoprofile'];
}
  // Query update
  $updateQuery = "UPDATE user SET username=?, email=?, nomerwa=?, domisili=?, userins=?, fotoprofile=? WHERE username=?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("sssssss", $newUsername, $email, $nomerwa, $domisili, $userins, $fotoProfilePath, $usernames);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
      $_SESSION['username'] = $newUsername;

      $updateProdukQuery = "UPDATE produk SET username_penjual=? WHERE username_penjual=?";
      $stmtProduk = $conn->prepare($updateProdukQuery);
      $stmtProduk->bind_param("ss", $newUsername, $usernames);
      $stmtProduk->execute();

      echo "<script>alert('Profile berhasil diperbarui!'); window.location.href='profileUser.php';</script>";
  } else {
      echo "<script>alert('Tidak ada perubahan.'); window.location.href='homePage.php';</script>";
  }
}


$usernamess = $_SESSION['username'];

// Query untuk mendapatkan userins dan foto_profile
$sqlie = "SELECT userins, fotoprofile FROM user WHERE username = ?";
$stmtt = $conn->prepare($sqlie);
if ($stmtt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmtt->bind_param("s", $usernamess);
$stmtt->execute();
$result = $stmtt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $foto_profile = $row['fotoprofile'] ? $row['fotoprofile'] : "image/default.jpg"; // Menggunakan default jika tidak ada foto
} else {
    $userins = "Username Instagram tidak ditemukan.";
    $foto_profile = "image/default.jpg";
}

$stmtt->close();

?>

<!DOCTYPE html>
<html lang="en" class="bg-[#F5F7F8]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Edit Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="script.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
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
  <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
    Back
  </button>
  <div class="mx-auto max-w-lg text-center mb-10 mt-10">
    <h2 class="text-3xl text-[#45474B] font-bold sm:text-3xl">Edit Profil Anda</h2>
  </div>
  <form id="edit-form" method="POST" action="editProfile.php" enctype="multipart/form-data">
  <div class="bg-[#F5F7F8] flow-root rounded-lg border border-white py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <!-- Username Field -->
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-[#495E57]">Username</dt>
        <dd class="sm:col-span-2">
          <span id="username-display" class="text-[#495E57]"><?php echo htmlspecialchars($usernames); ?></span>
          <input type="text" name="username" id="username-input" class="hidden text-[#F5F7F8] sm:col-span-2 border bg-[#495E57] border-none outline-none w-50 py-2 rounded-lg" value="<?php echo htmlspecialchars($usernames); ?>" />
          <div class="flex justify-end">
            <button type="button" id="username-edit" onclick="toggleEditt('username')" class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#F4CE14]">Edit</button>
          </div>
        </dd>
      </div>

      <!-- Foto Profile Field -->
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-[#495E57]">Foto Profile</dt>
        <dd class="sm:col-span-2">
          <div id="profile-display">
          <img src="<?php echo htmlspecialchars($foto_profile); ?>" alt="Foto Profil" class="w-24 rounded-3xl" />
          </div>
          <input type="file" name="fotoprofile" id="profile-input" class="hidden text-[#F5F7F8] sm:col-span-2 border bg-[#495E57] border-none outline-none w-50  py-2 rounded-lg" accept="image/*" />
          <div class="flex justify-end">
            <button type="button" id="profile-edit" onclick="toggleEditt('profile')" class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#F4CE14]">Edit</button>
          </div>
        </dd>
      </div>

      <!-- Email Field -->
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-[#495E57]">Email</dt>
        <dd class="sm:col-span-2">
          <span id="email-display" class="text-[#495E57]"><?php echo htmlspecialchars($email); ?></span>
          <input type="text" name="email" id="email-input" class="hidden text-[#F5F7F8] sm:col-span-2 border bg-[#495E57] border-none outline-none w-50  py-2 rounded-lg" value="<?php echo htmlspecialchars($email); ?>" />
          <div class="flex justify-end">
            <button type="button" id="email-edit" onclick="toggleEditt('email')" class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#F4CE14]">Edit</button>
          </div>
        </dd>
      </div>

      <!-- Nomer WhatsApp Field -->
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-[#495E57]">Nomer WhatsApp</dt>
        <dd class="sm:col-span-2">
          <span id="phone-display" class="text-[#495E57]"><?php echo htmlspecialchars($nomerwa); ?></span>
          <input type="text" name="nomerwa" id="phone-input" class="hidden text-[#F5F7F8] sm:col-span-2 border bg-[#495E57] border-none outline-none w-50 py-2 rounded-lg" value="<?php echo htmlspecialchars($nomerwa); ?>" />
          <div class="flex justify-end">
            <button type="button" id="phone-edit" onclick="toggleEditt('phone')" class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#F4CE14]">Edit</button>
          </div>
        </dd>
      </div>

      <!-- Domisili Field -->
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-[#495E57]">Domisili</dt>
        <dd class="sm:col-span-2">
          <span id="domisili-display" class="text-[#495E57]"><?php echo htmlspecialchars($domisili); ?></span>
          <input type="text" name="domisili" id="domisili-input" class="hidden text-[#F5F7F8] sm:col-span-2 border bg-[#495E57] border-none outline-none w-50 py-2 rounded-lg" value="<?php echo htmlspecialchars($domisili); ?>" />
          <div class="flex justify-end">
            <button type="button" id="domisili-edit" onclick="toggleEditt('domisili')" class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#F4CE14]">Edit</button>
          </div>
        </dd>
      </div>

      <!-- Username Instagram Field -->
      <div class="grid grid-cols-1 gap-1 p-3 bg-[#F5F7F8] sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-[#495E57]">Username Instagram</dt>
        <dd class="sm:col-span-2">
          <span id="instagram-display" class="text-[#495E57]"><?php echo htmlspecialchars($userins); ?></span>
          <input type="text" name="userins" id="instagram-input" class="hidden text-[#F5F7F8] sm:col-span-2 border bg-[#495E57] border-none outline-none w-50 py-2 rounded-lg" value="<?php echo htmlspecialchars($userins); ?>" />
          <div class="flex justify-end">
            <button type="button" id="instagram-edit" onclick="toggleEditt('instagram')" class="inline-block rounded-lg px-5 py-2 text-sm font-medium bg-[#D23D2D] text-[#F5F7F8] transition hover:bg-[#F4CE14]">Edit</button>
          </div>
        </dd>
      </div>
    </dl>
  </div>
  
  <button type="submit" class="mt-10 mx-3 inline-block rounded bg-[#D23D2D] px-8 mb-8 py-3 text-sm font-medium text-[#F5F7F8] transition hover:bg-[#F4CE14] focus:outline-none focus:ring focus:ring-yellow-400">Simpan</button>
</form>
  
  <script>
     function toggleEditt(field) {
    document.getElementById(`${field}-display`).classList.toggle('hidden');
    document.getElementById(`${field}-input`).classList.toggle('hidden');
  }
    function toggleEdit(field) {
      const display = document.getElementById(`${field}-display`);
      const input = document.getElementById(`${field}-input`);
      const button = document.getElementById(`${field}-edit`);
      const image = document.getElementById('profile-image');

      if (field === 'profile') {
        // Handling file input for profile image
        if (input.classList.contains('hidden')) {
          input.classList.remove('hidden');
          button.innerHTML = 'Submit';
        } else {
          input.classList.add('hidden');
          button.innerHTML = 'Edit';
        }

        input.addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
              image.src = e.target.result;
              // Hide the input after submitting
              input.classList.add('hidden');
              button.innerHTML = 'Edit';
            };
            reader.readAsDataURL(file);
          }
        });

      } else {
        // Toggle text fields
        if (input.classList.contains('hidden')) {
          display.classList.add('hidden');
          input.classList.remove('hidden');
          button.innerHTML = 'Submit';
          button.classList.remove('bg-[#D23D2D]');
          button.classList.add('bg-[#31603D]');
        } else {
          display.classList.remove('hidden');
          input.classList.add('hidden');
          display.innerHTML = input.value;
          button.innerHTML = 'Edit';
          button.classList.remove('bg-[#31603D]');
          button.classList.add('bg-[#D23D2D]');
        }
      }
    }
  </script>

</body>

</html>
