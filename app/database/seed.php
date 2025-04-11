<?php
require_once 'app/database/dbh.php';


class Seed extends Dbh
{
    public function runSeed()
    {
        $pdo = $this->connection();
        $stmt = $pdo->query("SELECT COUNT(*) FROM products");
        $stmt2 = $pdo->query("SELECT COUNT(*) FROM categories");

        $count = $stmt->fetchColumn();
        $count2 = $stmt2->fetchColumn();

        if ($count > 0 || $count2 > 0) {
            echo "DB already seeded";
            return;
        }

        $this->seedCategories();
        $this->seedProducts();
    }

    public function seedProducts()
    {

        function imgCleaner($img)
        {
            return '/Plnt/public/' . $img;
        }


        $products = [
            [
                'name' => 'Monstera Deliciosa',
                'description' => 'A large, lush Monstera Deliciosa, perfect for adding a tropical vibe to any interior space. Its distinctive split leaves bring a touch of nature indoors, enhancing both contemporary and classic decor styles.',
                'image_url' => imgCleaner("p1.png")
            ],
            [
                'name' => 'Artificial Fern',
                'description' => 'A lifelike artificial fern, offering the beauty of greenery without the need for maintenance. Ideal for adding a touch of nature to any room, this fern stays vibrant and green year-round.',
                'image_url' => imgCleaner("p2.png")
            ],
            [
                'name' => 'Small Green Plant',
                'description' => 'A compact green plant, perfect for adding a natural touch to desks, shelves, or windowsills. Its small size makes it versatile for any space needing a bit of greenery.',
                'image_url' => imgCleaner("p3.png")
            ],
            [
                'name' => 'Small Green Plant',
                'description' => 'A smaller green plant, bringing a fresh and clean aesthetic to any room. Its minimalist design complements various decor styles, making it a versatile addition to your home or office.',
                'image_url' => imgCleaner("p4.png")
            ],
            [
                'name' => 'Ficus Lyrata (Fiddle-Leaf Fig)',
                'description' => 'A stylish Ficus Lyrata with large, striking leaves. This popular interior design element adds a touch of elegance and sophistication to any living space.',
                'image_url' => imgCleaner("p5.png")
            ],
            [
                'name' => 'Banana Plant',
                'description' => 'A decorative banana plant, introducing an exotic flair to your home decor. Its large leaves create a bold statement, perfect for adding a tropical touch.',
                'image_url' => imgCleaner("p6.png")
            ],
            [
                'name' => 'Strelitzia Nicolai',
                'description' => 'A large Strelitzia Nicolai with broad, dramatic leaves, creating a stunning focal point in any room. This plant brings a sense of grandeur and sophistication to your interior design.',
                'image_url' => imgCleaner("p7.png")
            ],
            [
                'name' => 'Banana Plant',
                'description' => 'A smaller banana plant, ideal for compact spaces. This plant adds a touch of tropical charm without overwhelming the room, perfect for smaller apartments or offices.',
                'image_url' => imgCleaner("p8.png")
            ],
            [
                'name' => 'Zamioculcas zamiifolia (ZZ Plant)',
                'description' => 'A resilient Zamioculcas zamiifolia, known for its low maintenance and air-purifying qualities. This plant is perfect for those seeking a stylish yet easy-care addition to their space.',
                'image_url' => imgCleaner("p9.png")
            ],
            [
                'name' => 'Dark Leaf Plant',
                'description' => 'A dark leaf plant, adding a sophisticated and dramatic touch to your interior decor. Its deep, rich foliage creates a focal point, enhancing the elegance of any room.',
                'image_url' => imgCleaner("p10.png")
            ],
            [
                'name' => 'Eucalyptus',
                'description' => 'A decorative eucalyptus plant, bringing a fresh, soothing aroma and a calming presence to your space. Its unique foliage and relaxing scent make it a perfect addition to any home or office.',
                'image_url' => imgCleaner("p11.png")
            ],
            [
                'name' => 'Monstera Deliciosa',
                'description' => 'A smaller Monstera Deliciosa, perfect for adding a touch of greenery to tables or shelves. Its distinctive leaves bring a modern and natural element to any interior design.',
                'image_url' => imgCleaner("p12.png")
            ],
            [
                'name' => 'Small Green Plant',
                'description' => 'A small green plant, adding a modern and elevated touch to your decor. This plant and stand combination is perfect for creating a focal point in any room.',
                'image_url' => imgCleaner("p13.png")
            ],
            [
                'name' => 'Small Green Plant',
                'description' => 'A small green plant, offering a simple and stylish way to add greenery to your space. Its sleek design complements any decor, making it a versatile choice for homes and offices.',
                'image_url' => imgCleaner("p14.png")
            ],
            [
                'name' => 'Small Plant with Patterned Leaves',
                'description' => 'A small plant with beautifully patterned leaves, perfect for adding a pop of color and visual interest to your decor. Its unique foliage makes it a standout piece in any setting.',
                'image_url' => imgCleaner("p15.png")
            ],
            [
                'name' => 'Strelitzia Nicolai',
                'description' => 'A tall Strelitzia Nicolai, creating an impressive and dramatic effect in any room. Its large, striking leaves make it a focal point, enhancing the grandeur of your interior design.',
                'image_url' => imgCleaner("p16.png")
            ],
            [
                'name' => 'Strelitzia Nicolai',
                'description' => 'A Strelitzia Nicolai, adding a modern and airy feel to your space. This combination is perfect for creating a stylish and sophisticated look in any room.',
                'image_url' => imgCleaner("p17.png")
            ],
            [
                'name' => 'Alocasia',
                'description' => 'An Alocasia with large, distinctive leaves, bringing an exotic and modern touch to your decor. Its unique foliage adds a sense of sophistication and style to any interior space.',
                'image_url' => imgCleaner("p18.png")
            ],
            [
                'name' => 'Ficus Elastica (Rubber Plant)',
                'description' => 'A Ficus Elastica with glossy leaves, adding a classic and elegant touch to your decor. Its vibrant foliage and stylish pot make it a standout piece in any room.',
                'image_url' => imgCleaner("p19.png")
            ],
            [
                'name' => 'Banana Plant',
                'description' => 'A banana plant, adding a trendy and relaxed feel to your space. This combination is perfect for creating a stylish and modern look in any interior setting.',
                'image_url' => imgCleaner("p20.png")
            ],
        ];

        foreach ($products as $product) {
            $randomData = $this->generateRandomProductData();

            $name = $product['name'];
            $description = $product['description'];
            $image_url = $product['image_url'];
            $price = $randomData['price'];
            $stock = $randomData['stock'];
            $environment = $randomData['environment'];
            $temperature = $randomData['temperature'];
            $height = $randomData['height'];
            $watering = $randomData['watering'];
            $category_id = $randomData['category_id'];
            $likes = $randomData['likes'];

            $sql = "INSERT INTO products (name, description, price, image_url, stock, environment, temperature, height, watering, category_id, likes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->connection()->prepare($sql);

            if ($stmt->execute([$name, $description, $price, $image_url, $stock, $environment, $temperature, $height, $watering, $category_id, $likes])) {
                echo "Ny produkt skapad: " . $name . "<br>";
            } else {
                echo "Fel vid skapande av produkt: " . $name . "<br>";
            }
        }
    }

    private function generateRandomProductData()
    {
        return [
            'price' => rand(100, 1000) / 10,
            'stock' => rand(0, 100),
            'environment' => ['Sunny', 'Humid'][rand(0, 1)],
            'temperature' => rand(15, 30),
            'height' => rand(20, 150),
            'watering' => ['low', 'moderate', 'high'][rand(0, 2)],
            'category_id' => rand(1, 3),
            'likes' => rand(0, 500)
        ];
    }


    public function seedCategories()
    {
        $categories = [
            ['name' => 'Indoor'],
            ['name' => 'Outdoor'],
            ['name' => 'Low maintance'],
        ];

        foreach ($categories as $category) {
            $sql = "INSERT INTO categories (name) VALUES (?)";
            $stmt = $this->connection()->prepare($sql);
            if ($stmt->execute([$category['name']])) {
                echo "Ny kategori skapad: " . $category['name'] . "<br>";
            } else {
                echo "Fel vid skapande av kategori: " . $category['name'] . "<br>";
            }
        }
    }
}
