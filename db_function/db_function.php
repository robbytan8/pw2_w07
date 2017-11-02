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
    $arrResult = $stmt->fetch();
    $result = array('id' => $arrResult['id'], 'name' => $arrResult['name']);
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
