<?php

include 'conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $new_password = md5($_POST['new_password']); // Password baru dienkripsi dengan md5

  // Cek apakah email ada di database
  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    // Jika email ditemukan, update password
    $update_sql = "UPDATE user SET password='$new_password' WHERE email='$email'";
    if (mysqli_query($conn, $update_sql)) {
      echo "<script>alert('Password berhasil diubah! Silahkan login dengan password baru.'); window.location.href='login.php';</script>";
    } else {
      echo "<script>alert('Gagal mengubah password, silahkan coba lagi.'); window.location.href='forgotPassword.php';</script>";
    }
  } else {
    // Jika email tidak ditemukan
    echo "<script>alert('Email tidak ditemukan!'); window.location.href='forgot_password.php';</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opening</title>
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

  <section class="relative flex flex-wrap lg:h-screen lg:items-center">
    <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
      Back
    </button>

    <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
      <div class="mx-auto max-w-lg text-center">
        <img id="image" src="image/cgso.png" class="h-28 w-28 mx-52" />
        <h1 class="text-2xl font-bold sm:text-3xl" id="getstarted">Forgot Password?</h1>
        <p class="mt-4" id="caption">
          Silahkan masukan email untuk riset password
        </p>
      </div>

      <form action="forgotPassword.php" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
  <div>
    <label for="email" class="sr-only">Email</label>
    <div class="relative">
      <input type="email" name="email" id="inputEmail" class="w-full rounded-lg p-4 pe-10" placeholder="Masukan Email" required />
    </div>
  </div>

  <div>
    <label for="password" class="sr-only">Password Baru</label>
    <div class="relative">
      <input type="password" name="new_password" id="inputPassword" class="w-full rounded-lg p-4 pe-10" placeholder="Masukan Password Baru" required />
    </div>
  </div>

  <div class="flex items-center justify-between">
    <button type="submit" id="btn-signin" class="inline-block rounded-lg px-5 py-3 text-sm font-medium">
      Submit
    </button>
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
  </script>
</body>

</html>