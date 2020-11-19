<?php

namespace App\Controller;

use App\Model\Type;



 class TypeController
 {

 	public function list(){


 		try {

 			$products = Type::listTypes();
 			return $products;
 			
 		} catch (Exception $e) { 

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}
 	
 	public function search(){


 		try {

 			$type = new Type();

			$type->SetId($_GET['id']);
			return $type->searchTypeById();

 			
 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}

 	public function save(){

 		try {

 			$type = new Type();

 			$type->SetDescription($_POST['description']);

 			if($_POST['id']){
 				$type->SetId($_POST['id']);
 				return $type->updateType();
 			}

 			return $type->registerType();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}

 	}

 	public function delete(){

 		try {

 			$type = new Type();
 			$type->SetId($_POST['id']);
 			return $type->deleteType();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}

 	}

 	


 }