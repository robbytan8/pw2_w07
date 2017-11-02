<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $isbn = filter_input(INPUT_POST, "txtIsbn");
    $title = filter_input(INPUT_POST, "txtTitle");
    $author = filter_input(INPUT_POST, "txtAuthor");
    $publisher = filter_input(INPUT_POST, "txtPublisher");
    $year = filter_input(INPUT_POST, "txtYear");
    $cover = "";
    $categoryId = filter_input(INPUT_POST, "selCategory");
    $link = mysqli_connect("localhost", "robby_pwl20171", "robby_pwl20171",
            "pwl20171", "3306") or die(mysqli_connect_error());
    $query = "INSERT INTO book(isbn, title, author, publisher, publish_year, cover, category_id) VALUES(?,?,?,?,?,?,?)";
    mysqli_autocommit($link, FALSE);
    if ($stmt = mysqli_prepare($link, $query)) {
        //  s for string, i for int, d for double, b for blob
        mysqli_stmt_bind_param($stmt, "ssssssi", $isbn, $title, $author,
                $publisher, $year, $cover, $categoryId);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<form action="" method="post">
    <fieldset>
        <legend>Book Form</legend>
        <label for="idTxtIsbn">ISBN</label>
        <input id="idTxtIsbn" name="txtIsbn" type="text" autofocus="" placeholder="ISBN" required="" maxlength="13">
        <br>
        <label for="idTxtTitle">Title</label>
        <input id="idTxtTitle" name="txtTitle" type="text" placeholder="Title" required="">
        <br>
        <label for="idTxtAuthor">Author</label>
        <input id="idTxtAuthor" name="txtAuthor" type="text" placeholder="Author" required="">
        <br>
        <label for="idTxtPublisher">Publisher</label>
        <input id="idTxtPublisher" name="txtPublisher" type="text" placeholder="Publisher" required="">
        <br>
        <label for="idTxtPublishYear">Publish Year</label>
        <input id="idTxtPublishYear" name="txtYear" type="text" placeholder="Publish Year" required="">
        <br>
        <label for="idSelCategory">Category</label>
        <select id="idSelCategory" name="selCategory">
            <?php
            $link = mysqli_connect("localhost", "robby_pwl20171",
                    "robby_pwl20171", "pwl20171", "3306") or die(mysqli_connect_error());
            $query = "SELECT * FROM category";
            if ($result = mysqli_query($link, $query) or die(mysqli_error($link))) {
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</value>';
                }
                mysqli_close($link);
            }
            ?>
        </select>
        <br>
        <input type="submit" name="btnSubmit" value="Submit Data">
    </fieldset>
</form>

<?php
$link = mysqli_connect("localhost", "robby_pwl20171", "robby_pwl20171",
        "pwl20171", "3306") or die(mysqli_connect_error());
$query = "SELECT * FROM book b JOIN category c ON c.id = b.category_id";
if ($result = mysqli_query($link, $query) or die(mysqli_error($link))) {
    echo '<table id="tableId" class="display">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ISBN</th>';
    echo '<th>Title</th>';
    echo '<th>Author</th>';
    echo '<th>Publish Year</th>';
    echo '<th>Category</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['isbn'] . '</td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['author'] . '</td>';
        echo '<td>' . $row['publish_year'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    mysqli_close($link);
}
?>