<?php include 'config.php'; include 'header.php'; ?>

<h3>Input Kriteria</h3>

<form method="post" class="card card-body shadow-sm">
  <div class="mb-2">
    <label class="form-label">Nama Kriteria</label>
    <input name="nama" class="form-control" required>
  </div>
  <div class="mb-2">
    <label class="form-label">Bobot</label>
    <input name="bobot" type="number" step="0.01" class="form-control" required>
  </div>
  <div class="mb-2">
    <label class="form-label">Tipe</label>
    <select name="tipe" class="form-select">
      <option value="benefit">Benefit</option>
      <option value="cost">Cost</option>
    </select>
  </div>
  <button name="simpan" class="btn btn-primary">Simpan</button>
</form>

<?php
if(isset($_POST['simpan'])){
  mysqli_query($conn,"INSERT INTO kriteria VALUES(NULL,'$_POST[nama]','$_POST[bobot]','$_POST[tipe]')");
  echo "<div class='alert alert-success mt-2'>Data tersimpan</div>";
}
include 'footer.php';
?>
