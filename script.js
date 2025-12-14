// Update dashboard tanpa reload
function updateDashboard() {
    fetch('dashboard.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.stat.total p').textContent = data.total;
            document.querySelector('.stat.selesai p').textContent = data.selesai;
            document.querySelector('.stat.belum-selesai p').textContent = data.belum_selesai;
            document.querySelector('.stat.prioritas-penting p').textContent = data.prioritas_penting;
            document.querySelector('.stat.prioritas-mendesak p').textContent = data.prioritas_mendesak;
            document.querySelector('.stat.prioritas-kurangpenting p').textContent = data.prioritas_kurangpenting;
            document.querySelector('.stat.prioritas-tidakmendesak p').textContent = data.prioritas_tidakmendesak;
        })
        .catch(error => console.error('Error updating dashboard:', error));
}

// Animasi saat tambah tugas
document.querySelector("form").addEventListener("submit", () => {
  alert("Tugas berhasil ditambahkan!");
  setTimeout(updateDashboard, 500); // Update dashboard setelah submit
});

// Konfirmasi hapus dan update dashboard
document.querySelectorAll("a[href*='delete.php']").forEach(btn => {
  btn.addEventListener("click", e => {
    if(!confirm("Yakin mau hapus tugas ini?")) {
      e.preventDefault();
    } else {
      setTimeout(updateDashboard, 500);
    }
  });
});

// Update dashboard saat klik selesai
document.addEventListener('click', function(e) {
    if (e.target.matches('a[href*="update.php"]')) {
        setTimeout(updateDashboard, 500);
    }
});

// Initial load
updateDashboard();