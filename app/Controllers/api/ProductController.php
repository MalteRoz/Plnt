<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';

class ProductController extends ProductsModel
{
    private $products;
    private $response = [];

    public function show($params)
    {

        if (isset($params['category'])) {
            $selectedCategory = $params['category'];
            if ($selectedCategory === 'All') {
                $this->getProducts();
            } else if ($selectedCategory === 'Popular') {
                $this->getPopularProducts();
            } else {
                $response = $this->getProductsByCategory($selectedCategory);
                if (isset($response['status']) && $response['status'] === 'error') {
                    echo "Fel vid hämtning av produkter för kategorin: " . htmlspecialchars($selectedCategory);
                    return;
                }
            }
        } else {
            $this->getProducts();
        }

        dataView('Products.view.php', $this->response);
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

    public function handleProductSearch($params)
    {
        if (isset($params['query'])) {
            $this->products = $this->getProductsBySearchFromDb($params);
            if (empty($this->products)) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'No products matching search';
                dataView('Products.view.php', $this->response);
                return;
            }
            $this->response['status'] = 'success';
            $this->response['data'] = $this->products;
            dataView('Products.view.php', $this->response);
        } else {
            dataView('Products.view.php', []);
        }
    }
}
