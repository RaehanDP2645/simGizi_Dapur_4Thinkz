document.addEventListener('DOMContentLoaded', () => {
  const username = localStorage.getItem('username') || 'Administrator';
  const adminName = document.getElementById('adminName');
  if (adminName) {
    adminName.textContent = username.charAt(0).toUpperCase() + username.slice(1);
  }

  const logoutBtn = document.getElementById('logoutBtn');
  if (logoutBtn) {
    logoutBtn.addEventListener('click', () => {
      localStorage.removeItem('isLoggedIn');
      localStorage.removeItem('username');
      localStorage.removeItem('loginTime');
    });
  }

  const tableSearch = document.querySelector('.js-table-search');
  if (tableSearch) {
    tableSearch.addEventListener('input', () => {
      const keyword = tableSearch.value.toLowerCase();
      document.querySelectorAll('#dataTable tbody tr:not(.detail-row)').forEach((row) => {
        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
      });
    });
  }

  const modal = document.getElementById('modal');
  if (modal) {
    modal.addEventListener('click', (event) => {
      if (event.target === modal) closeModal();
    });
  }
});

function closeModal() {
  const modal = document.getElementById('modal');
  if (modal) modal.classList.remove('active');
}

function toggleDetail(button, label) {
  const row = button.closest('tr');
  const nextRow = row.nextElementSibling;

  if (nextRow && nextRow.classList.contains('detail-row')) {
    nextRow.remove();
    return;
  }

  const detailRow = document.createElement('tr');
  detailRow.className = 'detail-row';
  detailRow.innerHTML = `<td colspan="7"><strong>${label}:</strong> ${row.dataset.detail || '-'}</td>`;
  row.insertAdjacentElement('afterend', detailRow);
}

function deleteRow(button) {
  if (!confirm('Hapus data dari tampilan frontend sementara?')) return;
  const row = button.closest('tr');
  const nextRow = row.nextElementSibling;
  if (nextRow && nextRow.classList.contains('detail-row')) nextRow.remove();
  row.remove();
}
