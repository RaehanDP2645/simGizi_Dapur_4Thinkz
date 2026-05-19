<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - MBG Food Hub</title>
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
      <li class="active"><a href="dashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a></li>
      <li><a href="dapur.php"><i class="fa-solid fa-kitchen-set"></i>Dapur / Penyedia</a></li>
      <li><a href="mitra.php"><i class="fa-solid fa-handshake"></i>Mitra</a></li>
      <li><a href="login.php" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div>
        <h4>Dashboard</h4>
        <small>Ringkasan operasional dapur dan mitra SIM Gizi</small>
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
      <div class="dashboard-hero">
        <div>
          <span class="section-label">Ringkasan Harian</span>
          <h3>Monitoring SIM Gizi</h3>
          <p>Pantau dapur aktif, mitra terhubung, dan data yang perlu dicek hari ini.</p>
        </div>
        <a class="btn btn-primary" href="dapur.php">
          <i class="fa-solid fa-kitchen-set"></i>Kelola Dapur
        </a>
      </div>

      <div class="card-container">
        <div class="stat-card primary">
          <div class="stat-card-icon"><i class="fa-solid fa-utensils"></i></div>
          <h5>2</h5>
          <p>Total Dapur</p>
        </div>
        <div class="stat-card success">
          <div class="stat-card-icon"><i class="fa-solid fa-check-circle"></i></div>
          <h5>2</h5>
          <p>Dapur Aktif</p>
        </div>
        <div class="stat-card warning">
          <div class="stat-card-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
          <h5>0</h5>
          <p>Perlu Dicek</p>
        </div>
        <div class="stat-card info">
          <div class="stat-card-icon"><i class="fa-solid fa-handshake"></i></div>
          <h5>2</h5>
          <p>Mitra Terdaftar</p>
        </div>
      </div>

      <div class="dashboard-grid">
        <div class="dashboard-card">
          <div class="card-header-custom">
            <h4>Dapur Terbaru</h4>
            <a class="btn btn-primary btn-sm" href="dapur.php">Lihat Semua</a>
          </div>
          <div class="table-responsive">
            <table class="table custom-table align-middle">
              <thead>
                <tr>
                  <th>Nama Dapur</th>
                  <th>Mitra</th>
                  <th>Penanggung Jawab</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Dapur Makan Bergizi</td>
                  <td>Yayasan 4THINKZt</td>
                  <td>RHIN FOUNDATION</td>
                  <td><span class="badge bg-success">Aktif</span></td>
                </tr>
                <tr>
                  <td>Dapur Sehat Nusantara</td>
                  <td>PT Gizi Indonesia</td>
                  <td>Budi Santoso</td>
                  <td><span class="badge bg-success">Aktif</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="dashboard-card status-card">
          <div class="card-header-custom compact">
            <h4>Status Operasional</h4>
          </div>
          <div class="status-dashboard-body">
            <div class="status-metrics">
              <div class="status-metric">
                <span class="status-metric-icon success"><i class="fa-solid fa-check"></i></span>
                <div>
                  <strong>2</strong>
                  <span>Dapur aktif</span>
                </div>
              </div>
              <div class="status-metric">
                <span class="status-metric-icon muted"><i class="fa-solid fa-pause"></i></span>
                <div>
                  <strong>0</strong>
                  <span>Dapur nonaktif</span>
                </div>
              </div>
              <div class="status-metric">
                <span class="status-metric-icon warning"><i class="fa-solid fa-phone-slash"></i></span>
                <div>
                  <strong>0</strong>
                  <span>Kontak belum lengkap</span>
                </div>
              </div>
            </div>

            <div class="partner-highlight">
              <div class="partner-highlight-title">
                <i class="fa-solid fa-ranking-star"></i>
                <h5>Mitra dengan dapur terbanyak</h5>
              </div>
              <div class="partner-row">
                <div>
                  <strong>PT Gizi Indonesia</strong>
                  <small>Perusahaan</small>
                </div>
                <span>1 dapur</span>
              </div>
              <div class="partner-row">
                <div>
                  <strong>Yayasan 4THINKZt</strong>
                  <small>Yayasan</small>
                </div>
                <span>1 dapur</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/frontend.js"></script>
</body>
</html>
