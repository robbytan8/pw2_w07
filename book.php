<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $isbn = filter_input(INPUT_POST, "txtIsbn");
    $title = filter_input(INPUT_POST, "txtTitle");
    $author = filter_input(INPUT_POST, "txtAuthor");
    $publisher = filter_input(INPUT_POST, "txtPublisher");
    $year = filter_input(INPUT_POST, "txtYear");
    $categoryId = filter_input(INPUT_POST, "selCategory");
    addNewBook($isbn, $title, $author, $publisher, $year, $categoryId);
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
            $categories = getAllCategoryFromDb();
            foreach ($categories as $category) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</value>';
            }
            ?>
        </select>
        <br>
        <input type="submit" name="btnSubmit" value="Submit Data">
    </fieldset>
</form>

<?php
$books = getAllBook();
echo '<table id="tableId" class="display">';
echo '<thead>';
echo '<tr>';
echo '<th>ISBN</th>';
echo '<th>Title</th>';
echo '<th>Author</th>';
echo '<th>Publish Year</th>';
echo '<th>Category</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($books as $book) {
    echo '<tr>';
    echo '<td>' . $book['isbn'] . '</td>';
    echo '<td>' . $book['title'] . '</td>';
    echo '<td>' . $book['author'] . '</td>';
    echo '<td>' . $book['publish_year'] . '</td>';
    echo '<td>' . $book['name'] . '</td>';
    echo '<td>' . '<button onclick="bookUpdate(\'' . $book['isbn'] . '\');"><img src="images/row_edit.png" alt="Update Image"></button>'
    . ' '
    . '<button onclick="sendToDelete(\'' . $book['isbn'] . '\');"><img src="images/row_delete.png" alt="Delete Image"></button>' . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

