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
    $content .= '
<page>
    <h4 style="text-align:center;"> Laporan Transaksi</h4>
    <br>
    <table border="1px" class="tabel" align="center">

    		<tr>
        <th>No</th>
        <th>Tanggal Transaksi </th>
        <th>Jenis</th>
        <th>Catatan</th>
        <th>Kasir</th>
        <th>Masuk</th>
        <th>Keluar</th>
    		</tr>';



    			$tgl4 = date("d-m-Y");





				$no = 1;


        $no = 1;
        $sql = $koneksi->query("select * from tb_transaksi, tb_user
                                where  tb_transaksi.kode_user= tb_user.id");
        while ($data=$sql->fetch_assoc()) {
					$content .='
					<tr>
		    			<td>'.$no++.' </td>

		    			<td> '.date('d F Y', strtotime( $data['tanggal_transaksi'])).' </td>
              <td> '.$data['keterangan'].' </td>
		    			<td> '.$data['catatan'].' </td>
              <td>'.$data['nama_user'].'</td>
		    			<td align="right"> '.number_format( $data['nominal']).",-".' </td>
		    			<td align="right"> '.number_format( $data['keluar']).",-".' </td>
		    		</tr>
		    		';
		    		$total_masuk=$total_masuk+$data['nominal'];
                	$total_keluar=$total_keluar+$data['keluar'];
                	$total_saldo=$total_masuk-$total_keluar;

				}

    		$content .='

    			<tr>
                    <th style="text-align: right; font-size: 14px;" colspan="5">Total  Masuk</th>
                    <td  colspan="4" style="font-size: 14px;"><b>'.number_format($total_masuk).',-</b></td>
                </tr>

                <tr>
                    <th style="text-align: right; font-size: 14px;" colspan="5">Total  Keluar</th>
                    <td align="right" colspan="6" style="font-size: 14px;"><b>'.number_format($total_keluar).',-</b></td>
                </tr>

                <tr>
                    <th style="text-align: right; font-size: 14px;" colspan="5">Saldo Akhir</th>
                    <td  colspan="6" style="font-size: 14px;"><b> '.number_format($total_saldo).',-</b></td>
                </tr>

    		';


$content .='
    </table>


</page>';

    require_once('../../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>
