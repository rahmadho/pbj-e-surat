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
    $content .= '
<page>
    <h2 style="text-align:center;">Laporan Disposisi</h2>
    <br>
    <table border="1px" class="tabel" align="center">
      
        <tr>
          
          <th>No</th>
          <th>No Surat</th>
          <th>Tanggal Surat</th>
          <th>Tanggal Terima</th>
          <th>Asal</th>
          <th>Sifat</th>
          <th>Perihal</th>
          <th>Nomor Agenda</th>
          <th>Diteruskan</th>   
          <th>Catatan</th> 
        </tr>';
        
          $tgl4 = date("d-m-Y");
          
          if (isset($_POST['cetak'])) {
  
        $tgl1 = $_POST['tgl1'];
        $tgl2 = $_POST['tgl2'];
        $no = 1;
        $sql = $koneksi->query("select * from tb_disposisi, m_dispos where tb_disposisi.teruskan=m_dispos.id_dispos and tb_disposisi.tgl_surat between '$tgl1' and '$tgl2' ");
        while ($data=$sql->fetch_assoc()) {
            if ($data['sifat_surat']==p) {
                  $sifat = "Penting";
              }
            if ($data['sifat_surat']==sp) {
                  $sifat = "Sangat Penting";
              }
              
            if ($data['sifat_surat']==b) {
                  $sifat = "Biasa";
              }
              
            if ($data['sifat_surat']==s) {
                  $sifat = "Segera";
              }   
          $content .='
          <tr>
              <td>'.$no++.' </td>
              <td> '.date('d F Y', strtotime( $data['tgl_surat'])).' </td>
              <td> '.date('d F Y', strtotime( $data['tgl_terima'])).' </td>
              <td> '.$data['no_surat'].' </td>
              <td> '.$data['asal_surat'].' </td>
              <td> '.$sifat.' </td>
              <td> '.$data['perihal'].' </td>
              <td> '.$data['nama_bagian'].' </td>
              <td> '.$data['no_agenda'].' </td>
              
              <td> '.$data['ket'].' </td>
              
              
            </tr>
            ';
            
        }
            
        }else{  
          
        
            $no = 1;
            $sql = $koneksi->query("select * from tb_disposisi, m_dispos where tb_disposisi.teruskan=m_dispos.id_dispos  ");
            while ($data=$sql->fetch_assoc()) {
             if ($data['sifat_surat']==p) {
                  $sifat = "Penting";
              }
            if ($data['sifat_surat']==sp) {
                  $sifat = "Sangat Penting";
              }
              
            if ($data['sifat_surat']==b) {
                  $sifat = "Biasa";
              }
              
            if ($data['sifat_surat']==s) {
                  $sifat = "Segera";
              }   
        $content .='
        <tr>
          <td>'.$no++.' </td>
              <td> '.date('d F Y', strtotime( $data['tgl_surat'])).' </td>
              <td> '.date('d F Y', strtotime( $data['tgl_terima'])).' </td>
              <td> '.$data['no_surat'].' </td>
              <td> '.$data['asal_surat'].' </td>
              <td> '.$sifat.' </td>
              <td> '.$data['perihal'].' </td>
              <td> '.$data['no_agenda'].' </td>
              <td> '.$data['nama_bagian'].' </td>
              
              <td> '.$data['ket'].' </td>
        </tr>
        ';  
        
        }
        }
        
        
$content .='  
    </table>
    
</page>';
    require_once('../../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A3','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>
