<?php
function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception(".env file not found at: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Lewati komentar
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Pecah berdasarkan tanda '=' pertama
        list($name, $value) = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        // Hapus tanda kutip jika ada
        $value = trim($value, '"\'');

        // Set ke environment jika belum diset
        if (!array_key_exists($name, $_ENV)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}
