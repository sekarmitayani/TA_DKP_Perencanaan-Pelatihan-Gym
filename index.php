<?php

// Definisikan kelas BMICalculator di luar blok if
class BMICalculator {
    private $weight; // Berat badan dalam kilogram
    private $height; // Tinggi badan dalam sentimeter

    public function __construct($weight, $height) {
        $this->weight = $weight;
        $this->height = $height;
    }

    // Setter untuk berat badan
    public function setWeight($weight) {
        $this->weight = $weight;
    }

    // Getter untuk berat badan
    public function getWeight() {
        return $this->weight;
    }

    // Setter untuk tinggi badan
    public function setHeight($height) {
        $this->height = $height;
    }

    // Getter untuk tinggi badan
    public function getHeight() {
        return $this->height;
    }

    // Fungsi untuk menghitung BMI
    public function calculateBMI() {
        // Konversi tinggi badan dari sentimeter ke meter
        $heightInMeters = $this->height / 100;
        // Hitung BMI
        $bmi = $this->weight / ($heightInMeters * $heightInMeters);
        return $bmi;
    }

    // Fungsi untuk mendapatkan kategori BMI
    public function getBMICategory() {
        $bmi = $this->calculateBMI();
        if ($bmi < 18.5) {
            return "Kurus";
        } elseif ($bmi < 24.9) {
            return "Normal";
        } elseif ($bmi < 29.9) {
            return "Gemuk";
        } else {
            return "Obesitas";
        }
    }
}

// Memproses form pemilihan latihan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_workout'])) {
    $workout = $_POST['workout'];
    $gender = $_POST['gender'];

    if ($gender == 'male') {
        $page = $workout . '_day_male.php';
    } else {
        $page = $workout . '_day_female.php';
    }

    header("Location: $page");
    exit;
}

// Variabel untuk menyimpan berat dan tinggi
$weight = null;
$height = null;

// Cek jika terdapat permintaan POST untuk kalkulator BMI
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weight = $_POST['weight'];
    $height = $_POST['height'];
}

// Buat instance dari kelas BMICalculator
$bmiCalculator = new BMICalculator($weight, $height);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Planner</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet"
    />
</head>
<body>
  <body style="background-image: url('assets/hero.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center center;" >
    <nav class="navbar">
    <a href="#" class="navbar-logo">Perencana Latihan <span>Gym</span></a>
    <div class="navbar-nav">
        <a href="index.php">Home</a>
        <a href="aboutus.php">Tentang Kami</a>
        <a href="contact.php">Kontak</a>
    </div>
</nav>

<form action="index.php" method="post">
    <section class="latihan" id="latihan">
        <h2>Rencana Latihan</h2>
        <label for="workout">Pilih Latihan Hari Ini:</label>
        <select name="workout" id="workout">
            <option value="leg">Leg Day (Leg, Calf, & Glutes)</option>
            <option value="push">Push Day (Chest, Tricep, & Shoulders)</option>
            <option value="pull">Pull Day (Back & Biceps)</option>
        </select>
        <br>
        <label for="gender">Pilih Jenis Kelamin:</label>
        <select name="gender" id="gender">
            <option value="male">Laki-Laki</option>
            <option value="female">Wanita</option>
        </select>
        <p style="line-height: 1.2;">
            <button type="submit" name="submit_workout">Submit</button>
    </section>
</form>
<br>

<div class="bmi-calculator">
    <h2>Kalkulator BMI</h2>
    <form method="POST">
        <label for="height">Tinggi Badan (cm):</label>
        <input type="number" id="height" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>" required>
        <label for="weight">Berat Badan (kg):</label>
        <input type="number" id="weight" name="weight" value="<?php echo isset($_POST['weight']) ? $_POST['weight'] : ''; ?>" required>
        <button type="submit">Hitung BMI</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($bmiCalculator)) {
        $bmi = $bmiCalculator->calculateBMI();
        $category = $bmiCalculator->getBMICategory();
        echo "<div class='result'>BMI Anda: " . number_format($bmi, 2) . "</div>";
        echo "<div class='message'>Kategori BMI Anda: " . $category . "</div>";
    }
    ?>
</div>
</body>
</html>