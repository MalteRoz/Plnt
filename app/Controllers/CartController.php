<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/CartModel.php';

class CartController extends CartModel
{
    private $cartModel;
    private $session;
    private $products;
    private $response = [];

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->session = session_start();
    }

    public function showCart()
    {
        $this->session;
        $user_id = $_SESSION["userid"];

        $this->products = $this->cartModel->getCartItems($user_id);
        $total = $this->cartModel->getCartTotal($user_id);
        $totalItems = $this->cartModel->getTotalCartItems($user_id);
        $_SESSION['totalItems'] = $totalItems;
        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            $this->response['data'] = [];
            return;
        } else {
            $this->response['status'] = 'success';
            $this->response['data'] = $this->products;
            $this->response['total'] = $total;
        }

        dataView('Cart.view.php', $this->response);
    }

    public function addToCart()
    {
        $this->session;

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION["userid"];

        $response = $this->cartModel->addItem($user_id, $productId, $quantity);

        if ($response) {
            header("Location: /plnt/cart");
            exit;
        } else {
            echo "Fel vid tillägg";
            exit;
        }
    }

    public function updateCart()
    {
        $this->session;

        $action = $_POST['action'];
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION["userid"];

        echo $quantity;

        // if ($action === 'decrease' && $quantity <= 1) {
        //     $action = 'delete';
        // }

        $response = $this->updateCartItem($productId, $user_id, $action);

        if ($response) {
            header("Location: /plnt/cart");
            exit;
        } else {
            echo "Fel vid tillägg";
            exit;
        }
    }
}
