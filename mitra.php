<?php
require 'config/koneksi.php';

// ====================
// PROSES SIMPAN DATA MITRA (TAMBAH & EDIT)
// ====================
if (isset($_POST['simpan'])) {
  $idMitra = $_POST['id_mitra'];
  $namaMitra = $_POST['nama_mitra'];
  $jenis = $_POST['jenis'];
  $alamat = $_POST['alamat'];
  $statusVerifikasi = $_POST['status_verifikasi'];

  // TAMBAH MITRA
  if ($idMitra === '') {
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

    header('Location: mitra.php?pesan=tambah');
    exit;
  } 
  // EDIT MITRA
  else {
    $query = $pdo -> prepare("
      UPDATE mitra
      SET nama_mitra = ?,
          jenis = ?,
          alamat = ?,
          status_verifikasi = ?
      WHERE id_mitra = ?
    ");

    $query -> execute([
      $namaMitra,
      $jenis,
      $alamat,
      $statusVerifikasi,
      $idMitra
    ]);

    header('Location: mitra.php?pesan=edit');
    exit;
  }
}

// ====================
// HAPUS DATA MITRA
// ====================
if (isset($_GET['hapus'])) {
  $idMitra = $_GET['hapus'];

  try {
    $query = $pdo -> prepare("DELETE FROM mitra WHERE id_mitra = ?");
    $query -> execute([$idMitra]);

    header('Location: mitra.php?pesan=hapus');
    exit;
  } catch (PDOException $e) {
    die('Data gagal dihapus: ' . $e -> getMessage());
  }
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

// $query = $pdo -> query("SELECT * FROM mitra ORDER BY id_mitra DESC");
// $mitralist = $query -> fetchAll(PDO::FETCH_ASSOC);

// ==========================
// FILTER & TAMPIL DATA MITRA
// ==========================
$keyword = $_GET['keyword'] ?? '';
$statusFilter = $_GET['status_verifikasi'] ?? '';
$jenisFilter = $_GET['jenis'] ?? '';

$sql = "SELECT * FROM mitra WHERE 1=1";
$params = [];

if ($keyword) {
  $sql .= " AND (nama_mitra LIKE ? OR jenis LIKE ? OR alamat LIKE ?)";
  $search = "%$keyword%";
  $params[] = $search;
  $params[] = $search;
  $params[] = $search;
}

if ($statusFilter) {
  $sql .= " AND status_verifikasi = ?";
  $params[] = $statusFilter;
}

if ($jenisFilter !== '') {
  $sql .= " AND jenis = ?";
  $params[] = $jenisFilter;
}

$sql .= " ORDER BY id_mitra DESC";
$query = $pdo -> prepare($sql);
$query -> execute($params);
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
      <?php if (isset($_GET['pesan'])): ?>
        <?php if ($_GET['pesan'] === 'tambah'): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data mitra berhasil ditambahkan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif ($_GET['pesan'] === 'edit'): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data mitra berhasil diperbarui
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif ($_GET['pesan'] === 'hapus'): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data mitra berhasil dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
      <?php endif; ?>

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

        <form class="search-box filter-form" method="GET" action="mitra.php">
          <input type="text" name="keyword" class="form-control"
            placeholder="Cari mitra..." value="<?= e($keyword); ?>">

          <select name="status_verifikasi" class="form-control">
            <option value="">Semua Status</option>
            <option value="Terverifikasi" <?= $statusFilter === 'Terverifikasi' ? 'selected' : ''; ?>>Terverifikasi</option>
            <option value="Pending" <?= $statusFilter === 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="Ditolak" <?= $statusFilter === 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
          </select>

          <select name="jenis" class="form-control">
            <option value="">Semua Jenis</option>
            <option value="Perusahaan" <?= $jenisFilter === 'Perusahaan' ? 'selected' : ''; ?>>Perusahaan</option>
            <option value="Yayasan" <?= $jenisFilter === 'Yayasan' ? 'selected' : ''; ?>>Yayasan</option>
            <option value="NGO" <?= $jenisFilter === 'NGO' ? 'selected' : ''; ?>>NGO</option>
            <option value="Koperasi" <?= $jenisFilter === 'Koperasi' ? 'selected' : ''; ?>>Koperasi</option>
          </select>

          <button class="btn btn-primary" type="summit">
            <i class="fa-solid fa-filter"></i>Filter
          </button>
          <a class="btn btn-secondary" href="mitra.php">Reset</a>
        </form>

        <div class="table-responsive">
          <table class="table custom-table align-middle" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mitra</th>
                <th>Jenis Mitra</th>
                <th>Alamat</th>
                <th>Status Verifikasi</th>
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

                  <button
                    class="btn btn-success btn-sm"
                    type="button"
                    title="Edit"
                    onclick='openEditModal(<?= json_encode($mitra); ?>)'>
                    <i class="fa-solid fa-pen"></i>
                  </button>

                  <button
                    class="btn btn-danger btn-sm"
                    type="button"
                    title="Hapus"
                    onclick="openDeleteModal(<?= $mitra['id_mitra']; ?>, '<?= e($mitra['nama_mitra']); ?>')">
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
      <input type="hidden" name="id_mitra" id="idMitra">
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

<!-- MODAL KONFIRMASI HAPUS MITRA -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Mitra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin ingin Menghapus data mitra <strong id="deleteMitraName"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/frontend.js"></script>
<script>
  function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Mitra Baru';
    document.getElementById('formData').reset();
    document.getElementById('idMitra').value = '';
    document.getElementById('modal').classList.add('active');
  }

  function openEditModal(mitra) {
    document.getElementById('modalTitle').textContent = 'Edit Mitra';
    document.getElementById('idMitra').value = mitra.id_mitra;
    document.getElementById('namaMitra').value = mitra.nama_mitra;
    document.getElementById('jenis').value = mitra.jenis;
    document.getElementById('alamat').value = mitra.alamat;
    document.getElementById('statusVerifikasi').value = mitra.status_verifikasi;
    document.getElementById('modal').classList.add('active');
  }

  // =============================
  // MODAL KONFIRMASI HAPUS MITRA
  // =============================
  function openDeleteModal(idMitra, namaMitra) {
    document.getElementById('deleteMitraName').textContent = namaMitra;
    document.getElementById('deleteConfirmBtn').href = `mitra.php?hapus=` + idMitra;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
  }
</script>
</body>
</html>
