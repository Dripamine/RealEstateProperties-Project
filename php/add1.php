<?php

require "resources/connect.php";

// Get all login data
$sql = "SELECT * FROM logins WHERE LoginID = :id";
$query = $db->prepare($sql);
$query->execute(["id" => $_SESSION['user_id']]);
$data = $query->fetch();

if ($data["Permission"] == 1) {
    echo "How did you get in here? Bad user. GO AWAY.";
    die();
}

$errorMsgs = [];
$id = "";
$fName = "";
$lName = "";
$email = "";
$postal = "";

if (array_key_exists('user', $_GET)) {
    $sql = "SELECT * FROM users WHERE UserID = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $_GET['user']]);
    $data = $query->fetch();
    if (!$data) {
        echo "Error 404";
        die();
    }

    $id = $data['UserID'];
    $fName = $data['FirstName'];
    $lName = $data['LastName'];
    $email = $data['Email'];
    $postal = $data['Postal'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (IsEmpty($_POST, 'FirstName')) $errorMsgs['FirstName'] = "First Name is required.";
    else $fName = $_POST['FirstName'];

    if (IsEmpty($_POST, 'LastName')) $errorMsgs['LastName'] = "Last Name is required.";
    else $lName = $_POST['LastName'];

    if (IsEmpty($_POST, 'Email')) $errorMsgs['Email'] = "Email is required.";
    else if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) $errorMsgs['Email'] = "Invalid email address.";
    else $email = $_POST['Email'];

    if (IsEmpty($_POST, 'Postal')) $postal = NULL;
    else $postal = $_POST['Postal'];

    $id = $_POST['UserID'] ?? "";

    if (empty($errorMsgs)) {
        $data = [
            "FirstName" => $fName,
            "LastName" => $lName,
            "Email" => $email,
            "Postal" => $postal,
        ];

        if (empty($id)) {
            $sql = "INSERT INTO users (FirstName, LastName, Email, Postal) 
                    VALUES (:FirstName, :LastName, :Email, :Postal);";
        } else {
            $sql = "UPDATE users SET FirstName = :FirstName, LastName = :LastName, Email = :Email, Postal = :Postal WHERE UserID = :UserID";
            $data['UserID'] = $id;
        }

        $query = $db->prepare($sql);
        $query->execute($data);

        if (empty($id)) $id = $db->lastInsertId();

        header("location: admin.php");
    }
}

include "resources/header.php";
?>

<div class="home">
    <section class="center">
        <form action="add1.php" method="POST">
            <h3>User Information</h3>
            <div class="box">
                <p>First Name: </p>
                <input class="input" type="text" name="FirstName" value="<?= $fName; ?>" />
            </div>
            <p class="error" style="color: red; text-align: center;"><?= $errorMsgs['FirstName'] ?? ''; ?></p>
            <div class="box">
                <p>Last Name: </p>
                <input class="input" type="text" name="LastName" value="<?= $lName; ?>" />
            </div>
            <p class="error" style="color: red; text-align: center;"><?= $errorMsgs['LastName'] ?? ''; ?></p>
            <div class="box">
                <p>Email: </p>
                <input class="input" type="email" name="Email" value="<?= $email; ?>" />
            </div>
            <p class="error" style="color: red; text-align: center;"><?= $errorMsgs['Email'] ?? ''; ?></p>
            <div class="box">
                <p>Postal Code: </p>
                <input class="input" type="text" name="Postal" value="<?= $postal; ?>" />
            </div>
            <input type="hidden" name="UserID" value="<?= $id; ?>" />
            <input class="btn" type="submit" value="Submit" />
        </form>
    </section>
</div>

<?php include "resources/footer.php"; ?>
