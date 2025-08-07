<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../../koneksi/koneksi.php";
include "../../include/constant.php";
include "../../include/helper.php";

$id = (int) _get('id');
$sql = $koneksi->query("SELECT t1.keterangan, t1.batas_waktu, 
    t2.nama_bagian as nama_bagian, 
    t3.no_surat, t3.tgl_surat, t3.tanggal_terima, t3.sifat_surat, t3.perihal, t3.indeks,
    t4.asal_tujuan as nama_asal_tujuan,
    t5.kode
    FROM tb_disposisi as t1
    JOIN m_dispos as t2 ON t2.id_dispos=t1.disposisi_ke 
    JOIN tb_surat_masuk as t3 ON t3.id=t1.id_surat_masuk
    JOIN tb_asal_tujuan as t4 ON t4.id_asal_tujuan=t3.asal_surat
    JOIN ref_klasifikasi as t5 ON t3.kode_surat=t5.id
    WHERE t1.id=$id
  ");
$tampil = $sql->fetch_object();

$sql = $koneksi->query("select * from tb_profile");
$profile = $sql->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Disposisi</title>
  <style type="text/css">
    .tabel {
      border-collapse: collapse;
    }

    .tabel th {
      padding: 8px 5px;
      background-color: #cccccc;
    }

    .tabel td {
      padding: 8px 5px;
    }

    img {
      width: 125px;
      height: 130px;
    }

    td {
      font-size: 13px;
    }

    th {
      font-size: 10px;
    }

    .style2 {
      color: black;
      font-weight: bold;
      margin-left: 20px;
    }
  </style>
  <script>
    window.print();
    window.onfocus = function () { window.close(); }
  </script>
</head>
<body>
  <table class="tabel" width="474" border="1">
    <tr>
      <td height="23" colspan="2" valign="top"><strong style="font-size: 18px;"><?php echo $profile->lembaga ?>
        </strong><br> <?php echo $profile->alamat ?></td>
    </tr>
    <tr>
      <td height="46" colspan="2">
        <div align="center"><strong style="font-size: 18px;">LEMBAR DISPOSISI</strong></div>
      </td>
    </tr>
    <tr>
      <td colspan="2">Indeks Berkas <span style="margin-left: 70px">:

        </span> <?php echo $tampil->indeks ?> <span style="margin-left: 150px">Kode : <?php echo $tampil->kode ?>

        </span></td>
    </tr>
    <tr>
      <td colspan="2">Tanggal/Nomor <span style="margin-left: 62px">:

        </span> <?php echo date('d F Y', strtotime($tampil->tgl_surat)) ?>/ <?php echo $tampil->no_surat ?></td>
    </tr>
    <tr>
      <td colspan="2">Asal Surat <span style="margin-left: 89px">:

        </span><?php echo $tampil->nama_asal_tujuan ?></td>
    </tr>
    <tr>
      <td colspan="2">Isi Ringkas <span style="margin-left: 85px">:

        </span><?php echo $tampil->perihal ?></td>
    </tr>
    <tr>
      <td colspan="2">Diterima Tanggal <span style="margin-left: 53px">:

        </span><?php echo date('d F Y', strtotime($tampil->tanggal_terima)) ?></td>
    </tr>
    <tr>
      <td colspan="2">Tanggal Penyelesaian : </td>
    </tr>
    <tr>
      <td width="216" height="161" valign="top">Isi Disposisi <br> <?php echo $tampil->keterangan ?>. Batas
        <?php echo tanggal_indo($tampil->batas_waktu) ?>, Sifat: <?php echo sifat_surat($tampil->sifat_surat) ?></td>
      <td width="242" valign="top">Diteruskan Kepada <br> <?php echo $tampil->nama_bagian ?></td>
    </tr>
  </table>
  </tbody>

</html>