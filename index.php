<?php

session_start();

session_destroy();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Oppening</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
  <script src="index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <style>
    #background {
      background-color: #F5C065;
    }

    #tagline {
      color: #D23D2D;
    }

    #login {
      background-color: #D23D2D;
      color: white;

    }

    #login:hover {
      background-color: #F8EECB;
      color: #D23D2D;
    }

    #signup {
      background-color: #31603D;
      color: white;
    }

    #signup:hover {
      background-color: #F8EECB;
      color: #D23D2D;
    }

    @media (max-width: 768px) {
      #logo {
        width: 210px;
        height: 210px;
        margin-left: 120px;
      }
    }
  </style>
  <section
    id="background">


    <div
      class="place-content-center relative mx-auto max-w-screen-xl px-4 py-20 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
      <div class="max-w-xl text-center ltr:sm:text-left rtl:sm:text-right">
        <h1 class="text-xl font-extrabold  sm:text-3xl" id="tagline">
          Your Canteen, Anytime

        </h1>

        <a href="" class="block">
          <img
            alt=""
            id="logo"
            src="image/cgso.png"
            class="h-60 w-full object-cover sm:h-80 lg:h-96" />

        </a>
        <br>
        <div class="mt-8 flex flex-wrap gap-4 text-center px-10 ">
          <a
            href="login.php"
            id="login"
            class="block w-full rounded  px-12 py-3 text-sm font-medium shadow hover:bg-rose-700 focus:outline-none focus:ring active:bg-rose-500 sm:w-auto">
            Login
          </a>

          <a
            href="signUp.php"
            id="signup"
            class="block w-full rounded px-12 py-3 text-sm font-medium shadow hover:text-rose-700 focus:outline-none focus:ring active:text-rose-500 sm:w-auto">
            Sign Up
          </a>
        </div>
      </div>
    </div>
  </section>
</body>

</html>