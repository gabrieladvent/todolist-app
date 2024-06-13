<?php
include '../database/config.php';

// Mulai session jika belum dimulai
session_start();

// Proses insert data
if (isset($_POST['add'])) {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id']; // Ambil user_id dari session yang sudah login
    $q_insert = "INSERT INTO tasks (tasklabel, taskstatus, user_id) VALUES ($1, 'open', $2)";
    $result = pg_prepare($dbconn, "insert_task", $q_insert);
    $run_q_insert = pg_execute($dbconn, "insert_task", array($task, $user_id));

    if ($run_q_insert) {
        header('Refresh:0; url=todolist.php');
    }
}

// Select
$user_id = $_SESSION['user_id'];
// Mempersiapkan query
$prepare_query = 'SELECT * FROM tasks WHERE user_id = $1 ORDER BY taskid DESC';
pg_prepare($dbconn, "select_tasks", $prepare_query);
// Menjalankan query dengan data
$run_q_select = pg_execute($dbconn, "select_tasks", array($user_id));

// Delete
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $q_delete = "DELETE FROM tasks WHERE taskid = $1 AND user_id = $2";
    $result = pg_prepare($dbconn, "delete_task", $q_delete);
    $run_q_delete = pg_execute($dbconn, "delete_task", array($task_id, $user_id));

    header('Refresh:0; url=todolist.php');
}

// Update
if (isset($_GET['done'])) {
    $task_id = $_GET['done'];
    $status = ($_GET['status'] == 'open') ? 'close' : 'open';
    $q_update = "UPDATE tasks SET taskstatus = $1 WHERE taskid = $2 AND user_id = $3";
    $result = pg_prepare($dbconn, "update_task", $q_update);
    $run_q_update = pg_execute($dbconn, "update_task", array($status, $task_id, $user_id));

    header('Refresh:0; url=todolist.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do List</title>
    <!-- favicon -->
    <link rel="icon" href="../assets/fav.png" type="image/x-icon">
    <!-- style -->
    <link rel="stylesheet" href="../assets/style.css">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <style>
        .data {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-radius: 5px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .foto {
            border-radius: 50%;
        }

        .title-data {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="data">
            <!-- Tombol Logout -->
            <form action="../controller/logout.php" method="POST">
                <button type="submit" name="logout" onclick="return confirm('Apakah anda yakin untuk keluar ?')">Logout</button>
            </form>
        </div>
        <div class="header">
            <div class="title">
                <i class="fa-solid fa-book-bookmark"></i>
                <span>To Do List</span>
            </div>
            <div>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input type="text" name="task" class="input-control" placeholder="< Teks to do >" required>
                    <div class="text-right">
                        <button type="submit" name="add">Tambah</button>
                    </div>
                </form>
            </div>
            <?php if (pg_num_rows($run_q_select) > 0) {
                while ($r = pg_fetch_assoc($run_q_select)) { ?>
                    <div class="card">
                        <div class="task-item <?= $r['taskstatus'] == 'close' ? 'done' : '' ?>">
                            <div>
                                <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                                <span><?= $r['tasklabel'] ?></span>
                            </div>
                            <div>
                                <a href="?delete=<?= $r['taskid'] ?>" class="icon" title="Remove" onclick="return confirm('Apakah anda yakin untuk menghapus data ini ?')"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="titles">*Belum ada task</div>
            <?php } ?>
        </div>
    </section>
</body>

</html>