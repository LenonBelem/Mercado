$('#product_save').click(function() {
	var dados = validateFieldsProduct();		
		if(dados){
			saveProduct(dados);	
		}

	});

$('#product_clear').click(function() {

	clearRegisterViewProducts();	

	});


$('#type_save').click(function() {

	var dados = validateFieldsType();		
		if(dados){
			saveType(dados);	
		}	

	});

$('#type_clear').click(function() {

	clearRegisterViewTypes();	

	});


$('#saleAddProduct').click(function() {

	var dados = validateFieldsSale();		
		if(dados){
			addProduct(dados);	
		}	

	});

$('#tax_save').click(function() {
	var dados = validateFieldsTax();		
		if(dados){
			saveTax(dados);	
		}

	});

$('#tax_clear').click(function() {

	clearRegisterViewTaxs();	

	});


function pageStart(){
	$("#pagetax").hide();
	$("#pageStart").show();
	$("#pageType").hide();
	$("#pageSale").hide();
	$("#pageProduct").hide();
}

function pageProduct(){
	$("#pagetax").hide();
	$("#pageProduct").show();
	productsList();
    View_typeList();
	$("#pageType").hide();
	$("#pageSale").hide();
	$("#pageStart").hide();
}

function pagetype(){
	$("#pagetax").hide();
	$("#pageType").show();
	typesList();
	$("#pageStart").hide();
	$("#pageSale").hide();
	$("#pageProduct").hide();
}

function pageTax(){
	taxsList();
    View_typeListTax();
	$("#pagetax").show();
	$("#pageStart").hide();
	$("#pageType").hide();
	$("#pageSale").hide();
	$("#pageProduct").hide();
}

function pageSale(){
	$("#totalSaleValue").html("");
	$("#totalSaleTax").html("");
	$("#itensSale").html("");
    productsListAux();
	$("#pageSale").show();
	$("#pageStart").hide();
	$("#pageType").hide();
	$("#pageProduct").hide();
	$("#pagetax").hide();
}