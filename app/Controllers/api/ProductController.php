<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';

class ProductController extends ProductsModel
{
    private $products;
    private $response = [];

    public function show($params)
    {
        $controller = new ProductController();

        if (isset($params['category'])) {
            $selectedCategory = $params['category'];

            if ($selectedCategory === 'All') {
                $response = $controller->getProducts();
                if (isset($response['data'])) {
                    $this->products = $response['data'];
                }
            } else if ($selectedCategory === 'Popular') {
                $response = $controller->getPopularProducts();
                if (isset($response['data'])) {
                    $this->products = $response['data'];
                }
            } else {
                $response = $controller->getProductsByCategory($selectedCategory);
                if (isset($response['data'])) {
                    $this->products = $response['data'];
                } else {
                    echo "Fel vid hämtning av produkter för kategorin: " . htmlspecialchars($selectedCategory);
                }
            }
        } else {
            $response = $controller->getProducts();
            if (isset($response['data'])) {
                $this->products = $response['data'];
            }
        }

        dataView('Products.view.php', $this->products);
    }

    public function getProducts()
    {
        $this->products = $this->getProductsFromDb();
        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        return $this->response;
    }

    public function getProductsByCategory($category)
    {
        $this->products = $this->getProductsByCategoryFromDb($category);
        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        return $this->response;
    }

    public function getPopularProducts()
    {
        $this->products = $this->getPopularProductsFromDb();
        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        return $this->response;
    }
}
