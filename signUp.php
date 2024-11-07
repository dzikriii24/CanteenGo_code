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
  $foto_profile = $_POST['fotoprofile'];

  if ($password == $upassword) {
    $sql = "SELECT * FROM user WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO user (username, email, password, domisili, nomerwa, userins, fotoprofile)
            VALUES ('$username', '$email', '$password', '$domisili', '$nomerwa', '$userins', '$foto_profile')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo "<script>
                alert ('Yeeeyy Kamu Berhasil Login >< Selamat Yaaa')
                </script>";
        $username = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['upassword'] = "";
      } else {
        echo "<script>
                alert ('Yahh, Ada Yang Salah Nihh:(')
                </script>";
      }
    } else {
      echo "<script>alert ('yahhh, email kamu udah dipake sama akun lainn')</script>";
    }
  } else {
    echo "<script>alert ('passwordnya harus sama yaaakk. hihihi')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en" class="bg-[#F5C065]">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    color: #D23D2D;
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
    color: #31603D;
    ;

  }

  #username,
  #password,
  #nomerWA,
  #instagram,
  #email,
  #domisili {
    color: #D23D2D;
    outline: none;
  }

  #btnSubmit:hover {
    color: #D23D2D;
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

<body class="bg-[#F5C065]">
  <section class="bg-[#F5C065]">
    <button id="btn-back" onclick="goBack()" class="absolute top-4 left-4 px-4 py-2 rounded-md ">
      Back
    </button>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
        <div class="lg:col-span-2 lg:py-12">
          <div class="">
            <a href="#" class="text-5xl font-bold text-[#D23D2D]"> Sign Up CanteenGo </a>
            <img id="image" src="image/cgso.png" class="h-52 w-52 mx-28" />
            <p class="mt-2 not-italic text-center text-[#D23D2D]">Bergabunglah dengan CanteenGo sekarang dan nikmati kemudahan berbelanja makanan tanpa antre! Daftar segera untuk pengalaman yang lebih praktis!</p>
          </div>
        </div>

        <div class="rounded-lg bg-[#31603D] p-8 shadow-lg lg:col-span-3 lg:p-12" id="formSignUp">
          <form class="space-y-4" id="formSignUp" method="post">
            <div>
              <label class="sr-only" for="name">Username</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm bg-[#F8EECB] placeholder-[#31603D] outline-none "
                placeholder="Masukan Username"
                type="text"
                name="username"
                required
                id="username" />
            </div>
            <div>
              <label class="sr-only" for="name">Password</label>
              <input
                name="password"
                required
                class="w-full rounded-lg p-3 text-sm bg-[#F8EECB] placeholder-[#31603D;] outline-none "
                placeholder="Masukan Password"
                type="password"
                id="password" />
            </div>

            <div>
              <label class="sr-only" for="name">Ulangi Password</label>
              <input
                name="upassword"
                required
                class="w-full rounded-lg p-3 text-sm bg-[#F8EECB] placeholder-[#31603D;] outline-none "
                placeholder="Ulangi Password"
                type="password"
                id="upassword" />
            </div>

            <div>
              <p class="text-white">Masukan Foto Profile</p>
              <label class="sr-only" for="name">Ulangi Password</label>
              <input
                name="fotoprofile"
                required
                class="w-full rounded-lg p-3 text-sm bg-[#F8EECB] placeholder-[#31603D;] outline-none "
                placeholder="Masukan Foto Profile"
                type="file"
                id="fotoprofile" />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <div>
                <label class="sr-only" for="email">Email</label>
                <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm bg-[#F8EECB]"
                  placeholder="Masukan Email"
                  type="email"
                  name="email"
                  value="<?php echo $_POST['email']?>"
                  required
                  id="email" />
              </div>

              <div>
                <label class="sr-only" for="phone">Nomer WhatsApp</label>
                <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm bg-[#F8EECB]"
                  placeholder="Masukan Nomer WhatsApp"
                  type="tel"
                  name="nomerwa"
                  value="<?php echo $_POST['nomerwa']?>"
                  required
                  id="nomerWA" />
              </div>

              <div>
                <label class="sr-only" for="phone">Username Instagram</label>
                <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm bg-[#F8EECB]"
                  placeholder="Masukan Username Instagram"
                  type="text"
                  name="userins"
                  value="<?php echo $_POST['userins']?>"
                  required
                  id="instagram" />
              </div>

              <div>
                <label class="sr-only" for="phone">Domisili</label>
                <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm bg-[#F8EECB]"
                  placeholder="Masukan Domisili"
                  type="text"
                  name="domisili"
                  value="<?php echo $_POST['domisili']?>"
                  required
                  id="domisili" />
              </div>
            </div>
            <div class="flex items-center justify-between text-white">
        <p class="text-sm" id="url-signin">
            Sudah Punya Akun? <a class="underline" href="login.php" id="url-signup">Sign In</a>
        </p>
    </div>

            <a href="login.php">
            <div class="mt-4">
              
              <button
                type="submit"
                id="btnSubmit"
                name="submit"
                class="inline-block w-full rounded-lg text-[#F8EECB] bg-[#D23D2D] px-5 py-3 font-medium sm:w-auto hover:bg-[#F8EECB]">
                Sign Up
              </button>
              
            </div>
            </a>
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