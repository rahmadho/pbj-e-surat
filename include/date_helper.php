<?php

function tanggal_indo($tanggal, $tampil_hari = false)
{
    // Daftar nama hari dan bulan dalam Bahasa Indonesia
    $hari = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    );

    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    // Konversi string ke timestamp
    $timestamp = strtotime($tanggal);
    if (!$timestamp) return '-';

    // Ambil hari, tanggal, bulan, tahun
    $hari_index = date('w', $timestamp);
    $tgl = date('j', $timestamp);
    $bln = (int)date('n', $timestamp);
    $thn = date('Y', $timestamp);

    $format = "$tgl {$bulan[$bln]} $thn";

    if ($tampil_hari) {
        $format = "{$hari[$hari_index]}, " . $format;
    }

    return $format;
}
