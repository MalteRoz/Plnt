<?php
class ProductsModel extends Dbh
{
    protected function getProductsFromDb($filter, $limit, $offset)
    {
        try {
            $sql = "SELECT * FROM products";

            if (!empty($filter)) {
                $filter = $this->checkFilterV2($filter);
                $sql .= " ORDER BY $filter";
            }

            $sql .= " LIMIT :limit OFFSET :offset";

            $stmt = $this->connection()->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
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

    protected function getProductsByCategoryFromDb($category, $filter, $limit, $offset)
    {
        try {
            $sql = "SELECT p.*
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE c.name = :category";

            if (!empty($filter)) {
                $filter = $this->checkFilterV2($filter);
                $sql .= " ORDER BY " . $filter;
            }

            $sql .= " LIMIT :limit OFFSET :offset";

            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getPopularProductsFromDb($filter, $limit, $offset)
    {
        try {
            $likesThreshold = 200;

            $sql = "SELECT * FROM products WHERE likes >= :likesThreshold ORDER BY likes DESC LIMIT :limit OFFSET :offset";

            if (!empty($filter)) {
                $filter = $this->checkFilterV2($filter);
                $innerSql = "SELECT * FROM products WHERE likes >= :likesThreshold ORDER BY likes DESC LIMIT 6";
                $sql = "SELECT * FROM ($innerSql) AS popular ORDER BY $filter LIMIT :limit OFFSET :offset";
            }

            $stmt = $this->connection()->prepare($sql);

            $stmt->bindValue(':likesThreshold', $likesThreshold, PDO::PARAM_INT);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getProductsBySearchFromDb($searchTerm, $filter, $limit, $offset)
    {
        try {
            $sql = "SELECT p.*
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE p.name LIKE :searchTerm OR c.name LIKE :searchTerm";

            if (!empty($filter)) {
                $filter = $this->checkFilterV2($filter);
                $sql .= " ORDER BY " . $filter;
            }

            $searchTerm = '%' . $searchTerm . '%';

            $sql .= " LIMIT :limit OFFSET :offset";

            $stmt = $this->connection()->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Ett fel inträffade vid hämtning av produkter. Försök igen senare.");
        }
    }

    protected function getTotalProductCount($type = 'all', $value = null)
    {
        $sql = "SELECT COUNT(*) FROM products p";

        switch ($type) {
            case 'category':
                $sql .= " JOIN categories c ON p.category_id = c.id WHERE c.name = :value";
                break;
            case 'search':
                $sql .= " JOIN categories c ON p.category_id = c.id WHERE p.name LIKE :searchTerm OR c.name LIKE :searchTerm";
                break;
            case 'popular':
                $sql .= " WHERE p.likes >= :likesThreshold";
                break;
            case 'all':
            default:
                break;
        }

        $stmt = $this->connection()->prepare($sql);

        if ($type === 'search') {
            $searchTerm = '%' . $value . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }

        if ($type === 'category') {
            $stmt->bindValue(':value', $value, PDO::PARAM_STR);
        }

        if ($type === 'popular') {
            $likesThreshold = 200;
            $stmt->bindValue(':likesThreshold', $likesThreshold, PDO::PARAM_STR);
        }


        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    protected function checkFilterV2($filter)
    {
        $map = [
            'Lowest Price' => 'price ASC',
            'Highest Price' => 'price DESC',
            'Name ASC' => 'name ASC',
            'Name DESC' => 'name DESC',
        ];

        return $map[$filter] ?? 'null';
    }
}
