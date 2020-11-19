<?php
namespace Tests;


use PHPUnit\Framework\TestCase;
use App\Controller\SaleController;

/**
 * 
 */
class SaleControllerTest extends TestCase
{
	
	public function testCalcularPorcentagemDeImposto(){
		$venda = new SaleController();

		$this->assertEquals(‘20’, $venda->calcularPorcentagemDeImposto(100,20));
	}
}
