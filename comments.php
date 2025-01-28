<?php
// Mengaktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = 'comments.txt';

// Menangani pengiriman komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = trim($_POST['comment']);
    if (!empty($comment)) {
        $timestamp = date('Y-m-d H:i:s');
        $newComment = "$timestamp - $comment\n";
        if (file_put_contents($file, $newComment, FILE_APPEND) === false) {
            echo "<p>Gagal menyimpan komentar. Periksa izin file.</p>";
        }
    } else {
        echo "<p>Komentar kosong tidak dapat disimpan.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        textarea {
            width: 90%;
            max-width: 500px;
            height: 100px;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .comments {
            margin-top: 20px;
            text-align: left;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .comment {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Komentar</h1>

    <!-- Formulir untuk mengirim komentar -->
    <form action="" method="POST">
        <textarea name="comment" placeholder="Tulis komentar Anda di sini..." required></textarea>
        <br>
        <button type="submit">Kirim Komentar</button>
    </form>

    <!-- Menampilkan daftar komentar -->
    <div class="comments">
        <h2>Daftar Komentar</h2>
        <?php
        // Menampilkan komentar dari file comments.txt
        if (file_exists($file)) {
            $comments = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($comments as $c) {
                echo '<div class="comment">' . htmlspecialchars($c) . '</div>';
            }
        } else {
            echo '<p>Belum ada komentar.</p>';
        }
        ?>
    </div>

</body>
</html>
