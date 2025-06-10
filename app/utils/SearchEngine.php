<?php


require_once("vendor/autoload.php"); // LADDA ALLA DEPENDENCIES FROM VENDOR
// require_once("Models/Product.php"); // LADDA ALLA DEPENDENCIES FROM VENDOR

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// require_once("Models/Database.php"); // LADDA ALLA DEPENDENCIES FROM VENDOR
//  :: en STATIC funktion
$dotenv = Dotenv\Dotenv::createImmutable("."); // . is  current folder for the PAGE
$dotenv->load();




class SearchEngine
{
    private $accessKey = 'CCAEpA_rsL6pFqvx6V8n0A';
    private $secretKey = 'mSS_JDYiDmpnxgG4t1eBWA7bbxSuLw';
    private $url = "https://betasearch.systementor.se";
    private $index_name = "products-24";

    private  $client;

    function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->url,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->accessKey . ':' . $this->secretKey),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    function getDocumentIdOrUndefined(string $webId): ?string
    {
        $query = [
            'query' => [
                'term' => [
                    'webid' => $webId
                ]
            ]
        ];


        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            return $data['hits']['hits'][0]['_id'];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }

    // Integration med tredjepartssystem: REST/JSON, Filer (XML mot Prisjakt) - språk/regelverk att förhålla sig till

    function search(string $query, string $sortCol, string $sortOrder, int $pageNo, int $pageSize)
    {

        $searchTerm = $query . '*';
        $query = [
            'query' => [
                'query_string' => [
                    'query' => $searchTerm,
                ]
            ],
            'from' => ($pageNo - 1) * $pageSize,
            'size' => $pageSize,
            'sort' =>  [
                $sortCol => [
                    'order' => $sortOrder
                ]
            ],
            'aggs' => [
                'facets' => [
                    'nested' => [
                        'path' => 'string_facet',

                    ],
                    'aggs' => [
                        'names' => [
                            'terms' => [
                                'field' => 'string_facet.facet_name',
                                'size' => 6
                            ],
                            'aggs' => [
                                'values' => [
                                    'terms' => [
                                        'field' => 'string_facet.facet_value',
                                        'size' => 6
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        try {
            // echo json_encode($query, JSON_PRETTY_PRINT);
            // die();
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            $pages = ceil($data["hits"]["total"]["value"] / $pageSize);

            return  [
                "data" => $data["hits"]["hits"],
                "num_pages" => $pages,
                "aggregations" => $data["aggregations"]["facets"]['names']['buckets']
            ];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }


    // function convertSearchEngineArrayToProduct($searchengineResults)
    // {
    //     $newarray = [];
    //     foreach ($searchengineResults as $hit) {
    //         // echo "MUUU";
    //         // var_dump($hit);
    //         $prod = new Product();
    //         $prod->searchengineid = $hit["_id"];
    //         $prod->id = $hit["_source"]["webid"];
    //         $prod->title = $hit["_source"]["title"];
    //         $prod->description = $hit["_source"]["description"];
    //         $prod->price = $hit["_source"]["price"];
    //         $prod->categoryName = $hit["_source"]["categoryName"];
    //         $prod->categoryId = $hit["_source"]["categoryId"];
    //         $prod->color = $hit["_source"]["color"];
    //         $prod->stockLevel = $hit["_source"]["color"];

    //         array_push($newarray, $prod);
    //     }
    //     return $newarray;
    // }



    // $res = search("cov*",$accessKey,$secretKey,$url,$index_name);
    // //var_dump(count($res["hits"]["hits"]));
    // for($i =0 ; $i < count($res["hits"]["hits"]); $i++){
    //     $hit = $res["hits"]["hits"][$i];
    // //    var_dump($hit);
    //     echo $hit["_id"] . ","; 
    //     echo $hit["_source"]["webid"] . ","; 
    //     echo $hit["_source"]["title"] . ","; 
    //     echo $hit["_source"]["price"] . "</br>"; 
    // }



}





// $res = getDocumentIdOrUndefined(1,$accessKey,$secretKey,$url,$index_name);
// if ($res == null){
//     die("INGET");
// }else{
// }