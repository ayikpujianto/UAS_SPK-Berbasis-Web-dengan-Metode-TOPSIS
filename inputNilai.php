<?php include 'config.php'; include 'header.php'; ?>

<h3>Input Penilaian</h3>

<form method="post" class="card card-body shadow-sm">
  <div class="mb-2">
    <label class="form-label">Alternatif</label>
    <select name="alt" class="form-select">
      <?php
      $q=mysqli_query($conn,"SELECT * FROM alternatif");
      while($a=mysqli_fetch_assoc($q)){
        echo "<option value='$a[id]'>$a[nama]</option>";
      }
      ?>
    </select>
  </div>

  <div class="mb-2">
    <label class="form-label">Kriteria</label>
    <select name="krit" class="form-select">
      <?php
      $q=mysqli_query($conn,"SELECT * FROM kriteria");
      while($k=mysqli_fetch_assoc($q)){
        echo "<option value='$k[id]'>$k[nama]</option>";
      }
      ?>
    </select>
  </div>

  <div class="mb-2">
    <label class="form-label">Nilai</label>
    <input name="nilai" type="number" class="form-control" required>
  </div>

  <button name="simpan" class="btn btn-primary">Simpan</button>
</form>

<?php
if(isset($_POST['simpan'])){
  mysqli_query($conn,"INSERT INTO penilaian VALUES(NULL,'$_POST[alt]','$_POST[krit]','$_POST[nilai]')");
  echo "<div class='alert alert-success mt-2'>Data tersimpan</div>";
}
include 'footer.php';
?>
