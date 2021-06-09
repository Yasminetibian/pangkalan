<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
        .text_content{
            text-indent: 60px;
        }
    </style>

    <style>

        .line-title {
            border: 1;
            border-style: inset;
            border-top: 2px solid #000;
        }
    
    </style>

    <style>

        .line-title2 {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
            line-height: 1.5;
        }
    
    </style>

</head>
<body>
       <img src="assets/tl.png" style="position:absolute; width:100px; height:auto;">
            
      <table style="width: 100%;">
          <tr>
              <td align="center">
                  <span style="line-height:1.7; font-weight:bold; font-size:19px;">
                      PEMERINTAH KABUPATEN TANAH LAUT
                 </span>
                 <span style="font-weight:bold; font-size:25px;">
                     <br> KECAMATAN KINTAP
                </span>
                <span style=" font-size:16px;">
                    <br> Jl. A. Yani No. 07 Kintap Kode Pos 70883, Email : kintap.bersinergi@gmail.com
                </span>
              </td>
          </tr>
      </table>

    <hr class="line-title2">
    <hr class="line-title">
    <br>   
    

        <table border="1"width="100%" cellspacing="0" cellpadding="5" class="table table-bordered">
                  <tr>
                  <th>No</th>
                  <th>Nama pangkalan</th>
                  <th>Nama Pemilik</th>
                  <th>Username</th>
                  <th>Alamat pangkalan</th>
                  <th>Desa</th>
                  <th>No Telp Pangkalan</th>
                  <th>Penangung Jawab</th>
                </tr>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data as $key) :
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $key->nama_pangkalan ?></td>
                        <td><?php echo $key->nama_pemilik ?></td>
                        <td><?php echo $key->username ?></td>
                        <td><?php echo $key->alamat_pangkalan ?></td>
                        <td><?php echo $key->desa ?></td>
                        <td><?php echo $key->no_telp_pangkalan ?></td>
                        <td><?php echo $key->penangung_jawab ?></td>
            
                      </tr>
                    <?php endforeach; ?>
                  </tbody>     
        </table>

</body>
</html>