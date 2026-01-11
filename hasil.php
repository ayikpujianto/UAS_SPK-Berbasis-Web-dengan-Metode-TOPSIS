<?php include 'proses.php'; include 'header.php'; ?>

<h3>Hasil Perangkingan</h3>

<table class="table table-bordered table-striped">
<tr><th>Alternatif</th><th>Nilai Preferensi</th></tr>
<?php
foreach($V as $id=>$val){
  $q=mysqli_query($conn,"SELECT nama FROM alternatif WHERE id=$id");
  $a=mysqli_fetch_assoc($q);
  echo "<tr><td>$a[nama]</td><td>".round($val,4)."</td></tr>";
}
?>
</table>

<?php include 'footer.php'; ?>
