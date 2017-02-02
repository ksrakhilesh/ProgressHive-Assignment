<?php
if(isset($_POST['email'])) {
    session_start();
    echo "xdSS";
    $data =$_POST['email'];
    if($data === ''){
        $_SESSION["valid"] =  "Empty input";
        $_SESSION['state'] = "text-warning";
        session_write_close();
        header('Location: index.php');
        exit;
    }
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["valid"] = "Its Not Even a Email Id";
        $_SESSION['state'] ="text-warning";
        session_write_close();
        header('Location: index.php');
        exit;
    }
    $getData = file_get_contents("emails.json");
    $obj = json_decode($getData, true);
    $validate = 0;
    foreach ($obj['emails'] as $value) {
        if($value['email'] === $data){
            $_SESSION["valid"] = "Valid Email Id";
            $_SESSION['state'] = 'text-success';
            session_write_close();
            header('Location: index.php');
            exit;
        }
    }
    $_SESSION["valid"] = "Email Id Does not exist";
    $_SESSION['state'] = "text-danger";
    session_write_close();
    header('Location: index.php');
    exit;
}

?>