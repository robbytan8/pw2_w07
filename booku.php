<?php
$command = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($command) && $command == 'udt') {
    $isbn = filter_input(INPUT_GET, 'tod', FILTER_SANITIZE_SPECIAL_CHARS);
    $book = getOneBook($isbn);
}

$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $isbn = filter_input(INPUT_POST, "txtIsbn");
    $title = filter_input(INPUT_POST, "txtTitle");
    $author = filter_input(INPUT_POST, "txtAuthor");
    $publisher = filter_input(INPUT_POST, "txtPublisher");
    $year = filter_input(INPUT_POST, "txtYear");
    $categoryId = filter_input(INPUT_POST, "selCategory");
    updateBook($isbn, $title, $author, $publisher, $year, $categoryId);
    header('location:?navito=book');
}
?>

<form action="" method="post">
    <fieldset>
        <legend>Book Form</legend>
        <label for="idTxtIsbn">ISBN</label>
        <input id="idTxtIsbn" name="txtIsbn" type="text" placeholder="ISBN" required="" maxlength="13" readonly="" value="<?php echo $book['isbn'] ?>">
        <br>
        <label for="idTxtTitle">Title</label>
        <input id="idTxtTitle" name="txtTitle" type="text" autofocus="" placeholder="Title" required="" value="<?php echo $book['title'] ?>">
        <br>
        <label for="idTxtAuthor">Author</label>
        <input id="idTxtAuthor" name="txtAuthor" type="text" placeholder="Author" required="" value="<?php echo $book['author'] ?>">
        <br>
        <label for="idTxtPublisher">Publisher</label>
        <input id="idTxtPublisher" name="txtPublisher" type="text" placeholder="Publisher" required="" value="<?php echo $book['publisher'] ?>">
        <br>
        <label for="idTxtPublishYear">Publish Year</label>
        <input id="idTxtPublishYear" name="txtYear" type="text" placeholder="Publish Year" required="" value="<?php echo $book['publish_year'] ?>">
        <br>
        <label for="idSelCategory">Category</label>
        <select id="idSelCategory" name="selCategory">
            <?php
            $categories = getAllCategoryFromDb();
            foreach ($categories as $category) {
                if ($book['category_id'] == $category['id']) {
                    echo '<option value="' . $category['id'] . '" selected>' . $category['name'] . '</value>';
                } else {
                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</value>';
                }
            }
            ?>
        </select>
        <br>
        <input type="submit" name="btnSubmit" value="Update Data">
    </fieldset>
</form>