<?php

	$id = $_SESSION['id'];

	

    $sql2 = $koneksi->query("select * from tb_user where id='$id'");


	$data2=$sql2->fetch_assoc();

 ?>

 <style type="text/css" media="screen">
 	.style2 {
    color: black;
    font-weight: bold;
    margin-left:20px ;
    font-family: "comic sans ms", cursive;
}
 </style>

				 <div class="col-md-6 col-sm-6">
                    <div class="box box-success box-solid">
              <div class="box-header with-border">
                            Profile
                        </div>
                        <div class="panel-body">

                            	<table>
                            		<tr>
                                        

                            			<td rowspan="10"><img src="images/<?php echo $data2['foto']; ?>" width="150" height="175" style="border-radius: 50%; border: 2px solid gray;"> </td>

                                        

                                      
                            		</tr>

                            		 
                                    <tr>

                                        <td><span class="style2"> Username </span></td>
                                        <td><span class="style2"> :</span></td>
                                        <td><span class="style2"> <?php echo $data2['username']; ?></span></td>
                                    </tr>
                       

                            		<tr>
                            			<td><span class="style2"> Nama </span></td>
                            			<td><span class="style2"> :</span></td>
                            			<td><span class="style2"> <?php echo $data2['nama_user']; ?></span></td>
                            		</tr>
                                    
                                    <tr>

                                        <td><span class="style2"> Level </span></td>
                                        <td><span class="style2"> :</span></td>
                                        <td><span class="style2"> <?php echo $data2['level']; ?></span></td>
                                    </tr>
                                     
                            	</table>

                        </div>
                        <div class="panel-footer">

                           <a href="?page=profile&aksi=ubahpass&id=<?php echo $id; ?>" class="btn btn-success" >Ubah Password</a>

										 


                           <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                        </div>
                    </div>
                </div>
