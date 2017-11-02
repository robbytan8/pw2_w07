<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $name = filter_input(INPUT_POST, "txtName");
    echo 'Hello, ' . $name;
}
?>

<form action="" method="post">
    <label for="idTxtName">Your name</label>
    <input id="idTxtName" name="txtName" type="text" autofocus="" placeholder="Your Name" required="">
    <br>
    <input type="submit" name="btnSubmit" value="Submit Data">
</form>