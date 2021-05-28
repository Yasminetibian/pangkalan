<html>
<head>
    <title>Cetak</title></head>
<body>
    
<table width="600px" border="1" bgcolor="" cellspacing="2"cellpadding="2" align="center">
<tr>

     <td rowspan="5" align="center"><img src="<?php echo base_url()?>/file/barcode/<?php echo $key->file_barcode ?>" style="width:100px"></td>
     <td colspan="8"align="center">KARTU LPG</td></tr>

<tr><td>ID</td>
    <td>:</td>
     <td><?php echo $key->file_barcode ?></td>
     </tr>
<tr><td>No KK</td>
    <td>:</td>
    <td><?php echo $key->no_kk ?></td>
</tr>
<tr>
    <td>Nama Kepala</td>
    <td>:</td>
    <td><?php echo $key->nama_kepala ?></td>
</tr>   
<tr>
    <td>Desa</td>
    <td>:</td>
    <td><?php echo $key->desa ?></td>
</tr> 




</table>
</body>

</html>