<?php

namespace App\Model;

use App\Database\Connection;

//outras Exceptions
use Exception;
use InvalidArgumentException;


class Type
{
	private $id;
	private $description;
	
	public function getId()
	{
	    return $this->id;
	}
	
	public function setId($id)
	{
	    return $this->id = $id;
	}

	public function getDescription()
	{
	    return $this->description;
	}
	
	public function setDescription($description)
	{
	    return $this->description = $description;
	}

	


	public static function listTypes() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT * FROM type ORDER BY id";
		$sql = $conn->prepare($sql);
		$sql->execute();
		$resultado = array();

		while ($row = $sql->fetchObject()) {
			
			$resultado[] = $row;
		}

		if(!$resultado){
			throw new Exception("Não existem tipos cadastrados");				
		}

		return $resultado;
	}	


	public function searchTypeById()
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "SELECT * FROM type WHERE id = :id";
		$sql = $conn->prepare($sql);
		$sql->bindParam("id",$this->id);
		$sql->execute();

		$resultado = "";
		
		while ($row = $sql->fetchObject()) {
			
			$resultado = $row;
		}

		if(!$resultado){
			throw new Exception("Não existe tipo cadastrado com este id");
		}

		return $resultado;
	}


	public function registerType() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "INSERT INTO type(description) values (:description ) ";
		$sql = $conn->prepare($sql);
		$sql->bindParam("description",$this->description);
		$sql->execute();

		$resultado = "";
		
		while ($row = $sql->fetchObject()) {
			
			$resultado = $row;
		}

		if(!$resultado){
			throw new Exception("Tipo não cadastrado");			
		}

		return $this->listTypes();

	}

	public function updateType() 
	{

		$conn = Connection::getInstance(DB_BANCO);

		$sql = "UPDATE type SET description = :description WHERE id = :id ";
		$sql = $conn->prepare($sql);
		$sql->bindParam("id",$this->id);
		$sql->bindParam("description",$this->description);
		$sql->execute();

		$resultado = "";
		
		while ($row = $sql->fetchObject()) {
			
			$resultado = $row;
		}

		if(!$resultado){
			throw new Exception("Tipo não Atualizado");			
		}

		return $this->listTypes();

	}

	public function deleteType()
	{
		$conn = Connection::getInstance(DB_BANCO);
		
		$sql = "DELETE FROM type WHERE id = :id ";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id",$this->id);		

		if(!$stmt->execute()){
			throw new Exception("Tipo não Excluído");			
		}

		return $this->listTypes();
	}

}
