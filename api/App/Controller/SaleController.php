<?php

namespace App\Controller;

use App\Model\Product;
use App\Model\Tax;


 class SaleController
 {

 	public function addProduct(){


 		try {

 			session_start();

 			if(!isset($_SESSION['n'])){
 				$_SESSION['n'] = 0;
 			}else{
 				$_SESSION['n']++;
 			}

 			$product = new Product();

 			$product->SetId($_GET['id']);
 			$amount = $_GET['amount'];
 			$iten = $product->searchProductById();
 			$impostoTotal = $this->totalDeImpostoDeTipo($iten->type);

 			$iten = array (
 				'name' => $iten->name,
 				'price' => $iten->price,
 				'type' => $iten->description,
 				'amount' => $amount,
 				'totalPrice' => $this->valorTotalProduto($iten->price,$amount),
 				'impostoTotalPorcentagem' => $impostoTotal,
 				'totalImposto' => number_format($this->valorImpostoDeProduto($this->valorTotalProduto($iten->price,$amount),$impostoTotal),2,".",""),
 				);

 			
 			
 			$_SESSION['itens'][$_SESSION['n']] = $iten;
 			

 			

 			$valorCompra = $this->valorTotalVenda($_SESSION['itens']);
 			$valorImpostos = $this->valorTotalImposto($_SESSION['itens']);
 			$porcentagem = $this->calcularPorcentagemDeImposto($valorCompra,$valorImpostos);

 			$lista = array(
 				"totalCompra" => number_format($valorCompra,2,".",""),
 				"totalImpostos" => number_format($valorImpostos,2,".",""),
 				"porcentagem" => number_format($porcentagem,2,".",""),
 				"itens" => $_SESSION['itens'],
 			);
 			


 			return $this->transformaArrayEmObjeto($lista);
 			
 			
 		} catch (Exception $e) { 

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	}

 	public function productList(){


 		try {

 			if(isset( $_SESSION )){
 				session_destroy();
 				unset($_SESSION['itens']);
 				$_SESSION['itens'] = array();
 				$_SESSION['marq'] = 0; 				 				
 			}
 			session_start();
 			session_destroy();

 			$products = Product::listProducts();
 			return $products;
 			
 		} catch (Exception $e) { 

 			return array('data' => $e->getMessage(), 'status' => 'error');
 		}


 	} 

 	public function transformaArrayEmObjeto($listaItens){

 		$lista = new \stdClass();
 		foreach ($listaItens as $key => $value)
		{
		    $lista->$key = $value;
		}
 		return $lista;
 	} 


 	public function totalDeImpostoDeTipo($tipo){

 		try {

 			$tax = new Tax();

 			$tax->SetId_type($tipo);
 			return $tax->totalTaxBytype();

 			
 			
 		} catch (Exception $e) { 

 			return 0;
 		}

 	}

 	public function valorTotalProduto($preco,$quantidade){
 		return $preco * $quantidade;
 	}


 	public function valorImpostoDeProduto($precoTotal,$impostoGeral){
 		$imposto = ($precoTotal / 100 * $impostoGeral);
 		return $imposto;
 	}

 	public function valorTotalVenda($itens){
 		$valorTotal = 0;
 		foreach ($itens as $dadosIten) {
			  $valorTotal += $dadosIten['totalPrice'];
		}
		return $valorTotal;
 	}

 	public function valorTotalImposto($itens){
 		$valorTotal = 0;
 		foreach ($itens as $dadosIten) {
			  $valorTotal += $dadosIten['totalImposto'];
		}
		return $valorTotal;
 	}

 	public function calcularPorcentagemDeImposto($valorCompra,$valorImpostos){ 		
 		$porcentagem = ( 100 * $valorImpostos ) / $valorCompra;
 		return number_format($porcentagem,2,".","");
 	}

 	

 	


 }