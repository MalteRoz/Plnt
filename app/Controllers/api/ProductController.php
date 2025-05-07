<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';

class ProductController extends ProductsModel
{
    private $products;
    private $response = [];

    public function show($params)
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $filter = $params['filter'] ?? null;

        if (isset($params['category'])) {
            $selectedCategory = $params['category'];
            if ($selectedCategory === 'All') {
                $this->getProducts($filter, $limit, $offset, $page);
            } else if ($selectedCategory === 'Popular') {
                $this->getPopularProducts($filter, $limit, $offset, $page);
            } else {
                $this->getProductsByCategory($selectedCategory, $filter, $limit, $offset, $page);
                if (isset($response['status']) && $response['status'] === 'error') {
                    echo "Fel vid hämtning av produkter för kategorin: " . htmlspecialchars($selectedCategory);
                    return;
                }
            }
        } else {
            $this->getProducts($filter, $limit, $offset, $page);
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

    public function getProducts($filter, $limit, $offset, $page)
    {
        $this->products = $this->getProductsFromDb($filter, $limit, $offset);
        $totalProducts = $this->getTotalProductCount('all');

        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            // echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        $this->response['pagination'] = [
            'currentPage' => $page,
            'totalPages' => ceil($totalProducts / $limit),
            'total' => $totalProducts,
            'perPage' => $limit
        ];
        return $this->response;
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

    public function getProductsByCategory($category, $filter, $limit, $offset, $page)
    {
        $this->products = $this->getProductsByCategoryFromDb($category, $filter, $limit, $offset);
        $totalProducts = $this->getTotalProductCount('category', $category);

        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            // echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        $this->response['pagination'] = [
            'currentPage' => $page,
            'totalPages' => ceil($totalProducts / $limit),
            'total' => $totalProducts,
            'perPage' => $limit
        ];
        return $this->response;
    }

    public function getPopularProducts($filter, $limit, $offset, $page)
    {
        $this->products = $this->getPopularProductsFromDb($filter, $limit, $offset);
        $totalProducts = $this->getTotalProductCount('popular');

        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            // echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        $this->response['pagination'] = [
            'currentPage' => $page,
            'totalPages' => ceil($totalProducts / $limit),
            'total' => $totalProducts,
            'perPage' => $limit
        ];
        return $this->response;
    }

    public function handleProductSearch($params)
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $filter = '';
        if (isset($params['filter'])) {
            $filter = $params['filter'];
        }

        if (isset($params['query'])) {
            $search = $params['query'];
            $this->products = $this->getProductsBySearchFromDb($search, $filter, $limit, $offset);
            $totalProducts = $this->getTotalProductCount('category', $search);
            if (empty($this->products)) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'No products matching search';
                dataView('Products.view.php', $this->response);
                return;
            }
            $this->response['status'] = 'success';
            $this->response['data'] = $this->products;
            $this->response['pagination'] = [
                'currentPage' => $page,
                'totalPages' => ceil($totalProducts / $limit),
                'total' => $totalProducts,
                'perPage' => $limit
            ];
            dataView('Products.view.php', $this->response);
        } else {
            dataView('Products.view.php', []);
        }
    }
}
