<?php

namespace App\Model;

use App\Database\Connection;

//outras Exceptions
use Exception;
use InvalidArgumentException;

class Tax
{
	private $id;
	private $description;
	private $id_type;
	private $tax;

	public function getId()
	{
	    return $this->id;
	}
	
	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getDescription()
	{
	    return $this->description;
	}
	
	public function setDescription($description)
	{
	    return $this->description = $description;
	}

	public function getId_type()
	{
	    return $this->id_type;
	}
	
	public function setId_type($id_type)
	{
	    return $this->id_type = $id_type;
	}

	public function getTax()
	{
	    return $this->tax;
	}
	
	public function setTax($tax)
	{
	    return $this->tax = $tax;
	}

	
	public static function listTaxs() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT t.*, p.description As typeDescription FROM tax t Left JOIN type p On t.id_type = p.id ORDER BY t.id";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$resultado = array();

		while ($row = $stmt->fetchObject()) {
			
			$resultado[] = $row;
		}

		if(!$resultado){
			throw new Exception("Não existem impostos cadastrados");				
		}

		return $resultado;
	}

	
	public function totalTaxBytype(){

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT SUM(tax) As totaltax FROM tax WHERE id_type = :id_type";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id_type",$this->id_type);
		$stmt->execute();
		$resultado = $stmt->fetchColumn();
		

		if(!$resultado){
			return 0;				
		}

		return $resultado;
	}


	public function searchTaxtById()
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT t.*, p.description As typeDescription FROM tax t Left JOIN type p On t.id_type = p.id WHERE t.id = :id";
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


	public function registerTax() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "INSERT INTO tax (description, id_type, tax) VALUES (:description, :id_type, :tax) ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam('description', $this->description);
		$stmt->bindParam("id_type",$this->id_type);
		$stmt->bindParam("tax",$this->tax);

		if(!$stmt->execute()){
			throw new Exception("Imposto não Cadastrado");
		}

		return $this->listTaxs();

	}

	public function updateTax() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "UPDATE tax SET description = :description, id_type = :id_type, tax = :tax WHERE id = :id ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("id",$this->id);
		$stmt->bindParam("description",$this->description);
		$stmt->bindParam("id_type",$this->id_type);
		$stmt->bindParam("tax",$this->tax);

		if(!$stmt->execute()){
			throw new Exception("Imposto não Atualizado");			
		}

		return $this->listTaxs();

	}

	public function deleteTax()
	{
		$conn = Connection::getInstance(DB_BANCO);
		
		$sql = "DELETE FROM tax WHERE id = :id ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id",$this->id);		

		if(!$stmt->execute()){
			throw new Exception("Imposto não Excluído");			
		}

		return $this->listTaxs();
	}




}