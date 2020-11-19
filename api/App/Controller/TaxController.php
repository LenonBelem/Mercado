<?php

namespace App\Controller;

use App\Model\Tax;



 class TaxController
 {

 	public function list(){


 		try {

 			
 			$taxs = Tax::listTaxs();
 			return $taxs;
 			
 		} catch (Exception $e) { 

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}

 	
 	public function search(){


 		try {

 			$tax = new Tax();

 			$tax->SetId($_GET['id']);
 			return $tax->searchTaxtById();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}

 	public function save(){

 		try {

 			$tax = new Tax();

 			$tax->SetDescription($_POST['description']);
 			$tax->SetId_type(intval($_POST['id_type']));
 			$tax->SetTax($_POST['tax']);

 			if($_POST['id']){
 				$tax->SetId($_POST['id']);
 				return $tax->updateTax();
 			}

 			return $tax->registerTax();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');

 		}

 	}

 	public function delete(){

 		try {

 			$tax = new Tax();
 			$tax->SetId($_POST['id']);
 			return $tax->deleteTax();

 			
 		} catch (Exception $e) { 	

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}

 	}

 	


 }