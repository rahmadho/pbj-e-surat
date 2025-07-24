<?php 
if (!function_exists('is_auth')){
    function is_auth(){
        return $_SESSION['auth'] ?? false;
    }
}

if (!function_exists('is_admin')) {
    function is_admin(){
        return auth()->level == 'admin';
    }
}

if (!function_exists('is_user')) {
    function is_user(){
        return auth()->level == 'user';
    }
}

if (!function_exists('is_level')) {
    function is_level($level){
        return auth()->level_pimpinan == $level;
    }
}

if (!function_exists('auth')) {
    function auth(){
        $user = json_decode(json_encode($_SESSION['auth']));
        return $user;
    }
}

if (!function_exists('profile')) {
    function profile(){
        $profile = $_SESSION['profile'];
        return $profile;
    }
}

if (!function_exists('is_post')) {
    function is_post(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}

if (!function_exists('is_get')) {
    function is_get(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
}

if (!function_exists('_post')) {
    function _post($key, $default = null){
        return $_POST[$key] ?? $default;
    }
}

if (!function_exists('_get')) {
    function _get($key, $default = null){
        return $_GET[$key] ?? $default;
    }
}

if (!function_exists('redirect')) {
    function redirect($url){
        echo "<script>window.location.href='$url';</script>";
        exit;
    }
}

if (!function_exists("swal")) {
    function swal($type = "success", $title = "Selamat!", $message = "", $url = null){
        $redirect = $url ? ", function() {window.location = \"$url\";}" : "";
        echo "<script>
        setTimeout(function() {
            swal({
                title: \"$title\",
                text: \"$message\",
                type: \"$type\"
            }$redirect);
        }, 300);
        </script>";
    }
}

if (!function_exists('log_history')) {
    function log_history($koneksi, $id_surat, $keterangan){
        $query_history = $koneksi->prepare("INSERT INTO tb_history_surat_masuk (id_surat_masuk, keterangan, id_user_aksi) VALUES (?, ?, ?)");
        $query_history->bind_param("isi", $id_surat, $keterangan, auth()->id);
        $query_history->execute();
        $query_history->close();
    }
}
?>