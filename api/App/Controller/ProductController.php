<?php

namespace App\Controller;

use App\Model\Product;



 class ProductController
 {

 	public function list(){


 		try {

 			if($_GET['mod'] === 'name'){
 				$products = Product::listProductsByName();
 				return $products;
 			}

 			$products = Product::listProducts();
 			return $products;
 			
 		} catch (Exception $e) { 

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}

 	
 	public function search(){


 		try {

 			$product = new Product();

 			if(isset($_GET['ean'])){

 				$product->SetEan($_GET['ean']);
 				return $product->searchProductByEan();

 			}elseif (isset($_GET['id'])) {

 				$product->SetId($_GET['id']);
 				return $product->searchProductById();

 			}
 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}

 	public function save(){

 		try {

 			$product = new Product();

 			$product->SetName($_POST['name']);
 			$product->SetType(intval($_POST['type']));
 			$product->SetPrice($_POST['price']);
 			$product->SetEan($_POST['ean']);

 			if($_POST['id']){
 				$product->SetId($_POST['id']);
 				return $product->updateProduct();
 			}

 			return $product->registerProduct();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');

 		}

 	}

 	public function delete(){

 		try {

 			$product = new Product();
 			$product->SetId($_POST['id']);
 			return $product->deleteProduct();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}

 	}

 	


 }