<?php
class ProductsModel extends Dbh
{
    protected function getProductsFromDb()
    {

        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getProductsByCategoryFromDb($category)
    {
        try {
            $sql = "SELECT p.*
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE c.name = :category;";
            $stmt = $this->connection()->prepare($sql);

            $stmt->bindParam(':category', $category, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getPopularProductsFromDb()
    {
        try {
            $sql = "SELECT p.*
                    FROM products p
                    ORDER BY p.likes DESC;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getProductsBySearchFromDb($searchTerm)
    {
        try {
            $searchTermWithWildcards = '%' . str_replace('%', '\%', implode(' ', $searchTerm)) . '%';
            $sql = "SELECT p.*
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE p.name LIKE :searchTerm OR c.name LIKE :searchTerm;";
            $stmt = $this->connection()->prepare($sql);

            $stmt->bindParam(':searchTerm', $searchTermWithWildcards, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }
}
