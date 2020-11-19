/*

	Product 

*/



 

function typesList(){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/type/list",
	     type: 'GET',
	     dataType: "json",
	     data : {
	     },
	     beforeSend : function(){
	          loadTypesList();
	     }
	})
	.done(function(data){
		if(data.status == 'sucess'){
		     list = data;
		     viewTypesList(list);
		 }
		 $("#loaderType_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

	
        
}




function loadTypesList(){
	$("#loaderType_list").show();
	$("#type_list").hide();
}

function viewTypesList(list){

	var types = '';
	var itens = list.data;
	for(var i=0;i<itens.length;i++){
		types +=  "<tr><td>"+itens[i].id+"</td><td>"+itens[i].description+"</td><td><a class='uk-link' onclick='openType("+itens[i].id+");' >Editar <span uk-icon='icon: pencil'></span></a> - <a class='uk-link' onclick='deleteType("+itens[i].id+");' >Excluir <span uk-icon='icon: trash'></span></a></td></tr>";
	}

	$("#listTypes").html(types);

	$("#loaderType_list").hide();
	$("#type_list").show();
}







function clearRegisterViewTypes(){

	$("#type_id").val("");
	$("#type_description").val("");
	$("#type_description").removeClass('uk-form-success');
	$("#type_description").removeClass('uk-form-danger');

}

function validateFieldsType(){

	var valid = 0;

	var id = $("#type_id").val();

	if($("#type_description").val()){	
		$("#type_description").removeClass('uk-form-danger');
		$("#type_description").addClass('uk-form-success');
		var description = $("#type_description").val();		
	}else{
		$("#type_description").addClass('uk-form-danger');
		$("#type_description").removeClass('uk-form-success');
		valid++;
	}

	
	
	
	if(valid == 0){
		var dados = { 'id' : id, 'description' : description };
		return dados;
	}
	
}


function viewOpenTypesRegister(list){

	$("#type_id").val(list.data.id);
	$("#type_description").val(list.data.description);
}



function deleteType(codigo){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/type/delete",
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
		     viewTypesList(list);
		 }
		 $("#loaderType_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

}

function openType(codigo){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/type/search",
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
		     viewOpenTypesRegister(list);
		 }
		 $("#loaderType_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

}





function saveType(list){

	$.ajax({
	     url : "http://localhost:8080/api/type/save",
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
		     clearRegisterViewTypes();
		     viewTypesList(list);
		 }
		 $("#loaderType_list").hide();
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});
}