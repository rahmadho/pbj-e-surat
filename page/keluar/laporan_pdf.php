<?php
  error_reporting(0);
$koneksi = new mysqli  ("localhost","root","","e_surat");
$content ='

<style type="text/css">

	.tabel{border-collapse: collapse;}
	.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 8px 5px;     }
</style>


';

    $tgl4 = date("d-m-Y");
    $content .= '

<page>
    <h3 style="text-align:center;">Laporan Pelanggan  </h3><br><h5>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tanggal, '.$tgl4.'</h5>



    <table border="1px" class="tabel" align="center">

    		<tr>
          <th>No</th>
          <th>Kode Pelanggan</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Telpon</th>

    		</tr>';



        		$no = 1;
              $sql = $koneksi->query("select * from tb_pelanggan");
        		while ($data=$sql->fetch_assoc()) {


    		$content .='

    		<tr>
    			<td>'.$no++.' </td>
    			<td> '.$data['id'].' </td>
          <td> '.$data['nama'].' </td>
    			<td> '.$data['alamat'].' </td>
    			<td> '.$data['telpon'].' </td>
    		</tr>

    		';

    		}




$content .='
    </table>


</page>';

    require_once('../../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>
