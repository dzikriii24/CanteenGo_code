<?php
include "conect.php";

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
  header("location:login.php");
}
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $upassword = md5($_POST['upassword']);
  $domisili = $_POST['domisili'];
  $nomerwa = $_POST['nomerwa'];
  $userins = $_POST['userins'];

  if (isset($_FILES['fotoprofile'])) {
    $file_name = $_FILES['fotoprofile']['name'];
    $file_tmp = $_FILES['fotoprofile']['tmp_name'];
    $file_size = $_FILES['fotoprofile']['size'];
    $file_error = $_FILES['fotoprofile']['error'];

    // File validation
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_extensions)) {
        // Generate a unique file name to prevent overwriting
        $new_file_name = uniqid('', true) . '.' . $file_ext;
        $upload_dir = 'uploads/';  // Folder where you want to save the file

        // Move file to the server folder
        if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
            $foto_profile = $upload_dir . $new_file_name;
        } else {
            echo "<script>alert('Gagal mengupload foto profile.');</script>";
        }
    } else {
        echo "<script>alert('Hanya file jpg, jpeg, dan png yang diperbolehkan.');</script>";
    }
}


  if ($password == $upassword) {
    $sql = "SELECT * FROM user WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO user (username, email, password, domisili, nomerwa, userins, fotoprofile)
            VALUES ('$username', '$email', '$password', '$domisili', '$nomerwa', '$userins', '$foto_profile')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo "<script>
                alert ('Pendaftaran Berhasil, Silahkan Login')
                </script>";
        $username = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['upassword'] = "";
      } else {
        echo "<script>
                alert ('Password atau Email Salah')
                </script>";
      }
    } else {
      echo "<script>alert ('Email Sudah digunakan Oleh Pengguna Lain')</script>";
    }
  } else {
    echo "<script>alert ('Password Harus Sama')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en" class="bg-[#F5F7F8]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Sign Up CanteenGo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
  #formSignUp {
    color: #495E57;
    outline: none;
    border: none;
  }

  #formSignUp::placeholder {
    color: black;
  }

  #username::placeholder,
  #password::placeholder,
  #nomerWA::placeholder,
  #instagram::placeholder,
  #email::placeholder,
  #domisili::placeholder {
    outline: none;
    color: #495E57;
    ;

  }

  #username,
  #password,
  #upassword,
  #nomerWA,
  #instagram,
  #email,
  #domisili {
    color: #D23D2D;
    outline: none;
  }

  #btnSubmit:hover {
    background-color: #D23D2D;
      color: #F4CE14;
  }

  #btn-back:hover {
    background-color: #F4CE14;
    color: #D23D2D; 
  }

  #btn-back {
    background-color: #D23D2D;
      color: #F4CE14;
  }
   @media (max-width: 768px) {
      #gambar {
        display: none;
      }

      .mx-52 {
        margin-left: auto;
        margin-right: auto;
      }

      h1 {
        font-size: 1.5rem;
      }

      #inputEmail,
      #inputPassword {
        padding: 12px;
      }

      #btn-signin {
        width: 100%;
      }

      #caption {
        font-size: 0.875rem;
      }
    }

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
<section class="relative p-4">
  <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300">
    Back
  </button>

  <div class="container mx-auto max-w-screen-lg px-4 py-10">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
      
      <!-- Informasi dan Gambar -->
      <div class="lg:col-span-2 flex flex-col items-center text-center lg:py-12">
        <a href="#" class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#45474B]">Sign Up CanteenGo</a>
        <img id="image" src="image/newlogo.png" class="h-40 w-40 sm:h-48 sm:w-48 lg:h-52 lg:w-52 mt-4" />
        <p class="mt-4 text-[#495E57] text-sm sm:text-base">Bergabunglah dengan CanteenGo sekarang dan nikmati kemudahan berbelanja makanan tanpa antre! Daftar segera untuk pengalaman yang lebih praktis!</p>
      </div>
      
      <!-- Formulir Pendaftaran -->
      <div class="rounded-lg bg-[#495E57] p-6 sm:p-8 shadow-lg lg:col-span-3" id="formSignUp">
        <form class="space-y-4" method="post" enctype="multipart/form-data">
          
          <!-- Username -->
          <div>
            <label class="sr-only" for="username">Username</label>
            <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8] placeholder-[#495E57] outline-none" placeholder="Masukan Username" type="text" name="username" required id="username" />
          </div>
          
          <!-- Password dan Konfirmasi Password -->
          <div>
            <label class="sr-only" for="password">Password</label>
            <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8] placeholder-[#495E57] outline-none" placeholder="Masukan Password" type="password" name="password" required id="password" />
          </div>
          <div>
            <label class="sr-only" for="upassword">Ulangi Password</label>
            <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8] placeholder-[#495E57] outline-none" placeholder="Ulangi Password" type="password" name="upassword" required id="upassword" />
          </div>

          <!-- Foto Profil -->
          <div>
            <label class="sr-only" for="foto_profile">Foto Profile</label>
            <p class="text-white text-sm mb-2">Masukan Foto Profile</p>
            <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8] placeholder-[#495E57] outline-none" placeholder="Masukan Foto Profile" type="file" id="foto_profile" name="fotoprofile" required />
          </div>

          <!-- Email, WhatsApp, Instagram, Domisili -->
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label class="sr-only" for="email">Email</label>
              <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8]" placeholder="Masukan Email" type="email" name="email" required id="email" />
            </div>
            <div>
              <label class="sr-only" for="nomerWA">Nomer WhatsApp</label>
              <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8]" placeholder="Masukan Nomer WhatsApp" type="tel" name="nomerwa" required id="nomerWA" />
            </div>
            <div>
              <label class="sr-only" for="instagram">Username Instagram</label>
              <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8]" placeholder="Masukan Username Instagram" type="text" name="userins" required id="instagram" />
            </div>
            <div>
              <label class="sr-only" for="domisili">Domisili</label>
              <input class="w-full rounded-lg p-3 text-sm bg-[#F5F7F8]" placeholder="Masukan Domisili" type="text" name="domisili" required id="domisili" />
            </div>
          </div>

          <!-- Link ke Sign In dan Tombol Submit -->
          <div class="flex flex-col sm:flex-row sm:justify-between items-center mt-4 text-white text-sm">
            <p>Sudah Punya Akun? <a href="login.php" class="underline hover:text-[#F4CE14]">Sign In</a></p>
          </div>
          
          <div class="mt-4">
            <button type="submit" id="btnSubmit" name="submit" class="inline-block w-full rounded-lg bg-[#F4CE14] px-5 py-3 font-medium text-[#D23D2D] hover:bg-[#F8EECB]">
              Sign Up
            </button>
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
  </script>
</body>

</html>