<?php

include 'conect.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
  header("Location: homePage.php");
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  // Pengecekan apakah email dan password sesuai dengan akun admin
  if ($email == 'admin@gmail.com' && $_POST['password'] == 'admin1234') {
    $_SESSION['username'] = 'admin';
    header("Location: admin.php");
    exit();
  }

  // Query untuk memeriksa pengguna selain admin
  $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    header("Location: homePage.php");
  } else {
    echo "<script>alert('Yahhh, Kamu Salah Masukin Email/Password:( Coba Lagi Yaaaa!')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <style>
    body {
      background-color: #F5C065;
      overflow: hidden;
    }

    #image {
      justify-content: center;
      align-items: center;
    }

    #getstarted {
      color: #31603D;
    }

    #caption {
      color: #31603D;
    }

    #inputEmail,
    #inputPassword {
      background-color: #F8EECB;
      border: 2px solid #31603D;
      outline: none;
      color: #D23D2D;
    }

    #inputEmail::placeholder,
    #inputPassword::placeholder {
      color: #31603D;
    }

    #btn-signin {
      background-color: #D23D2D;
      color: white;
    }

    #btn-signin:hover {
      background-color: #F8EECB;
      color: #D23D2D;
    }

    #url-signin {
      color: #31603D;
    }

    #url-signup:hover {
      color: #D23D2D;
    }

    /* Responsive behavior */
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
      background-color: #F8EECB;
      color: #D23D2D;
    }

    #btn-back {
      background-color: #D23D2D;
      color: white;
    }
  </style>

<!-- <div id="alert" role="alert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div id="alert-box" class="rounded-xl border border-gray-100 bg-white p-6 w-80 shadow-lg text-center">
    <div class="flex items-start gap-4 justify-center">
      <span id="alert-icon" class="text-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </span>
      <div class="flex-1">
        <strong id="alert-title" class="block font-medium text-gray-900">Login berhasil!</strong>
        <p id="alert-message" class="mt-1 text-sm text-gray-700">Anda berhasil login ke akun CanteenGo.</p>
      </div>
    </div> -->

    <!-- Loading Animation -->
    <!-- <div class="mt-4 flex justify-center gap-2" id="loading-animation">
      <span class="loading loading-ball loading-xs"></span>
      <span class="loading loading-ball loading-sm"></span>
      <span class="loading loading-ball loading-md"></span>
      <span class="loading loading-ball loading-lg"></span>
    </div>
  </div>
</div> -->


  <section class="relative flex flex-wrap lg:h-screen lg:items-center">
    <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
      Back
    </button>

    <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
      <div class="mx-auto max-w-lg text-center">
        <img id="image" src="image/cgso.png" class="h-28 w-28 mx-52" />
        <h1 class="text-2xl font-bold sm:text-3xl" id="getstarted">Sign in CanteenGo!</h1>
        <p class="mt-4" id="caption">
          Selamat datang di CanteenGo! Login sekarang untuk nikmati pengalaman kantin online yang lebih praktis dan mudah.
        </p>
      </div>

      <form class="mx-auto mb-0 mt-8 max-w-md space-y-4" method="POST">
    <div>
        <label for="email" class="sr-only">Email</label>
        <div class="relative">
            <input type="email" id="inputEmail" name="email" class="w-full rounded-lg p-4 pe-10" placeholder="Masukan Email" required value= "<?php echo $email?>"/>
        </div>
    </div>

    <div>
        <label for="password" class="sr-only">Password</label>
        <div class="relative">
            <input type="password" id="inputPassword" name="password" value="<?php echo $_POST['password']?>" class="w-full rounded-lg p-4 pe-10" placeholder="Masukan Password" required />
        </div>
    </div>
    
    <div class="flex items-center justify-between">
        <p class="text-sm" id="url-signin">
            Belum Punya Akun? <a class="underline" href="signUp.php" id="url-signup">Sign Up</a>
        </p>
        <button name="submit" type="submit" id="btn-signin" class="inline-block rounded-lg px-5 py-3 text-sm font-medium">
            Sign in
        </button>
    </div>
    <div class="flex items-center justify-between">
        <p class="text-sm" id="url-signin">
            Lupa Password? <a class="underline" href="forgotPassword.php" id="url-signup">Lupa Password</a>
        </p>
    </div>
</form>
    </div>

    <div class="relative h-64 w-full sm:h-96 lg:h-full lg:w-1/2">
      <img alt="" id="gambar" src="https://i.pinimg.com/originals/48/f9/b0/48f9b05200f0b6d1c82574060b277279.gif" class="absolute inset-0 h-full w-full object-cover pb-2" />
    </div>
  </section>
  <script>
    function goBack() {
      window.history.back();
    }
    function showAlert(success) {
    const alertBox = document.getElementById("alert-box");
    const alertIcon = document.getElementById("alert-icon");
    const alertTitle = document.getElementById("alert-title");
    const alertMessage = document.getElementById("alert-message");
    const loadingAnimation = document.getElementById("loading-animation");

    // Tampilkan alert
    document.getElementById("alert").classList.remove("hidden");

    if (success) {
      // Konfigurasi alert untuk berhasil
      alertBox.classList.remove("border-red-600");
      alertIcon.classList.remove("text-red-600");
      alertTitle.textContent = "Login berhasil!";
      alertMessage.textContent = "Anda berhasil login ke akun CanteenGo.";
      alertIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>`;
      
      // Sembunyikan loading animasi setelah 2 detik dan arahkan ke halaman beranda
      setTimeout(function() {
        window.location.href = "homePage.php";
      }, 2000);

    } else {
      // Konfigurasi alert untuk gagal
      alertBox.classList.add("border-red-600");
      alertIcon.classList.add("text-red-600");
      alertTitle.textContent = "Login gagal!";
      alertMessage.textContent = "Email atau password yang Anda masukkan salah. Coba lagi.";
      alertIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m-6-3h12M5.25 7.5h13.5M5.25 16.5h13.5" />
      </svg>`;

      // Sembunyikan animasi loading untuk pesan gagal
      loadingAnimation.classList.add("hidden");

      // Sembunyikan alert setelah 2 detik
      setTimeout(function() {
        document.getElementById("alert").classList.add("hidden");
      }, 2000);
    }

    return false; // Mencegah form submit
  }
  </script>
</body>

</html>