<?php
$conn = new mysqli("localhost", "root", "", "MasomoDB");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST["full_name"];
    $phone = $_POST["phone"];
    $course_applied = $_POST["course_applied"];

    $stmt = $conn->prepare(
        "INSERT INTO applications (full_name, phone, course_applied) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $full_name, $phone, $course_applied);

    if ($stmt->execute()) {
        $message = "Application submitted successfully.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KCNP Mombasa Admissions</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
}

header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px 28px;
    background: #174a70;
    color: white;
}

header div {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: white;
    color: #174a70;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

header h1 {
    margin: 0;
}

nav {
    display: flex;
    gap: 24px;
    padding: 12px 28px;
    background: #eaf2f8;
}

nav a {
    color: #174a70;
    font-weight: bold;
    text-decoration: none;
}

section {
    max-width: 500px;
    margin: 28px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

form {
    display: grid;
    gap: 8px;
}

input, select {
    box-sizing: border-box;
    width: 100%;
    padding: 9px;
}

button {
    width: fit-content;
    padding: 10px 18px;
    background: #174a70;
    color: white;
    border: 0;
    border-radius: 4px;
}

footer {
    padding: 12px;
    text-align: center;
    background: #f2f2f2;
}
</style>
</head>
<body>  
    <header>
        <div>KCNP</div>
        <h1>KCNP Mombasa Admissions</h1>
    </header>

    <nav>
        <a href="courses.html">Courses</a>
        <a href="sports.html">Sports</a>
        <a href="societies.html">Societies</a>
    </nav>
</body>
<section>
    <h2>Student Registration</h2>

    <form method="post" action="index.php">
        <label for="full_name">Full name:</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="phone">Phone number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="course_applied">Course applied for:</label>
        <select id="course_applied" name="course_applied" required>
            <option value="">Select a course</option>
            <option value="Web Development">Web Development</option>
            <option value="Project Management">Project Management</option>
            <option value="Business Management">Business Management</option>
        </select>

        <button type="submit">Register</button>
    </form>
    <?php
if ($message !== "") {
    echo "<p>" . htmlspecialchars($message) . "</p>";
}
?>
</section>

<footer>
    <p>Phone: 07XX XXX XXX | Email: admissions@example.com | Location: Mombasa, Kenya</p>
</footer>
</html>