<?php
include 'config.php';

// Ambil data alternatif
$alternatif = [];
$q = mysqli_query($conn,"SELECT * FROM alternatif");
while($r = mysqli_fetch_assoc($q)) {
  $alternatif[] = $r;
}

// Ambil data kriteria
$kriteria = [];
$q = mysqli_query($conn,"SELECT * FROM kriteria");
while($r = mysqli_fetch_assoc($q)) {
  $kriteria[] = $r;
}

// Validasi awal
if(count($alternatif) == 0 || count($kriteria) == 0){
  die("Data alternatif atau kriteria masih kosong.");
}

// Ambil nilai
$X = [];
foreach($alternatif as $a){
  foreach($kriteria as $k){
    $q = mysqli_query($conn,"SELECT nilai FROM penilaian WHERE alternatif_id={$a['id']} AND kriteria_id={$k['id']}");
    if(mysqli_num_rows($q)==0){
      die("Data penilaian belum lengkap. Lengkapi semua nilai terlebih dahulu.");
    }
    $n = mysqli_fetch_assoc($q);
    $X[$a['id']][$k['id']] = $n['nilai'];
  }
}

// Normalisasi
$akar = [];
foreach($kriteria as $k){
  $sum = 0;
  foreach($alternatif as $a){
    $sum += pow($X[$a['id']][$k['id']],2);
  }
  if($sum == 0) die("Nilai kriteria {$k['nama']} semuanya nol.");
  $akar[$k['id']] = sqrt($sum);
}

// Normalisasi terbobot
$Y = [];
foreach($alternatif as $a){
  foreach($kriteria as $k){
    $R = $X[$a['id']][$k['id']] / $akar[$k['id']];
    $Y[$a['id']][$k['id']] = $R * $k['bobot'];
  }
}

// Solusi ideal
$Aplus = $Amin = [];
foreach($kriteria as $k){
  $col = [];
  foreach($alternatif as $a){
    $col[] = $Y[$a['id']][$k['id']];
  }

  if($k['tipe'] == 'benefit'){
    $Aplus[$k['id']] = max($col);
    $Amin[$k['id']] = min($col);
  } else {
    $Aplus[$k['id']] = min($col);
    $Amin[$k['id']] = max($col);
  }
}

// Hitung jarak & preferensi
$V = [];
foreach($alternatif as $a){
  $dp = 0; $dm = 0;
  foreach($kriteria as $k){
    $dp += pow($Y[$a['id']][$k['id']] - $Aplus[$k['id']], 2);
    $dm += pow($Y[$a['id']][$k['id']] - $Amin[$k['id']], 2);
  }
  $dp = sqrt($dp);
  $dm = sqrt($dm);
  $V[$a['id']] = $dm / ($dp + $dm);
}

// Urutkan hasil
arsort($V);
?>
