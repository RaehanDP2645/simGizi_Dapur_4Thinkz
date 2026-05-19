<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dapur / Penyedia - MBG Food Hub</title>
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
      <li class="active"><a href="dapur.php"><i class="fa-solid fa-kitchen-set"></i>Dapur / Penyedia</a></li>
      <li><a href="mitra.php"><i class="fa-solid fa-handshake"></i>Mitra</a></li>
      <li><a href="login.php" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div>
        <h4>Dapur / Penyedia</h4>
        <small>Kelola dapur, penanggung jawab, kontak, dan relasi mitra</small>
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
          <div class="stat-card-icon"><i class="fa-solid fa-utensils"></i></div>
          <h5>2</h5>
          <p>Total Dapur</p>
        </div>
        <div class="stat-card success">
          <div class="stat-card-icon"><i class="fa-solid fa-check-circle"></i></div>
          <h5>2</h5>
          <p>Aktif</p>
        </div>
        <div class="stat-card info">
          <div class="stat-card-icon"><i class="fa-solid fa-circle-pause"></i></div>
          <h5>0</h5>
          <p>Nonaktif</p>
        </div>
        <div class="stat-card warning">
          <div class="stat-card-icon"><i class="fa-solid fa-handshake"></i></div>
          <h5>2</h5>
          <p>Mitra Terhubung</p>
        </div>
      </div>

      <div class="dashboard-card">
        <div class="card-header-custom">
          <h4>Data Dapur / Penyedia</h4>
          <button class="btn btn-primary" type="button" onclick="openAddModal()">
            <i class="fa-solid fa-plus"></i>Tambah Data
          </button>
        </div>

        <div class="search-box filter-form">
          <input type="text" class="form-control js-table-search" placeholder="Cari nama dapur, mitra, penanggung jawab, atau kontak...">
          <select class="form-control">
            <option value="">Semua Status</option>
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
          </select>
          <select class="form-control">
            <option value="0">Semua Mitra</option>
            <option value="1">PT Gizi Indonesia</option>
            <option value="2">Yayasan 4THINKZt</option>
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
                <th>Nama Dapur</th>
                <th>Penanggung Jawab</th>
                <th>Kontak</th>
                <th>Mitra</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr data-detail="Jl. Bergizi No. 2">
                <td>1</td>
                <td>Dapur Makan Bergizi</td>
                <td>RHIN FOUNDATION</td>
                <td>+62 882-2874-1963</td>
                <td>Yayasan 4THINKZt</td>
                <td><span class="badge bg-success">Aktif</span></td>
                <td>
                  <button class="btn btn-info btn-sm" type="button" title="Lihat" onclick="toggleDetail(this, 'Alamat dapur')"><i class="fa-solid fa-eye"></i></button>
                  <button class="btn btn-success btn-sm" type="button" title="Edit" onclick="openEditModal({namaDapur:'Dapur Makan Bergizi', penanggungJawab:'RHIN FOUNDATION', kontak:'+62 882-2874-1963', idMitra:'2', alamat:'Jl. Bergizi No. 2', status:'Aktif'})"><i class="fa-solid fa-pen"></i></button>
                  <button class="btn btn-danger btn-sm" type="button" title="Hapus" onclick="deleteRow(this)"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
              <tr data-detail="Jl. Sehat No. 1">
                <td>2</td>
                <td>Dapur Sehat Nusantara</td>
                <td>Budi Santoso</td>
                <td>08123456789</td>
                <td>PT Gizi Indonesia</td>
                <td><span class="badge bg-success">Aktif</span></td>
                <td>
                  <button class="btn btn-info btn-sm" type="button" title="Lihat" onclick="toggleDetail(this, 'Alamat dapur')"><i class="fa-solid fa-eye"></i></button>
                  <button class="btn btn-success btn-sm" type="button" title="Edit" onclick="openEditModal({namaDapur:'Dapur Sehat Nusantara', penanggungJawab:'Budi Santoso', kontak:'08123456789', idMitra:'1', alamat:'Jl. Sehat No. 1', status:'Aktif'})"><i class="fa-solid fa-pen"></i></button>
                  <button class="btn btn-danger btn-sm" type="button" title="Hapus" onclick="deleteRow(this)"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
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
      <h5 id="modalTitle">Tambah Dapur Baru</h5>
      <button class="modal-close" type="button" onclick="closeModal()"><i class="fa-solid fa-times"></i></button>
    </div>

    <form id="formData">
      <div class="form-group">
        <label for="namaDapur">Nama Dapur</label>
        <input type="text" id="namaDapur" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="penanggungJawab">Penanggung Jawab</label>
        <input type="text" id="penanggungJawab" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="kontak">Kontak</label>
        <input type="tel" id="kontak" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="idMitra">Pilih Mitra</label>
        <select id="idMitra" class="form-control" required>
          <option value="">Pilih Mitra</option>
          <option value="1">PT Gizi Indonesia</option>
          <option value="2">Yayasan 4THINKZt</option>
        </select>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat Dapur</label>
        <textarea id="alamat" class="form-control" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select id="status" class="form-control" required>
          <option value="Aktif">Aktif</option>
          <option value="Nonaktif">Nonaktif</option>
        </select>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/frontend.js"></script>
<script>
  function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Dapur Baru';
    document.getElementById('formData').reset();
    document.getElementById('modal').classList.add('active');
  }

  function openEditModal(dapur) {
    document.getElementById('modalTitle').textContent = 'Edit Dapur';
    document.getElementById('namaDapur').value = dapur.namaDapur;
    document.getElementById('penanggungJawab').value = dapur.penanggungJawab;
    document.getElementById('kontak').value = dapur.kontak;
    document.getElementById('idMitra').value = dapur.idMitra;
    document.getElementById('alamat').value = dapur.alamat;
    document.getElementById('status').value = dapur.status;
    document.getElementById('modal').classList.add('active');
  }
</script>
</body>
</html>
