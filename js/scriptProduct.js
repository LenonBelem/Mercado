/*

	Product 

*/





function productsList(){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/product/list",
	     type: 'GET',
	     dataType: "json",
	     data : {
	     	mod : ''
	     },
	     beforeSend : function(){
	          loadProductsList();
	     }
	})
	.done(function(data){
		 if(data.status == 'sucess'){
		     list = data;
		     viewProductsList(list);
		 }
		 $("#loaderProduct_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

	
        
}



function loadProductsList(){
	$("#loaderProduct_list").show();
	$("#product_list").hide();
}

function loadTypesList(){
	$("#loaderType_list").show();
	$("#type_list").hide();
}

function viewProductsList(list){

	var products = '';
	var itens = list.data;
	for(var i=0;i<itens.length;i++){
		products +=  "<tr><td>"+itens[i].id+"</td><td>"+itens[i].name+"</td><td>"+converteFloatMoeda(itens[i].price)+"</td><td align='center'><a class='uk-link' onclick='openProduct("+itens[i].id+");' >Editar <span uk-icon='icon: pencil'></span></a> - <a class='uk-link' onclick='deleteProduct("+itens[i].id+");' >Excluir <span uk-icon='icon: trash'></span></a></td></tr>";
	}

	$("#productsList").html(products);

	$("#loaderProduct_list").hide();
	$("#product_list").show();
}




function viewTypesProduct(list){

	var types = "<option value=''>Selecione um tipo</option>";
	var itens = list.data;
	for(var i=0;i<itens.length;i++){
		types +=  "<option value='"+itens[i].id+"'>"+itens[i].description+"</option>"
	}

	$("#product_type").html(types);

}


function clearRegisterViewProducts(){

	$("#product_id").val("");
	$("#product_name").val("");
	$("#product_type").val("");
	$("#product_ean").val("");
	$("#product_price").val("");
	$("#product_name").removeClass('uk-form-success');
	$("#product_name").removeClass('uk-form-danger');
	$("#product_type").removeClass('uk-form-success');
	$("#product_type").removeClass('uk-form-danger');
	$("#product_ean").removeClass('uk-form-success');
	$("#product_ean").removeClass('uk-form-danger');
	$("#product_price").removeClass('uk-form-success');
	$("#product_price").removeClass('uk-form-danger');

}

function validateFieldsProduct(){

	var valid = 0;

	var id = $("#product_id").val();

	if($("#product_name").val()){	
		$("#product_name").removeClass('uk-form-danger');
		$("#product_name").addClass('uk-form-success');
		var name = $("#product_name").val();		
	}else{
		$("#product_name").addClass('uk-form-danger');
		$("#product_name").removeClass('uk-form-success');
		valid++;
	}

	if($("#product_type").val()){
		$("#product_type").removeClass('uk-form-danger');
		$("#product_type").addClass('uk-form-success');
		var type =	$("#product_type").val();
	}else{
		$("#product_type").addClass('uk-form-danger');
		$("#product_type").removeClass('uk-form-success');
		valid++;
	}

	if($("#product_ean").val()){
		$("#product_ean").removeClass('uk-form-danger');
		$("#product_ean").addClass('uk-form-success');
		var ean = $("#product_ean").val();
	}else{
		$("#product_ean").addClass('uk-form-danger');
		$("#product_ean").removeClass('uk-form-success');
		valid++;
	}

	if($("#product_price").val()){
		$("#product_price").removeClass('uk-form-danger');
		$("#product_price").addClass('uk-form-success');
		var price = converteMoedaFloat($("#product_price").val());
	}else{
		$("#product_price").addClass('uk-form-danger');
		$("#product_price").removeClass('uk-form-success');
		valid++;
	}
	
	if(valid == 0){
		var dados = { 'id' : id, 'name' : name, 'type' : type, 'ean' : ean, 'price' : price };
		return dados;
	}
	
}


function viewOpenProductsRegister(list){

	$("#product_id").val(list.data.id);
	$("#product_name").val(list.data.name);
	$("#product_type").val(list.data.type);
	$("#product_ean").val(list.data.ean);
	var price = converteFloatMoeda(list.data.price.replace('R$ ', ""));
	$("#product_price").val(price);
}



function deleteProduct(codigo){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/product/delete",
	     type: 'POST',
	     dataType: "json",
	     data : {
	     	id : codigo
	     },
	     beforeSend : function(){
	          loadProductsList();
	     }
	})
	.done(function(data){
		if(data.status == 'sucess'){
		     list = data;
		     viewProductsList(list);
		 }
		 $("#loaderProduct_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

}

function openProduct(codigo){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/product/search",
	     type: 'GET',
	     dataType: "json",
	     data : {
	     	id : codigo
	     },
	     beforeSend : function(){
	          //loadProductsList();
	     }
	})
	.done(function(data){
		 if(data.status == 'sucess'){
		     list = data;
		     viewOpenProductsRegister(list);
	     }
	     $("#loaderProduct_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

}


$('#product_save').click(function() {

	var id = $("#product_id").val();
	var name = $("#product_name").val();
	var type =	$("#product_type").val();
	var ean = $("#product_ean").val();
	var price = converteMoedaFloat($("#product_price").val());

	var dados = { 'id' : id, 'name' : name, 'type' : type, 'ean' : ean, 'price' : price };		
		
		saveProduct(list);	

	});


function saveProduct(list){

	$.ajax({
	     url : "http://localhost:8080/api/product/save",
	     type: 'POST',
	     dataType: "json",
	     data : list,
	     beforeSend : function(){
	          loadProductsList();
	     }
	})
	.done(function(data){
		 if(data.status == 'sucess'){
		     list = data;
		     clearRegisterViewProducts();
		     viewProductsList(list);
		 }
		 $("#loaderProduct_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});
}