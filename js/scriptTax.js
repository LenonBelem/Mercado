/*

	Product 

*/





function taxsList(){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/tax/list",
	     type: 'GET',
	     dataType: "json",
	     data : {
	     	mod : ''
	     },
	     beforeSend : function(){
	          loadTaxsList();
	     }
	})
	.done(function(data){
		 if(data.status == 'sucess'){
		     list = data;
		     viewTaxsList(list);
		 }
		 $("#loaderTax_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

	
        
}



function loadTaxsList(){
	$("#loaderTax_list").show();
	$("#product_list").hide();
}



function viewTaxsList(list){

	var taxs = '';
	var itens = list.data;
	for(var i=0;i<itens.length;i++){
		taxs +=  "<tr><td>"+itens[i].description+"</td><td>"+itens[i].typedescription+"</td><td>"+itens[i].tax+" %</td><td align='center'><a class='uk-link' onclick='openTax("+itens[i].id+");' >Editar <span uk-icon='icon: pencil'></span></a> - <a class='uk-link' onclick='deleteTax("+itens[i].id+");' >Excluir <span uk-icon='icon: trash'></span></a></td></tr>";
	}

	$("#taxsList").html(taxs);

	$("#loaderTax_list").hide();
	$("#tax_list").show();
}




function viewTypesTax(list){

	var types = "<option value=''>Selecione um tipo</option>";
	var itens = list.data;
	for(var i=0;i<itens.length;i++){
		types +=  "<option value='"+itens[i].id+"'>"+itens[i].description+"</option>"
	}

	$("#tax_id_type").html(types);

}


function clearRegisterViewTaxs(){

	$("#tax_id").val("");
	$("#tax_description").val("");
	$("#tax_id_type").val("");
	$("#tax_tax").val("");
	$("#tax_description").removeClass('uk-form-success');
	$("#tax_description").removeClass('uk-form-danger');
	$("#tax_id_type").removeClass('uk-form-success');
	$("#tax_id_type").removeClass('uk-form-danger');
	$("#tax_tax").removeClass('uk-form-success');
	$("#tax_tax").removeClass('uk-form-danger');

}

function validateFieldsTax(){

	var valid = 0;

	var id = $("#tax_id").val();

	if($("#tax_description").val()){	
		$("#tax_description").removeClass('uk-form-danger');
		$("#tax_description").addClass('uk-form-success');
		var description = $("#tax_description").val();		
	}else{
		$("#tax_description").addClass('uk-form-danger');
		$("#tax_description").removeClass('uk-form-success');
		valid++;
	}

	if($("#tax_id_type").val()){
		$("#tax_id_type").removeClass('uk-form-danger');
		$("#tax_id_type").addClass('uk-form-success');
		var id_type =	$("#tax_id_type").val();
	}else{
		$("#tax_id_type").addClass('uk-form-danger');
		$("#tax_id_type").removeClass('uk-form-success');
		valid++;
	}

	if($("#tax_tax").val()){
		$("#tax_tax").removeClass('uk-form-danger');
		$("#tax_tax").addClass('uk-form-success');
		var tax = $("#tax_tax").val();
	}else{
		$("#tax_tax").addClass('uk-form-danger');
		$("#tax_tax").removeClass('uk-form-success');
		valid++;
	}

	
	
	if(valid == 0){
		var dados = { 'id' : id, 'description' : description, 'id_type' : id_type, 'tax' : tax };
		return dados;
	}
	
}


function viewOpenTaxsRegister(list){

	$("#tax_id").val(list.data.id);
	$("#tax_description").val(list.data.description);
	$("#tax_id_type").val(list.data.id_type);
	$("#tax_tax").val(list.data.tax);
}



function deleteTax(codigo){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/tax/delete",
	     type: 'POST',
	     dataType: "json",
	     data : {
	     	id : codigo
	     },
	     beforeSend : function(){
	          loadTaxsList();
	     }
	})
	.done(function(data){
		if(data.status == 'sucess'){
		     list = data;
		     viewTaxsList(list);
		 }
		 $("#loaderTax_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

}

function openTax(codigo){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/tax/search",
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
		     viewOpenTaxsRegister(list);
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


function saveTax(list){

	$.ajax({
	     url : "http://localhost:8080/api/tax/save",
	     type: 'POST',
	     dataType: "json",
	     data : list,
	     beforeSend : function(){
	          loadTaxsList();
	     }
	})
	.done(function(data){
		 if(data.status == 'sucess'){
		     list = data;
		     clearRegisterViewTaxs();
		     viewTaxsList(list);
		 }
		 $("#loaderTax_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});
}