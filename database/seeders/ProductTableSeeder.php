<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            ['product_name' => 'Icon Fleece Hoodie', 'brief_description' => 'Gym warm-up essential', 'description' => 'Product code: 530979', 'price' => 30.00, 'category_id' => 1, 'stock_quantity' => 24, 'image_url' => 'https://www.bobssportschalet.com/prodimages/8391-MIDNIGHT_NVY~GRPHITE-l.jpg', 'rating' => 4.0,],
            ['product_name' => 'Baselayer T-Shirt Mens', 'brief_description' => 'Slim fit', 'description' => 'Expertly made from a polyester blend this super soft, super stretchy T-Shirt.', 'price' => 9.99, 'category_id' => 1, 'stock_quantity' => 19, 'image_url' => 'https://i5.walmartimages.com/asr/00530c28-7358-4414-8001-c2bcd5d34f0d_1.d2c9647fe3834c362dacce4798c33d93.jpeg', 'rating' => 3.0,],
            ['product_name' => '8 Inch Woven Short Mens', 'brief_description' => 'Light, airy', 'description' => 'Made from high-quality, 100% polyester mesh, these shorts feature EverDri™ sweat', 'price' => 14.99, 'category_id' => 1, 'stock_quantity' => 16, 'image_url' => 'https://www.tennisnuts.com/images/product/full/WRA761605_SS18_Competition_M_UWII_Woven_8_Short_Mens_Turbulence_BurnOrange_Back.jpg', 'rating' => 2.5,],
            ['product_name' => 'essential Track Joggers Mens', 'brief_description' => 'Lightweight, breathable', 'description' => 'Start your journey in fitness with quality and comfort', 'price' => 19.99, 'category_id' => 1, 'stock_quantity' => 13, 'image_url' => 'https://www.sportsdirect.com/images/imgzoom/51/51280603_xxl_a1.jpg', 'rating' => 5.0,],
            ['product_name' => 'Run Falcon 3 Mens Trainers', 'brief_description' => 'Lightweight, durable', 'description' => 'Train with clouds on your feet', 'price' => 49.99, 'category_id' => 1, 'stock_quantity' => 8, 'image_url' => 'https://www.sportsdirect.com/images/imgzoom/12/12460902_xxl_a2.jpg', 'rating' => 4.5,],




            ['product_name' => 'Core High rise leggings', 'brief_description' => 'Seamless fit', 'description' => 'Seamless technology is the future of fitness wear, and these USA Pro Core High R', 'price' => 29.99, 'category_id' => 2, 'stock_quantity' => 14, 'image_url' => 'https://th.bing.com/th/id/OIP.vNOPG_2caeTlcfsonotsjAHaJf?w=157&h=201&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'rating' => 5.0,],
            ['product_name' => 'Core Fitness Jacket', 'brief_description' => 'Warm, trendy', 'description' => 'Stay warm and on-trend with the USA Pro Core fitness jacket', 'price' => 39.99, 'category_id' => 2, 'stock_quantity' => 23, 'image_url' => 'https://th.bing.com/th/id/OIP.gNriLWpmWcm1L9_EM-zzfgHaHa?w=202&h=202&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'rating' => 4.0,],
            ['product_name' => 'Tech Half Zip Top', 'brief_description' => 'Workout ready', 'description' => 'Conquer your next workout with the Under Armour Technical Half Zip Top.', 'price' => 44.99, 'category_id' => 2, 'stock_quantity' => 16, 'image_url' => 'https://th.bing.com/th/id/OIP.PYzIsZW_Fq51K3WFq6BVgAHaHa?w=210&h=210&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'rating' => 3.5,],
            ['product_name' => 'Tech Twist Crew T-Shirt', 'brief_description' => 'Casual, comfy', 'description' => 'This Under Armour Tech Twist T Shirt is crafted with short sleeves.', 'price' => 14.99, 'category_id' => 2, 'stock_quantity' => 11, 'image_url' => 'https://th.bing.com/th/id/OIP.eO0KPEXDxT1ipapHNYMpAgHaKs?w=148&h=213&c=7&r=0&o=5&dpr=1.5&pid=1.7 ', 'rating' => 2.5,],
            ['product_name' => 'Revolution 6 Womens Running Shoes', 'brief_description' => 'Durable, sleek', 'description' => 'The Nike Revolution 6 Womens Running Shoes are a great addition to your daily.', 'price' => 49.99, 'category_id' => 2, 'stock_quantity' => 47, 'image_url' => 'https://th.bing.com/th/id/OIP.hMkD_wnKViw_X5jC6KwgmwHaHa?w=198&h=198&c=7&r=0&o=5&dpr=1.5&pid=1.7 ', 'rating' => 4.0,],

            ['product_name' => 'Adizero Adios Pro 3 Mens Running Shoes', 'brief_description' => 'Lightweight, durable', 'description' => 'Color: Green Spark', 'price' => 219.99, 'category_id' => 3, 'stock_quantity' => 14, 'image_url' => 'https://images.prodirectsport.com/productimages/Main/267309_Main_Thumb_1215543.jpg', 'rating' => 5.0,],
            ['product_name' => 'Adizero Boston 12 Womens Running Shoes', 'brief_description' => 'Gym warm up essential', 'description' => 'Colour: White/Green', 'price' => 139.99, 'category_id' => 3, 'stock_quantity' => 24, 'image_url' => 'https://photo1.i-run.fr/adidas-adizero-adios-pro-3-m-chaussures-homme-586842-1-sz.jpg', 'rating' => 4.5,],
            ['product_name' => 'Terrex Agravic Gore Tex Mens Trail Running Shoes', 'brief_description' => 'Sleek, durable', 'description' => 'Colour:  Lime/Ftwr White', 'price' => 49.99, 'category_id' => 3, 'stock_quantity' => 19, 'image_url' => 'https://th.bing.com/th/id/OIP.hEyyjU4dbsdWRmMtkGSsAQHaDb?rs=1&pid=ImgDetMain', 'rating' => 3.0,],
            ['product_name' => 'Tracefinder Trail Running Shoes Women', 'brief_description' => 'Cardio essential', 'description' => 'Colour: Black/Grey/Mint', 'price' => 30.00, 'category_id' => 3, 'stock_quantity' => 18, 'image_url' => 'https://assets.adidas.com/images/w_600,f_auto,q_auto/aa3ce52af40143959846ae0b00fcd498_9366/Tracefinder_Trail_Running_Shoes_Black_Q47239_42_detail.jpg', 'rating' => 3.5,],
            ['product_name' => 'upernova Stride Mens Running Shoes', 'brief_description' => 'Lightweight, durable', 'description' => 'Color: Blue', 'price' => 89.99, 'category_id' => 3, 'stock_quantity' => 17, 'image_url' => 'https://cdna.lystit.com/photos/amazon-prime/99bd4abd/adidas-NavySilverBlack-Supernova-Running-Shoe.jpeg ', 'rating' => 3.0,],

            ['product_name' => 'Pro Jumpman Snapback Hat', 'brief_description' => 'Iconic, trendy', 'description' => 'Color: Black', 'price' => 14.99, 'category_id' => 4, 'stock_quantity' => 39, 'image_url' => 'ttps://c.static-nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/ilnzrqiafjmxbqhomptg/jordan-pro-jumpman-snapback-hat-KbPBND.jpg ', 'rating' => 4.0,],
            ['product_name' => 'Twist Beanie Sn99', 'brief_description' => 'trendy, cold-resistant', 'description' => 'Color: Grey', 'price' => 9.99, 'category_id' => 4, 'stock_quantity' => 16, 'image_url' => 'https://www.houseoffraser.co.uk/images/products/90679102_l.jpg ', 'rating' => 2.0,],
            ['product_name' => 'Miler Running Gloves Mens', 'brief_description' => 'trendy, cold-resistant', 'description' => 'Color: Black', 'price' => 19.99, 'category_id' => 4, 'stock_quantity' => 17, 'image_url' => 'https://www.sportsdirect.com/images/imgzoom/76/76550803_xxl.jpg ', 'rating' => 4.0,],
            ['product_name' => 'Undeniable 5.0 Duffle XS', 'brief_description' => 'lightweight, water-resistant', 'description' => 'Color: Blue', 'price' => 19.99, 'category_id' => 4, 'stock_quantity' => 10, 'image_url' => 'https://underarmour.scene7.com/is/image/Underarmour/1369221-001_SLF_SL?rp=standard-0pad|pdpMainDesktop&scl=1&fmt=jpg&qlt=85&resMode=sharp2&cache=on%2Con&bgc=F0F0F0&wid=566&hei=708&size=566%2C708 ', 'rating' => 5.0,],
            ['product_name' => 'Sport Water Bottle', 'brief_description' => 'Shock-resistant, durable', 'description' => 'Branded Water Bottles and Travel Cups are the perfect motivation item', 'price' => 18.99, 'category_id' => 4, 'stock_quantity' => 24, 'image_url' => 'https://podium4sport.com/wp-content/uploads/2018/02/tr601r_precision_single_water_bottle_blue.jpg ', 'rating' => 3.5,],


            // Continue adding other products in the same format
            ['product_name' => 'Caffeine 200mg 120 Tablets', 'brief_description' => 'Pre-gym energy', 'description' => 'SUPPORTS ENERGY, FOCUS & ALERTNESS', 'price' => 19.99, 'category_id' => 5, 'stock_quantity' => 17, 'image_url' => 'https://www.freshhealthnutrition.com/images/764442672996.jpg', 'rating' => 1.0,],
            ['product_name' => 'STIM-FREE PRE WORKOUT SUPPLEMENT', 'brief_description' => 'Gym power boost', 'description' => 'PreSeries STIM-FREE is a stimulant-free pre-workout supplement.', 'price' => 49.99, 'category_id' => 5, 'stock_quantity' => 18, 'image_url' => 'https://storage.googleapis.com/esupp-cdn/wp-content/uploads/2021/02/fc0b8721-b08wvf1w2n.main_.jpg ', 'rating' => 3.0,],
            ['product_name' => 'Performance Protein – Vegan Protein Powder', 'brief_description' => 'Post-gym recovery', 'description' => 'Performance is the perfect post-workout vegan protein powder.', 'price' => 19.99, 'category_id' => 5, 'stock_quantity' => 17, 'image_url' => 'https://th.bing.com/th/id/OIP.JVtHG2gMLBFrRx6urB5OXwHaKX?rs=1&pid=ImgDetMain', 'rating' => 3.5,],
            ['product_name' => 'Creatine Monohydrate Gummies 5000mg', 'brief_description' => 'Gym strength enhancer', 'description' => 'Boost your workout performance with our Creatine Gummies', 'price' => 24.99, 'category_id' => 5, 'stock_quantity' => 16, 'image_url' => ' https://i5.walmartimages.com/asr/13c0c08c-e7fa-409a-bb2a-b732e6d30fca.43a0f8fc589a86bb807d3d0a573cc39a.jpeg?odnHeight=612&odnWidth=612&odnBg=FFFFFF', 'rating' => 2.5,],
            ['product_name' => 'PROMIX NUTRITION', 'brief_description' => 'Gym superfood fuel', 'description' => 'Elevate your workout experience with this superfood blend', 'price' => 24.99, 'category_id' => 5, 'stock_quantity' => 14, 'image_url' => 'https://i5.walmartimages.com/asr/e1c3d9af-62df-444a-92bd-72d9a20e896a_1.a60b2b3c9c90c6629b94bb4e281138f5.png?odnWidth=1000&odnHeight=1000&odnBg=ffffff ', 'rating' => 4.0,],

        ]);
    }
}
