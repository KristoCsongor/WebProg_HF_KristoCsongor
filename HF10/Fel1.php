<?php

$urlProducts = 'https://fakestoreapi.com/products';
$curl = curl_init($urlProducts);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    $products = json_decode($response, true);
    $productPrices = [];
    if ($products) {
        foreach ($products as $product) {
            $productPrices[] = $product["price"]; // array's index + 1 = $product["id"]
        }
//        print_r($productPrices);
        echo "<br>";
    } else {
        echo "No products found.";
    }
}
curl_close($curl);


$urlCart = 'https://fakestoreapi.com/carts/user/3';
$curl = curl_init($urlCart);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    $carts = json_decode($response, true);

    if ($carts) {
        $sum = 0;
        foreach ($carts as $key => $cart) {
//            echo "key: $key<br>";
            foreach ($cart["products"] as $cartArray) {
//                print_r($cartArray); // productId, quantity
//                echo "<br>";
                $sum += $cartArray["quantity"] * $productPrices[$cartArray["productId"] - 1];
            }
            echo "<br>";
        }
        echo "Sum = $sum";
    } else {
        echo 'No carts found.';
    }
}
curl_close($curl);
