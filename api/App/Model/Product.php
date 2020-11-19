<?php

namespace App\Model;

use App\Database\Connection;

//outras Exceptions
use Exception;
use InvalidArgumentException;

class Product
{
	private $id;
	private $name;
	private $price;
	private $type;
	private $ean;

	public function getId()
	{
	    return $this->id;
	}
	
	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getName()
	{
	    return $this->name;
	}
	
	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getPrice()
	{
	    return $this->price;
	}
	
	public function setPrice($price)
	{
	    $this->price = $price;
	}

	public function getType()
	{
	    return $this->type;
	}
	
	public function setType($type)
	{
	    $this->type = $type;
	}

	public function getEan()
	{
	    return $this->ean;
	}
	
	public function setEan($ean)
	{
	    $this->ean = $ean;
	}

	
	public static function listProducts() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT p.*, description FROM product p Left JOIN type t On p.type = t.id ORDER BY p.id";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$resultado = array();

		while ($row = $stmt->fetchObject()) {
			
			$resultado[] = $row;
		}

		if(!$resultado){
			throw new Exception("Não existem produtos cadastrados");				
		}

		return $resultado;
	}

	public static function listProductsByName() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT id, name FROM product ORDER BY name";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$resultado = array();

		while ($row = $stmt->fetchObject()) {
			
			$resultado[] = $row;
		}

		if(!$resultado){
			throw new Exception("Não existem produtos cadastrados");				
		}

		return $resultado;
	}


	public function searchProductByEan() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT * FROM product WHERE ean = :ean";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":ean",$this->ean);
		$stmt->execute();

		$resultado = "";
		
		while ($row = $stmt->fetchObject()) {
			
			$resultado = $row;
		}

		if(!$resultado){
			throw new Exception("Não existe produto cadastrado com este ean");
		}

		return $resultado;
	}


	public function searchProductById()
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT p.*, description FROM product p Left JOIN type t On p.type = t.id WHERE p.id = :id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id",$this->id);
		$stmt->execute();

		$resultado = "";
		
		while ($row = $stmt->fetchObject()) {
			
			$resultado = $row;
		}

		if(!$resultado){
			throw new Exception("Não existe produto cadastrado com este código");
		}

		return $resultado;
	}


	public function registerProduct() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "INSERT INTO product (name, type, price, ean) VALUES (:name, :type, :price, :ean) ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam('name', $this->name);
		$stmt->bindParam("type",$this->type);
		$stmt->bindParam("price",$this->price);
		$stmt->bindParam("ean",$this->ean);

		if(!$stmt->execute()){
			throw new Exception("Produto não Atualizado");			
		}

		return $this->listProducts();

	}

	public function updateProduct() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "UPDATE product SET name = :name, type = :type, price = :price, ean = :ean WHERE id = :id ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("id",$this->id);
		$stmt->bindParam("name",$this->name);
		$stmt->bindParam("type",$this->type);
		$stmt->bindParam("price",$this->price);
		$stmt->bindParam("ean",$this->ean);

		if(!$stmt->execute()){
			throw new Exception("Produto não Atualizado");			
		}

		return $this->listProducts();

	}

	public function deleteProduct()
	{
		$conn = Connection::getInstance(DB_BANCO);
		
		$sql = "DELETE FROM product WHERE id = :id ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id",$this->id);		

		if(!$stmt->execute()){
			throw new Exception("Produto não Excluído");			
		}

		return $this->listProducts();
	}




}