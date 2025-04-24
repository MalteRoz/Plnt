<?php
class ProductsModel extends Dbh
{
    protected function getProductsFromDb($filter)
    {

        try {
            // $allowedFilters = ['name', 'price', 'created_at']; // Lista på tillåtna kolumner att sortera efter
            $sql = "SELECT * FROM products";

            if (isset($filter) && $filter !== null) {
                $filter = $this->checkFilter($filter);
                $sql .= " ORDER BY " . $filter;
            }

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getSingleProductFromDb($productId)
    {
        try {
            $sql = "SELECT * FROM products Where :productId = id;";
            $stmt = $this->connection()->prepare($sql);

            $stmt->bindParam(':productId', $productId, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getProductsByCategoryFromDb($category, $filter)
    {
        try {
            $sql = "SELECT p.*
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE c.name = :category";

            if (isset($filter) && $filter !== null) {
                $filter = $this->checkFilter($filter);
                $sql .= " ORDER BY " . $filter;
            }

            $stmt = $this->connection()->prepare($sql);

            $stmt->bindParam(':category', $category, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getPopularProductsFromDb($filter)
    {
        try {
            $sql = "SELECT * FROM products ORDER BY likes DESC LIMIT 12";

            if (isset($filter) && $filter !== null) {
                if ($filter = $this->checkFilter($filter)) {
                    $sql = "SELECT * FROM (
                                SELECT * FROM products
                                ORDER BY likes DESC
                                LIMIT 12
                            ) AS popular
                            ORDER BY $filter";
                }
            }

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getProductsBySearchFromDb($searchTerm, $filter)
    {
        try {
            $sql = "SELECT p.*
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE p.name LIKE :searchTerm OR c.name LIKE :searchTerm";

            if (isset($filter) && $filter !== null) {
                $filter = $this->checkFilter($filter);
                $sql .= " ORDER BY " . $filter;
            }

            $searchTerm = '%' . $searchTerm . '%';

            $stmt = $this->connection()->prepare($sql);

            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function checkFilter($filter)
    {
        switch ($filter) {
            case 'Lowest Price':
                $filter = 'price ASC;';
                break;
            case 'Highest Price':
                $filter = 'price DESC;';
                break;
            case 'Name ASC':
                $filter = 'name ASC;';
                break;
            case 'Name DESC':
                $filter = 'name DESC;';
                break;
            default:
                $filter = 'Rand();';
                break;
        }

        return $filter;
    }

    protected function checkFilterV2($filter)
    {
        $map = [
            'Lowest Price' => 'price ASC',
            'Highest Price' => 'price DESC',
            'Name ASC' => 'name ASC',
            'Name DESC' => 'name DESC',
        ];

        return $map[$filter] ?? 'Rand()';
    }
}
