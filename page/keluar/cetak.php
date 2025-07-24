<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../../koneksi/koneksi.php";
$content ='
<style type="text/css">
  
  .tabel{border-collapse: collapse;}
  .tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
  .tabel td{padding: 8px 5px;     }
</style>
';
   if (isset($_POST['cetak'])) {
  
        $tgl1 = $_POST['tgl1'];
        $tgl2 = $_POST['tgl2'];
      }
    $content .= '
<page>
    <div style="text-align:center; font-size: 18px;">Laporan Surat Masuk</div>
    
   <div style="text-align:center;">Dari Tanggal '.date('d-m-Y', strtotime($tgl1)).' Sampai Tanggal  '.date('d-m-Y', strtotime($tgl2)).'</div>
    <br>
    <table border="1px" class="tabel" align="center">
      
        <tr>
          
          <th>No</th>
          <th>Kode Surat</th>
          <th>No Surat</th>
          <th>No Agenda</th>
          <th>Tanggal Surat </th>
          <th>Tujuan Surat</th>
          <th>Sifat Surat</th>
          <th>Perihal</th>
          
        </tr>';
        
          $tgl4 = date("d-m-Y");
          
          if (isset($_POST['cetak'])) {
  
        $tgl1 = $_POST['tgl1'];
        $tgl2 = $_POST['tgl2'];
        $no = 1;
        $sql = $koneksi->query("select * from tb_surat_keluar
                        left join ref_klasifikasi on tb_surat_keluar.kode_surat=ref_klasifikasi.id 
                        left join tb_asal_tujuan on
                        tb_surat_keluar.kepada=tb_asal_tujuan.id_asal_tujuan where tgl_surat between '$tgl1' and '$tgl2' ");
        while ($data=$sql->fetch_assoc()) {
            
          $content .='
          <tr>
              <td>'.$no++.' </td>
              
              <td> '.$data['kode'].' </td>
              <td> '.$data['no_surat'].' </td>
              <td> '.$data['no_agenda'].' </td>
              <td> '.date('d F Y', strtotime( $data['tgl_surat'])).' </td>
              <td width="200"> '.$data['asal_tujuan'].' </td>
              <td> '.$data['sifat_surat'].' </td>
              <td width="250"> '.$data['perihal'].' </td>
              
              
              
            </tr>
            ';
            
        }
            
        }else{  
          
        
            $no = 1;
            $sql = $koneksi->query("select * from tb_surat_keluar");
            while ($data=$sql->fetch_assoc()) {
             
        $content .='
        <tr>
          <td>'.$no++.' </td>
              <td> '.date('d F Y', strtotime( $data['tgl_surat'])).' </td>
              <td> '.$data['no_surat'].' </td>
              <td> '.$data['kepada'].' </td>
              <td> '.$data['sifat_surat'].' </td>
              <td> '.$data['perihal'].' </td>
              
        </tr>
        ';  
        
        }
        }
        
        
$content .='  
    </table>
    
</page>';
    require_once('../../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>