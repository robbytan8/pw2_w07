<?php

function getAllCategoryFromDb() {
    $link = PDOUtil::createPDOConnection();
    $query = "SELECT * FROM category";
    $result = $link->query($query);
    PDOUtil::closePDOConnection($link);
    return $result;
}

function getCategoryFromDb($id) {
    $link = PDOUtil::createPDOConnection();
    $query = "SELECT * FROM category WHERE id = ? LIMIT 1";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    PDOUtil::closePDOConnection($link);
    return $result;
}

function addNewCategory($name) {
    $link = PDOUtil::createPDOConnection();
    $query = "INSERT INTO category(name) VALUES(?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    PDOUtil::closePDOConnection($link);
}

function deleteCategory($id) {
    $link = PDOUtil::createPDOConnection();
    $query = "DELETE FROM category WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    PDOUtil::closePDOConnection($link);
}

function updateCategory($id, $name) {
    $link = PDOUtil::createPDOConnection();
    $query = "UPDATE category SET name = ? WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $id, PDO::PARAM_INT);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    PDOUtil::closePDOConnection($link);
}

function login($email, $password) {
    $link = PDOUtil::createPDOConnection();
    $query = "SELECT u.name, r.name AS role_name FROM user u JOIN role r WHERE u.email = ? AND u.password = PASSWORD(?) LIMIT 1";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    $arrResult = $stmt->fetch();
    $result = array('name' => $arrResult['name'], 'role' => $arrResult['role_name']);
    PDOUtil::closePDOConnection($link);
    return $result;
}

// <editor-fold defaultstate="collapsed" desc="Book Function">
function getAllBook() {
    $link = PDOUtil::createPDOConnection();
    $query = 'SELECT * FROM book b JOIN category c ON c.id = b.category_id';
    $result = $link->query($query);
    PDOUtil::closePDOConnection($link);
    return $result;
}

function getOneBook($isbn) {
    $link = PDOUtil::createPDOConnection();
    $query = 'SELECT * FROM book WHERE isbn = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $isbn, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    PDOUtil::closePDOConnection($link);
    return $result;
}

function addNewBook($isbn, $title, $author, $publisher, $publishYear, $category,
        $cover = NULL) {
    $link = PDOUtil::createPDOConnection();
    if (isset($cover)) {
        $query = 'INSERT INTO book(isbn, title, author, publisher, publish_year, category_id, cover) VALUES (?, ?, ?, ?, ?, ?, ?)';
    }
    $query = 'INSERT INTO book(isbn, title, author, publisher, publish_year, category_id) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $isbn, PDO::PARAM_STR);
    $stmt->bindParam(2, $title, PDO::PARAM_STR);
    $stmt->bindParam(3, $author, PDO::PARAM_STR);
    $stmt->bindParam(4, $publisher, PDO::PARAM_STR);
    $stmt->bindParam(5, $publishYear, PDO::PARAM_STR);
    $stmt->bindParam(6, $category, PDO::PARAM_INT);
    if (isset($cover)) {
        $stmt->bindParam(7, $cover, PDO::PARAM_STR);
    }
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    PDOUtil::closePDOConnection($link);
}

function updateBook($isbn, $title, $author, $publisher, $publishYear, $category,
        $cover = NULL) {
    $link = PDOUtil::createPDOConnection();
    if (isset($cover)) {
        $query = 'UPDATE book SET title = ?, author = ?, publisher = ?, publish_year = ?, category_id = ?, cover = ? WHERE isbn = ?';
    }
    $query = 'UPDATE book SET title = ?, author = ?, publisher = ?, publish_year = ?, category_id = ? WHERE isbn = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $author, PDO::PARAM_STR);
    $stmt->bindParam(3, $publisher, PDO::PARAM_STR);
    $stmt->bindParam(4, $publishYear, PDO::PARAM_STR);
    $stmt->bindParam(5, $category, PDO::PARAM_INT);
    if (isset($cover)) {
        $stmt->bindParam(6, $cover, PDO::PARAM_STR);
        $stmt->bindParam(7, $isbn, PDO::PARAM_STR);
    }
    $stmt->bindParam(6, $isbn, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    PDOUtil::closePDOConnection($link);
}

// </editor-fold>
