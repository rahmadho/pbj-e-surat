<?php 
define("LEVEL_KABIRO", 1);
define("LEVEL_KABAG", 2);
define("LEVEL_KASUBAG", 3);

define("SIFAT_SURAT", [
    "b" => "Biasa",
    "p" => "Penting",
    "sp" => "Sangat Penting",
    "s" => "Segera",
]);

if (!function_exists('sifat_surat')) {
    function sifat_surat($key = null){
        if (!$key) return SIFAT_SURAT;
        return SIFAT_SURAT[$key] ?? "";
    }
}

?>