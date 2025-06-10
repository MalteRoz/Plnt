<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/utils/SearchEngine.php';

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

        $filter = '';
        if (isset($params['filter'])) {
            $filter = $params['filter'];
        }

        if (isset($params['query'])) {
            $search = $params['query'];

            if (empty($filter)) {
                $sortField = '_score';
                $sortOrder = 'desc';
            } else {
                switch ($filter) {
                    case 'Lowest Price':
                        $sortField = 'price';
                        $sortOrder = 'asc';
                        break;
                    case 'Highest Price':
                        $sortField = 'price';
                        $sortOrder = 'desc';
                        break;
                    case 'Name desc':
                        $sortField = 'name_keyword';
                        $sortOrder = 'asc';
                        break;
                    case 'Name asc':
                        $sortField = 'name_keyword';
                        $sortOrder = 'desc';
                        break;
                    default:
                        $sortField = '_score';
                        $sortOrder = 'desc';
                        break;
                }
            }


            $searchEngine = new SearchEngine();
            $searchResults = $searchEngine->search(
                $search,
                $sortField,
                $sortOrder,
                $page,
                $limit
            );

            if ($searchResults === null || empty($searchResults['data'])) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'No products matching search';
                dataView('Products.view.php', $this->response);
                return;
            }

            $formattedProducts = array_map(function ($hit) {
                return [
                    'id' => $hit['_source']['webid'],
                    'name' => $hit['_source']['name'],
                    'description' => $hit['_source']['desription'],
                    'price' => $hit['_source']['price'],
                    'image_url' => $hit['_source']['image_url'],
                    'stock' => $hit['_source']['stock'],
                    'environment' => $hit['_source']['enviroment'],
                    'temperature' => $hit['_source']['temperature'],
                    'height' => $hit['_source']['height'],
                    'watering' => $hit['_source']['watetring'],
                    'category_id' => $hit['_source']['category_id'],
                    'likes' => $hit['_source']['likes']
                ];
            }, $searchResults['data']);

            $this->response['status'] = 'success';
            $this->response['data'] = $formattedProducts;
            $this->response['pagination'] = [
                'currentPage' => $page,
                'totalPages' => $searchResults['num_pages'],
                'total' => count($searchResults['data']),
                'perPage' => $limit
            ];

            dataView('Products.view.php', $this->response);
        } else {
            dataView('Products.view.php', []);
        }
    }
}
