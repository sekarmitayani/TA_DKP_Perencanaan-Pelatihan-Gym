<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet">
</head>
<body>
<nav class="navbar">
    <a href="#" class="navbar-logo">Perencana Latihan <span>Gym</span></a>
    <div class="navbar-nav">
        <a href="index.php">Home</a>
        <a href="aboutus.php">Tentang Kami</a>
        <a href="contact.php">Kontak</a>
    </div>
</nav>
    <div class="contact-container">
        <h2>Kontak Kami</h2>
        <form action="contact.php" method="post">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Pesan:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">Kirim</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // Proses pengiriman email atau penyimpanan pesan
            echo "<p>Terima kasih, $name. Pesan Anda telah diterima.</p>";
        }
        ?>
    </div>
</body>
</html>
