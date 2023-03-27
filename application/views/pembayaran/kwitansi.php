<html>
   <head>
      <title>Faktur Pembayaran</title>
   </head>
   <body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">
      <center>
         <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
               <span style='font-size:12pt'><b> <?= $identitas->nama; ?></b></span></br><br>
               Alamat : <?= $identitas->alamat; ?> </br><br>
               Telp : <?= $identitas->no_hp; ?>
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
               <b><span style='font-size:12pt'>Kwitansi Pembayaran</span></b></br><br>
               Nama Santri : <?= $detail['namasantri']; ?></br><br>
               Wali Santri : <?= $detail['namawali']; ?></br><br>
               No Telp Wali : <?= $detail['no_hp']; ?></br>
            </td>
         </table>
         <br>
         <table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
            <tr align='center'>
               <td width='10%'>Bulan</td>
               <td width='20%'>Nominal</td>
               <td width='20%'>Tanggal Bayar</td>
               <td width='20%'>Status</td>
            </tr>
            <tr>
               <td align="center"><?= $detail['bulan']; ?></td>
               <td align="right" >Rp<?= number_format($detail['nominal']); ?></td>
               <td align="center"><?= $detail['tanggal_pembayaran']; ?></td>
               <td align="center">Dibayar</td>
            </tr>
         </table>
         <table style='width:100%; font-size:7pt;' cellspacing='1'>
            <tr>
               <td align='center'>Diterima Oleh,</br></br><br><u>(.............................)</u></td>
               <td align='center'>TTD,</br></br><br><u>(.............................)</u></td>
            </tr>
         </table>
      </center>
   </body>
</html>