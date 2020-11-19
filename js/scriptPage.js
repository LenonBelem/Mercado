
$(document).ready(function(){
     
     pageStart();
     
    });


function View_typeList(){

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
	     list = data;
	     viewTypesProduct(list);
	})
	.fail(function(jqXHR, textStatus, msg){
	     alert(msg);
	});

	
        
}


function View_typeListTax(){

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
       list = data;
       viewTypesTax(list);
  })
  .fail(function(jqXHR, textStatus, msg){
       alert(msg);
  });

  
        
}

/*

	Product 

*/









/*
/
/
/
/
/
/
/
/
/
/
/
*/



function k(i) {
  var v = i.value.replace(/\D/g,'');
  v = (v/100).toFixed(2) + '';
  v = v.replace(".", ",");
  v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
  v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
  i.value = v;
}


function converteMoedaFloat(valor){
      
      if(valor === ""){
         valor =  0;
      }else{
         valor = valor.replace(".","");
         valor = valor.replace(",",".");
         valor = parseFloat(valor);
      }
      return valor;

   }

/*   @brief Converte um valor em formato float para uma string em formato moeda
      @param valor(float) - o valor float
      @return valor(string) - o valor em moeda
   */
function converteFloatMoeda(valor){
      var inteiro = null, decimal = null, c = null, j = null;
      var aux = new Array();
      valor = ""+valor;
      c = valor.indexOf(".",0);
      //encontrou o ponto na string
      if(c > 0){
         //separa as partes em inteiro e decimal
         inteiro = valor.substring(0,c);
         decimal = valor.substring(c+1,valor.length);
      }else{
         inteiro = valor;
      }
      
      //pega a parte inteiro de 3 em 3 partes
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
         aux[c]=inteiro.substring(j-3,j);
      }
      
      //percorre a string acrescentando os pontos
      inteiro = "";
      for(c = aux.length-1; c >= 0; c--){
         inteiro += aux[c]+'.';
      }
      //retirando o ultimo ponto e finalizando a parte inteiro
      
      inteiro = inteiro.substring(0,inteiro.length-1);
      
      decimal = parseInt(decimal);
      if(isNaN(decimal)){
         decimal = "00";
      }else{
         decimal = ""+decimal;
         if(decimal.length === 1){
            decimal = decimal+"0";
         }
      }
      
      
      valor = inteiro+","+decimal;
      
      
      return valor;

   }