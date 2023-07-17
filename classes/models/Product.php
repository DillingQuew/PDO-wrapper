<?php
namespace Models;
include 'classes/database.php';
use database\MyPDO;
class Product extends MyPDO {

    public function __construct() {}
    public static function getAll($withDeleted = false) {
        $query = "SELECT * FROM products";
        if (!$withDeleted)
            $query.=" WHERE deleted_at IS NULL";

        return self::run($query)->fetchAll();
    }
    public static function findById($id) {
        return self::run("SELECT * FROM products WHERE id = ? AND deleted_at IS NULL", [$id])->fetch();
    }
    public static function insert($data) {
        self::run("
        INSERT INTO products 
        (
          category_id,
          title,
          price,
          description,
          sort
        )
        VALUES (?, ?, ?, ?, ?)",
        [
            $data['cat_id'],
            $data['title'],
            $data['price'],
            $data['descr'],
            $data['sort'],
        ]);
        return true;
    }

    public static function update($id, $data) {
        self::run("
        UPDATE products SET
          category_id = :category_id,
          title = :title,
          price = :price ,
          description = :description ,
          sort = :sort,
          updated_at = :updated_at
          WHERE id = :id",
            [
                "id" => $id,
                "category_id" => $data['category_id'],
                "title" => $data['title'],
                "price" => isset($data['price']) ? $data['price'] : 10,
                "description" => isset($data['descr']) ? $data['descr'] : "",
                "sort" => isset($data['sort']) ? $data['sort'] : 1,
                "updated_at" => date('Y-m-d h:i:s'),
            ]);
        return true;
    }
    public static function softDelete($id) {
        self::run("
        UPDATE products SET
        deleted_at = :deleted_at
        WHERE id = :id",
        [
            "id" => $id,
            "deleted_at" => date('Y-m-d h:i:s'),
        ]);
        return true;
    }
    public static function hardDelete($id) {
        self::run("DELETE FROM products WHERE id = ?", [$id]);
    }
}