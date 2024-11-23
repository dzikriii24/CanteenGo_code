<?php
spl_autoload_register(function ($class) {
    // Nama namespace PHPMailer
    $prefix = 'PHPMailer\\PHPMailer\\';

    // Folder tempat file PHPMailer berada
    $base_dir = __DIR__ . '/PHPMailer/src/';

    // Jika class dimulai dengan namespace yang sesuai
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Ambil nama file class
    $relative_class = substr($class, $len);

    // Ganti namespace separator dengan directory separator
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Jika file ditemukan, masukkan
    if (file_exists($file)) {
        require $file;
    }
});
