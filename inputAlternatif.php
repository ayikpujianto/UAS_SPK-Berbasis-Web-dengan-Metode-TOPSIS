<?php include 'config.php'; include 'header.php'; ?>

<h3>Input Alternatif</h3>

<form method="post" class="card card-body shadow-sm">
  <div class="mb-2">
    <label class="form-label">Nama Alternatif</label>
    <input name="nama" class="form-control" required>
  </div>
  <button name="simpan" class="btn btn-primary">Simpan</button>
</form>

<?php
if(isset($_POST['simpan'])){
  mysqli_query($conn,"INSERT INTO alternatif VALUES(NULL,'$_POST[nama]')");
  echo "<div class='alert alert-success mt-2'>Data tersimpan</div>";
}
include 'footer.php';
?>
