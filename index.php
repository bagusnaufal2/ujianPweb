<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>To-Do List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>My To-Do List</h1>
    
    <?php
    // Hitung total tugas
    $total = $conn->query("SELECT COUNT(*) as count FROM tasks")->fetch_assoc()['count'];
    $selesai = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE status = 1")->fetch_assoc()['count'];
    $belum_selesai = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE status = 0")->fetch_assoc()['count'];
    
    // Hitung prioritas
    $prioritas_penting = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Penting'")->fetch_assoc()['count'];
    $prioritas_kurangpenting = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Kurang penting'")->fetch_assoc()['count'];
    $prioritas_mendesak = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Mendesak'")->fetch_assoc()['count'];
    $prioritas_tidakmendesak = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Tidak mendesak'")->fetch_assoc()['count'];
    ?>
    
    <div class="dashboard">
      <div class="dashboard-section">
        <h2>Status Tugas</h2>
        <div class="stats-grid">
          <div class="stat total">
            <h3>Total Tugas</h3>
            <p><?php echo $total; ?></p>
          </div>
          <div class="stat selesai">
            <h3>Selesai</h3>
            <p><?php echo $selesai; ?></p>
          </div>
          <div class="stat belum-selesai">
            <h3>Belum Selesai</h3>
            <p><?php echo $belum_selesai; ?></p>
          </div>
        </div>
      </div>
      
      <div class="dashboard-section">
        <h2>Prioritas Tugas</h2>
        <div class="stats-grid">
          <div class="stat prioritas-penting">
            <h3>Penting</h3>
            <p><?php echo $prioritas_penting; ?></p>
          </div>
          <div class="stat prioritas-mendesak">
            <h3>Mendesak</h3>
            <p><?php echo $prioritas_mendesak; ?></p>
          </div>
          <div class="stat prioritas-kurangpenting">
            <h3>Kurang Penting</h3>
            <p><?php echo $prioritas_kurangpenting; ?></p>
          </div>
          <div class="stat prioritas-tidakmendesak">
            <h3>Tidak Mendesak</h3>
            <p><?php echo $prioritas_tidakmendesak; ?></p>
          </div>
        </div>
      </div>
    </div>
    
    <form action="add.php" method="POST">
      <input type="text" name="task" placeholder="Tambah tugas..." required>
      <select name="priority">
        <option value="Tidak mendesak">Tidak mendesak</option>
        <option value="Kurang penting" selected>Kurang penting</option>
        <option value="Mendesak">Mendesak</option>
        <option value="Penting">Penting</option>
      </select>
      <button type="submit">Tambah</button>
    </form>

    <ul>
      <?php
      $result = $conn->query("SELECT * FROM tasks");
      while($row = $result->fetch_assoc()) {
        $tanggal = date("d M Y, H:i", strtotime($row['created_at']));
        echo "<li>";
        echo "<div class='task-content'>";
        echo $row['status'] ? "<s>{$row['task']}</s>" : $row['task'];
        echo "<br><small>Dibuat: {$tanggal} | Prioritas: <span class='priority " . str_replace([' '], [''], $row['priority']) . "'>{$row['priority']}</span></small>";
        echo "</div>";
        echo "<div class='actions'>";
        echo "<a href='update.php?id={$row['id']}'>✔</a>";
        echo "<a href='delete.php?id={$row['id']}'>✖</a>";
        echo "</div>";
        echo "</li>";
      }
      ?>
    </ul>
  </div>
  <script src="script.js"></script>
</body>

</html>
