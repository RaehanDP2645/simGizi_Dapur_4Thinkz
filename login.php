<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - MBG Food Hub</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    .login-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    }

    .login-header {
      background: linear-gradient(135deg, #1e3a8a 0%, #d4af37 100%);
      color: white;
      padding: 40px 20px;
      text-align: center;
    }

    .login-header i {
      font-size: 50px;
      margin-bottom: 15px;
    }

    .login-header h1 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .login-header p {
      font-size: 14px;
      opacity: 0.9;
      margin: 0;
    }

    .login-body {
      padding: 40px 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .form-control {
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      padding: 12px 15px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #1e3a8a;
      box-shadow: 0 0 0 0.2rem rgba(30, 58, 138, 0.15);
      background-color: #f8f9ff;
    }

    .form-control::placeholder {
      color: #999;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #1e3a8a 0%, #d4af37 100%);
      border: none;
      color: white;
      font-weight: 600;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
    }

    .login-btn:active {
      transform: translateY(0);
    }

    .alert {
      border-radius: 8px;
      border: none;
      margin-bottom: 20px;
    }

    .alert-danger {
      background-color: #fee;
      color: #c33;
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 15px;
      font-size: 13px;
    }

    .remember-forgot a {
      color: #1e3a8a;
      text-decoration: none;
      transition: color 0.3s;
    }

    .remember-forgot a:hover {
      color: #d4af37;
      text-decoration: underline;
    }

    .remember-forgot label {
      margin: 0;
      font-weight: 500;
      cursor: pointer;
    }

    .demo-info {
      background: #f0f4ff;
      border-left: 4px solid #1e3a8a;
      padding: 15px;
      border-radius: 5px;
      margin-top: 20px;
      font-size: 13px;
      color: #555;
    }

    .demo-info strong {
      color: #333;
    }

    .loading-spinner {
      display: none;
      width: 16px;
      height: 16px;
      margin-right: 8px;
    }

    .login-btn:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 10px;
      }

      .login-header {
        padding: 30px 15px;
      }

      .login-header i {
        font-size: 40px;
      }

      .login-header h1 {
        font-size: 24px;
      }

      .login-body {
        padding: 30px 20px;
      }
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #1e3a8a;
    }

    .password-wrapper {
      position: relative;
    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="login-card">
    
    <!-- HEADER -->
    <div class="login-header">
      <i class="fa-solid fa-utensils"></i>
      <h1>MBG Food Hub</h1>
      <p>Sistem Distribusi Makanan Bergizi</p>
    </div>

    <!-- FORM -->
    <div class="login-body">
      
      <form id="loginForm">
        
        <!-- ERROR ALERT -->
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade" role="alert" style="display: none;">
          <strong>Login Gagal!</strong>
          <span id="errorMessage"></span>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <!-- USERNAME -->
        <div class="form-group">
          <label for="username">
            <i class="fa-solid fa-user"></i> Username
          </label>
          <input 
            type="text" 
            class="form-control" 
            id="username" 
            placeholder="Masukkan username"
            required
            autocomplete="username"
          >
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
          <label for="password">
            <i class="fa-solid fa-lock"></i> Password
          </label>
          <div class="password-wrapper">
            <input 
              type="password" 
              class="form-control" 
              id="password" 
              placeholder="Masukkan password"
              required
              autocomplete="current-password"
            >
            <i class="fa-solid fa-eye password-toggle" id="togglePassword"></i>
          </div>
        </div>

        <!-- REMEMBER & FORGOT -->
        <div class="remember-forgot">
          <label>
            <input type="checkbox" id="remember" checked> Ingat saya
          </label>
        </div>

        <!-- LOGIN BUTTON -->
        <button type="submit" class="login-btn">
          <span id="buttonText">
            <i class="fa-solid fa-sign-in-alt"></i> Login
          </span>
        </button>

      </form>

      <!-- DEMO INFO -->
      <div class="demo-info">
        <strong>Demo Login:</strong><br>
        Username: <strong>admin</strong><br>
        Password: <strong>admin</strong>
      </div>

    </div>

  </div>
</div>

<script>
  // PASSWORD TOGGLE
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
  });

  // LOGIN FORM HANDLER
  const loginForm = document.getElementById('loginForm');
  const errorAlert = document.getElementById('errorAlert');
  const errorMessage = document.getElementById('errorMessage');

  loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const remember = document.getElementById('remember').checked;

    // SIMPLE VALIDATION (admin/admin)
    if (username === 'admin' && password === 'admin') {
      // SIMPAN SESSION
      localStorage.setItem('isLoggedIn', 'true');
      localStorage.setItem('username', username);
      localStorage.setItem('loginTime', new Date().toISOString());

      if (remember) {
        localStorage.setItem('rememberMe', 'true');
      }

      // REDIRECT KE DASHBOARD FRONTEND
      window.location.href = 'dashboard.php';
    } else {
      // TAMPILKAN ERROR
      errorMessage.textContent = 'Username atau password salah!';
      errorAlert.style.display = 'block';
      
      // CLEAR PASSWORD
      document.getElementById('password').value = '';
      document.getElementById('password').focus();
    }
  });

  // AUTO-LOGIN JIKA ADA REMEMBER ME
  window.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('rememberMe') === 'true') {
      document.getElementById('username').value = 'admin';
      document.getElementById('remember').checked = true;
    }
  });

  // TUTUP ALERT OTOMATIS SETELAH 5 DETIK
  document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
      if (alert.style.display !== 'none') {
        setTimeout(() => {
          alert.style.display = 'none';
        }, 5000);
      }
    });
  });
</script>

</body>
</html>
