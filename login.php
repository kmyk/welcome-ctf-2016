<?php
session_start();
$error_message = "";
$view_user_id = htmlspecialchars($_POST["userid"], ENT_QUOTES);
if (isset($_POST["login"])) {
    try {
        if ($_POST["userid"] === 'root' and ! preg_match('/[a-z]{128,}/', $_POST["password"])) {
            throw new Exception('this is just a kindness for you');
        }
        $pdo = new PDO('sqlite:../../../db/sqlite.db');
        $sql = "select * from user where id = '" . $_POST["userid"] . "' and password = '" . $_POST["password"] . "'";
        $result = $pdo->query($sql);
        if (! $result) {
            $error_message = "query failed";
        } else {
            $row = $result->fetch();
            if (! $row) {
                $error_message = "wrong ID or password";
            } else {
                if ($_POST["userid"] !== $row['id'] || $_POST["password"] !== $row['password']) { // nennnotame check
                    $error_message = "something wrong?";
                } else {
                    session_regenerate_id(TRUE);
                    $_SESSION["USERID"] = $_POST["userid"];
                    header("Location: index.php");
                    exit;
                }
            }
        }
    } catch(Exception $e) {
        $error_message = "exception thrown";
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login page - Welcome CTF 2016: Web 100: Blind SQL Injection</title>
    </head>
    <body>
<!-- registeration is not implemented yet. please use guest/guest for debug. -->
        <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
            <fieldset>
                <legend>login form</legend>
                <div><?php echo $error_message ?></div>
                <label for="userid">user ID</label><input type="text" id="userid" name="userid" value="<?php echo $view_user_id ?>">
                <br>
                <label for="password">password</label><input type="password" id="password" name="password" value="">
                <br>
                <input type="submit" id="login" name="login" value="login">
            </fieldset>
        </form>
    </body>
</html>
