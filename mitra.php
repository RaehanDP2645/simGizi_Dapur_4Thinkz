<?php
require 'config/koneksi.php';

if (isset($_POST['simpan'])) {
  $namaMitra = $_POST['nama_mitra'];
  $jenis = $_POST['jenis'];
  $alamat = $_POST['alamat'];
  $statusVerifikasi = $_POST['status_verifikasi'];

  $query = $pdo -> prepare("
      INSERT INTO mitra
      (nama_mitra, jenis, alamat, status_verifikasi)
      VALUES (?, ?, ?, ?)
  ");

  $query -> execute([
      $namaMitra,
      $jenis,
      $alamat,
      $statusVerifikasi
  ]);

  header('Location: mitra.php');
  exit;
}

$totalMitra = $pdo -> query("SELECT COUNT(*) FROM mitra") -> fetchColumn();

$totalTerverifikasi = $pdo
    -> query("SELECT COUNT(*) FROM mitra WHERE status_verifikasi = 'Terverifikasi'")
    -> fetchColumn();

$totalPending = $pdo
    -> query("SELECT COUNT(*) FROM mitra WHERE status_verifikasi = 'Pending'")
    -> fetchColumn();

$totalJenis = $pdo
    -> query("SELECT COUNT(DISTINCT jenis) FROM mitra")
    -> fetchColumn();

$query = $pdo -> query("SELECT * FROM mitra ORDER BY id_mitra DESC");
$mitralist = $query -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mitra - MBG Food Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <div class="logo-area">
      <div class="logo-circle"><i class="fa-solid fa-utensils"></i></div>
      <div>
        <h5>MBG Food Hub</h5>
        <small>Administrator</small>
      </div>
    </div>
    <div class="menu-title">MAIN MENU</div>
    <ul class="menu-list">
      <li><a href="dashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a></li>
      <li><a href="dapur.php"><i class="fa-solid fa-kitchen-set"></i>Dapur / Penyedia</a></li>
      <li class="active"><a href="mitra.php"><i class="fa-solid fa-handshake"></i>Mitra</a></li>
      <li><a href="login.php" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div>
        <h4>Mitra Kerjasama</h4>
        <small>Kelola data mitra kerjasama distribusi makanan bergizi</small>
      </div>
      <div class="admin-profile">
        <div class="admin-avatar"><i class="fa-solid fa-user-shield"></i></div>
        <div>
          <h6 id="adminName">Administrator</h6>
          <small id="adminRole">Admin</small>
        </div>
      </div>
    </div>

    <div class="content-area">
      <div class="card-container">
        <div class="stat-card primary">
          <div class="stat-card-icon"><i class="fa-solid fa-handshake"></i></div>
          <h5><?= $totalMitra; ?></h5>
          <p>Total Mitra</p>
        </div>
        <div class="stat-card success">
          <div class="stat-card-icon"><i class="fa-solid fa-check-circle"></i></div>
          <h5><?= $totalTerverifikasi; ?></h5>
          <p>Terverifikasi</p>
        </div>
        <div class="stat-card warning">
          <div class="stat-card-icon"><i class="fa-solid fa-clock"></i></div>
          <h5><?= $totalPending; ?></h5>
          <p>Pending</p>
        </div>
        <div class="stat-card info">
          <div class="stat-card-icon"><i class="fa-solid fa-briefcase"></i></div>
          <h5><?= $totalJenis; ?></h5>
          <p>Jenis Mitra</p>
        </div>
      </div>

      <div class="dashboard-card">
        <div class="card-header-custom">
          <h4>Data Mitra</h4>
          <button class="btn btn-primary" type="button" onclick="openAddModal()">
            <i class="fa-solid fa-plus"></i>Tambah Mitra
          </button>
        </div>

        <div class="search-box filter-form">
          <input type="text" class="form-control js-table-search" placeholder="Cari mitra...">
          <select class="form-control">
            <option value="">Semua Status</option>
            <option value="Terverifikasi">Terverifikasi</option>
            <option value="Pending">Pending</option>
            <option value="Ditolak">Ditolak</option>
          </select>
          <select class="form-control">
            <option value="">Semua Jenis</option>
            <option value="Perusahaan">Perusahaan</option>
            <option value="Yayasan">Yayasan</option>
            <option value="NGO">NGO</option>
          </select>
          <button class="btn btn-primary" type="button">
            <i class="fa-solid fa-filter"></i>Filter
          </button>
          <button class="btn btn-secondary" type="button">Reset</button>
        </div>

        <div class="table-responsive">
          <table class="table custom-table align-middle" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mitra</th>
                <th>Jenis Mitra</th>
                <th>Alamat</th>
                <th>Status Terverifikasi</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($mitralist as $mitra): ?>

              <tr data-detail="<?= e($mitra['alamat']); ?>">
                <td><?= $no++; ?></td>
                <td><?= e($mitra['nama_mitra']); ?></td>
                <td><?= e($mitra['jenis']); ?></td>
                <td><?= e($mitra['alamat']); ?></td>
                <td>
                  <?php if ($mitra['status_verifikasi'] === 'Terverifikasi'): ?>
                    <span class="badge bg-success">Terverifikasi</span>

                  <?php elseif ($mitra['status_verifikasi'] === 'Ditolak'): ?>
                    <span class="badge bg-danger">Ditolak</span>
                    
                  <?php else: ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                  <?php endif; ?>
                </td>
                <td>
                  <button class="btn btn-info btn-sm" type="button" title="Lihat" onclick="toggleDetail(this, 'Alamat mitra')">
                    <i class="fa-solid fa-eye"></i>
                  </button>

                  <button class="btn btn-success btn-sm" type="button" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </button>

                  <button class="btn btn-danger btn-sm" type="button" title="Hapus">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>

              <?php if (count($mitralist) === 0): ?>
                <tr>
                  <td colspan="6" class="text-center">Belum ada data mitra.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-overlay" id="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h5 id="modalTitle">Tambah Mitra Baru</h5>
      <button class="modal-close" type="button" onclick="closeModal()"><i class="fa-solid fa-times"></i></button>
    </div>

    <form id="formData" method="POST" action="mitra.php">
      <div class="form-group">
        <label for="namaMitra">Nama Mitra</label>
        <input type="text" name="nama_mitra" id="namaMitra" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="jenis">Jenis Mitra</label>
        <select name="jenis" id="jenis" class="form-control" required>
          <option value="">Pilih Jenis</option>
          <option value="Perusahaan">Perusahaan</option>
          <option value="NGO">NGO</option>
          <option value="Yayasan">Yayasan</option>
          <option value="Koperasi">Koperasi</option>
        </select>
      </div>

      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="statusVerifikasi">Status</label>
        <select name="status_verifikasi" id="statusVerifikasi" class="form-control" required>
          <option value="Pending">Pending</option>
          <option value="Terverifikasi">Terverifikasi</option>
          <option value="Ditolak">Ditolak</option>
        </select>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/frontend.js"></script>
<script>
  function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Mitra Baru';
    document.getElementById('formData').reset();
    document.getElementById('modal').classList.add('active');
  }

  function openEditModal(mitra) {
    document.getElementById('modalTitle').textContent = 'Edit Mitra';
    document.getElementById('namaMitra').value = mitra.namaMitra;
    document.getElementById('jenisMitra').value = mitra.jenisMitra;
    document.getElementById('kontak').value = mitra.kontak;
    document.getElementById('email').value = mitra.email;
    document.getElementById('alamat').value = mitra.alamat;
    document.getElementById('status').value = mitra.status;
    document.getElementById('modal').classList.add('active');
  }
</script>
</body>
</html>
