<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/CartModel.php';

class CheckoutController
{
    public function showStripe()
    {
        // STEG 1: 
        // kolla om användaren är inloggad eller inte

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_SESSION['userid'])) {
            $user_id = $_SESSION['userid'];
        } else {
            dataView("404.view.php", []);
        }

        // STEG 2: 
        // Hämta cartItems 

        $cartModel = new CartModel();
        $cart = $cartModel->getCartItems($user_id);

        // STEG 3: 
        // skapa en stripe session 

        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        $lineitems = [];
        foreach ($cart as $cartItem) {
            array_push($lineitems, [
                "quantity" => $cartItem['quantity'],
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => $cartItem['price'] * 100,
                    "product_data" => [
                        "name" => $cartItem['name']
                    ]
                ]

            ]);
        }

        // STEG 4: 
        // skicka till stripe

        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/plnt/checkout/success",
            "cancel_url" => "http://localhost/plnt/cart",
            "locale" => "auto",
            "line_items" => $lineitems
        ]);

        http_response_code(303);
        header("Location: " . $checkout_session->url);
    }

    public function showSuccess()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_SESSION['userid'])) {
            dataView("SuccessfullCheckout.view.php", []);
        } else {
            dataView("404.view.php", []);
        }
    }
}
