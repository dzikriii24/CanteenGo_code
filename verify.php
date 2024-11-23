<?php
include "conect.php";

if (isset($_POST['verify'])) {
    $email = $_GET['email'];
    $otp = $_POST['otp'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND otp_code = '$otp'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE user SET is_verified = 1, otp_code = NULL WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Email berhasil diverifikasi. Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan, silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Kode OTP salah atau email tidak ditemukan.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/icon.png" type="image/png">
  <title>Lupa Password</title>
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
      background-color: #F5F7F8;
      overflow: hidden;
    }

    #image {
      justify-content: center;
      align-items: center;
    }

    #inputEmail,
    #inputPassword {
      background-color: #F5F7F8;
      border: 2px solid #495E57;  
      outline: none;
      color: #D23D2D;
    }

    #inputEmail::placeholder,
    #inputPassword::placeholder {
      color: #495E57;
      opacity: 75%;
    }

    #btn-signin {
      background-color: #F4CE14;
      color: #D23D2D;
    }

    #btn-signin:hover {
      background-color: #D23D2D;
      color: #F4CE14;
    }

    #url-signin {
      color: #495E57;
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
      background-color: #F4CE14;
      color: #D23D2D; 
    }

    #btn-back {
      background-color: #D23D2D;
      color: #F4CE14;
    }
  </style>

  <section class="relative flex flex-wrap lg:h-screen lg:items-center">
    <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
      Back
    </button>

    <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
      <div class="mx-auto max-w-lg text-center">
        <img id="image" src="image/newlogo.png" class="h-28 w-28 mx-52" />
        <h1 class="text-2xl font-bold sm:text-3xl text-[#45474B]" id="getstarted">Masukan Kode OTP</h1>
        <p class="mt-4 text-[#495E57]" id="caption">
          Silahkan Masukan Kode OTP Untuk Menyelesaikan Pendaftaran
        </p>
      </div>

      <form method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
  <div>
    <label for="email" class="sr-only">Email</label>
    <div class="relative">
      <input type="text" name="otp" id="inputEmail" class="w-full rounded-lg p-4 pe-10" placeholder="Masukan Kode OTP" required />
    </div>
  </div>


  <div class="flex items-center justify-between">
    <button type="submit" id="btn-signin" name="verify" class="inline-block rounded-lg px-5 py-3 text-sm font-medium">
      Submit
    </button>   
  </div>
</form>

    </div>

    <div class="relative h-64 w-full sm:h-96 lg:h-full lg:w-1/2">
      <img alt="" id="gambar" src="image/wgc.png" />
    </div>
  </section>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>