<?php
class CartModel extends Dbh
{

    protected function getCartItems($user_id)
    {
        try {
            $cart_id = $this->getOrCreateCart($user_id);
            $sql = "SELECT 
                    p.id,
                    p.name,
                    p.price,
                    p.image_url,
                    c.quantity
                    FROM cart_items c
                    INNER JOIN products p ON c.product_id = p.id
                    WHERE c.cart_id = :cart_id;";

            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to add item to cart: ' . $e->getMessage()
            ];
        }
    }

    protected function getCartTotal($user_id)
    {
        $cart_id = $this->getOrCreateCart($user_id);
        $sql = "SELECT SUM(ci.quantity * p.price) AS total_cost
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                WHERE ci.cart_id = :cart_id;
                ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    protected function getTotalCartItems($user_id)
    {
        $cart_id = $this->getOrCreateCart($user_id);
        $sql = "SELECT SUM(quantity) FROM cart_items WHERE cart_id = :cart_id;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    protected function addItem($user_id, $productId, $quantity)
    {
        try {
            $cart_id = $this->getOrCreateCart($user_id);
            $this->addOrUpdateCartItem($cart_id, $productId, $quantity);

            return [
                'success' => true,
                'message' => 'Item added or updated in cart successfully.',
                'cart_id' => $cart_id
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to add item to cart: ' . $e->getMessage()
            ];
        }
    }

    protected function getOrCreateCart($user_id)
    {
        $sql = "SELECT id FROM shopping_carts WHERE customer_id = :user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $cartId = $stmt->fetchColumn();

        if (!$cartId) {
            $sql = "INSERT INTO shopping_carts (customer_id, created_at, updated_at) VALUES (:user_id, NOW(), NOW())";
            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();
            $cartId = $this->connection()->lastInsertId();
        }

        return $cartId;
    }

    protected function addOrUpdateCartItem($cart_id, $productId, $quantity)
    {
        $sql = "SELECT quantity 
            FROM cart_items 
            WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            $newQuantity = $existingItem['quantity'] + $quantity;

            $updateSql = "UPDATE cart_items 
                      SET quantity = :quantity 
                      WHERE cart_id = :cart_id AND product_id = :product_id";

            $updateStmt = $this->connection()->prepare($updateSql);
            $updateStmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
            $updateStmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $updateStmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $updateStmt->execute();
        } else {
            $insertSql = "INSERT INTO cart_items (cart_id, product_id, quantity) 
                      VALUES (:cart_id, :product_id, :quantity)";
            $insertStmt = $this->connection()->prepare($insertSql);
            $insertStmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $insertStmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $insertStmt->execute();
        }
    }

    protected function updateCartItem($productId, $user_id, $action)
    {
        try {
            $cart_id = $this->getOrCreateCart($user_id);
            $sql = "";

            if ($action === 'decrease') {
                $checkSql = "SELECT quantity FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id;";
                $checkStmt = $this->connection()->prepare($checkSql);
                $checkStmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
                $checkStmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
                $checkStmt->execute();

                $item = $checkStmt->fetch(PDO::FETCH_ASSOC);

                if (!$item || $item['quantity'] <= 1) {
                    $action = 'delete';
                }
            }

            switch ($action) {
                case 'increase':
                    $sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE cart_id = :cart_id AND product_id = :product_id;";
                    break;
                case 'decrease':
                    $sql = "UPDATE cart_items SET quantity = quantity - 1 WHERE cart_id = :cart_id AND product_id = :product_id;";
                    break;
                case 'delete':
                    $sql = "DELETE FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id;";
                    break;
                default:
                    break;
            }
            $stmt = $this->connection()->prepare($sql);
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Item added or updated in cart successfully.',
                'cart_id' => $cart_id
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to add item to cart: ' . $e->getMessage()
            ];
        }
    }
}
