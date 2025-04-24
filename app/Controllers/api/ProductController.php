<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';

class ProductController extends ProductsModel
{
    private $products;
    private $response = [];

    public function show($params)
    {
        $filter = '';
        if (isset($params['filter'])) {
            $filter = $params['filter'];
        }


        if (isset($params['category'])) {
            $selectedCategory = $params['category'];
            if ($selectedCategory === 'All') {
                $this->getProducts($filter);
            } else if ($selectedCategory === 'Popular') {
                $this->getPopularProducts($filter);
            } else {
                $this->getProductsByCategory($selectedCategory, $filter);
                if (isset($response['status']) && $response['status'] === 'error') {
                    echo "Fel vid hämtning av produkter för kategorin: " . htmlspecialchars($selectedCategory);
                    return;
                }
            }
        } else {
            $this->getProducts($filter);
        }

        dataView('Products.view.php', $this->response);
    }

    public function showSingle($params)
    {
        if (isset($params['id'])) {
            $productId = $params['id'];
            $this->getSingleProduct($productId);
            dataView('ProductDetails.view.php', $this->response);
        } else {
            require view('404.view.php');
        }
    }

    public function getSingleProduct($productId)
    {
        $this->products = $this->getSingleProductFromDb($productId);
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

    public function getProducts($filter)
    {
        $this->products = $this->getProductsFromDb($filter);
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

    public function getProductsByCategory($category, $filter)
    {
        $this->products = $this->getProductsByCategoryFromDb($category, $filter);
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

    public function getPopularProducts($filter)
    {
        // $filter = '';
        // if (isset($params['filter'])) {
        //     $filter = $params['filter'];
        // }

        $this->products = $this->getPopularProductsFromDb($filter);
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
        $filter = '';
        if (isset($params['filter'])) {
            $filter = $params['filter'];
        }

        if (isset($params['query'])) {
            $search = $params['query'];
            $this->products = $this->getProductsBySearchFromDb($search, $filter);
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
