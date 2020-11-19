







function addProduct(list){


	$.ajax({
	     url : "http://localhost:8080/api/sale/addProduct",
	     type: 'GET',
	     dataType: "json",
	     data : list,
	     beforeSend : function(){
	          //loadProductsList();
	     }
	})
	.done(function(data){
		 if(data.status === 'sucess'){
		     list = data;
		     viewSale(list);
		     clearRegisterViewSale();
	     }
	     alertFail(data.data);
	     
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

}


function viewSale(list){
	var itens = list.data.itens;
	var iten = "";

	for(var i=0;i<itens.length;i++){
		iten += "<tr><td>"+itens[i].name+"</td><td><td>R$ "+converteFloatMoeda(itens[i].price)+"</td></td><td>"+itens[i].amount+" UN</td><td>R$ "+converteFloatMoeda(itens[i].totalPrice)+"</td><td>R$ "+converteFloatMoeda(itens[i].totalImposto)+" | "+itens[i].impostoTotalPorcentagem+" %<td></tr>";
	}

	$("#itensSale").html(iten);

	var valueSale = "<h3><small>Valor da Compra<br></small>R$ "+converteFloatMoeda(list.data.totalCompra)+"</h3>";
	$("#totalSaleValue").html(valueSale);

	var valueTax = "<h3><small>Valor dos Impostos<br></small> R$ "+converteFloatMoeda(list.data.totalImpostos)+"<small><br> "+list.data.porcentagem+" % da venda</small></h3>";
	$("#totalSaleTax").html(valueTax);
}


function alertFail(notice){

	var alert = "<div class='uk-alert-danger' uk-alert><a class='uk-alert-close' uk-close></a><p>"+notice+".</p></div>";
	$("#saleAlerts").html(alert);
}



function validateFieldsSale(){

	var valid = 0;

	if($("#saleProduct_id").val()){	
		$("#saleProduct_id").removeClass('uk-form-danger');
		$("#saleProduct_id").addClass('uk-form-success');
		var id = $("#saleProduct_id").val();		
	}else{
		$("#saleProduct_id").addClass('uk-form-danger');
		$("#saleProduct_id").removeClass('uk-form-success');
		valid++;
	}

	var amount = Math.round($("#saleProduct_amout").val());
	
	if(valid == 0){
		var dados = { 'id' : id, 'amount' : amount };
		return dados;
	}
	
}


function clearRegisterViewSale(){

	$("#saleProduct_id").val("");
	$("#saleProduct_id").removeClass('uk-form-success');
	$("#saleProduct_id").removeClass('uk-form-danger');
	$("#saleProduct_amout").val(1);
	$("#saleAlerts").html("");
}




function productsListAux(){

	var list = '';

	$.ajax({
	     url : "http://localhost:8080/api/sale/productList",
	     type: 'GET',
	     dataType: "json",
	     data : {
	     	mod : 'name'
	     },
	     beforeSend : function(){
	          loadProductsList();
	     }
	})
	.done(function(data){
		 if(data.status == 'sucess'){
		     list = data;
		     viewProductsListAux(list);
		 }
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

	
        
}



function viewProductsListAux(list){

	var products = '';
	var itens = list.data;
	for(var i=0;i<itens.length;i++){
		products +=  "<div class='uk-grid-small' uk-grid><div class='uk-width-expand' uk-leader='fill: -'>"+itens[i].name+"</div><div>"+itens[i].id+"</div></div>";

		
	}

	$("#productsListAux").html(products);

}