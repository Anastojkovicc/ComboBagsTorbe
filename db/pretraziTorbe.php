<?php
include '../init.php';

$torba = new Torba();
$torba->naziv = $_GET['naziv'];

$nizTorbi = $torba->vratiSve($mysqli);
 ?>

 <table class="table table-hover">
 <thead>
   <tr>
     <th>Naziv</th>
     <th>Opis</th>
   </tr>
 </thead>
 <tbody>

   <?php
     foreach ($nizTorbi as $torba) {
         ?>
       <tr>
         <td><?= $torba->naziv ?></td>
         <td><?= $torba->opis ?></td>
        </tr>
       <?php
     }

    ?>

 </tbody>
 </table>