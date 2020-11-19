<!DOCTYPE html>
<html>
<head>
    <title>Software Mercado</title>

    <link rel="stylesheet" type="text/css" href="lib/uikit/css/uikit.min.css">

    <script src="lib/jquery-3.1.1.min.js" ></script>

    <script src="lib/uikit/js/uikit.min.js"></script>
    <script src="lib/uikit/js/uikit-icons.min.js"></script>

    <script src="js/scriptPage.js?v=2"></script>
    <script src="js/scriptProduct.js?v1"></script>
    <script src="js/scriptType.js"></script>
    <script src="js/scriptSale.js"></script>
    <script src="js/scriptTax.js"></script>


</head>
<body>

<header>
    <nav class="uk-navbar-container uk-background-secondary">
        <div class="uk-navbar-left uk-background-secondary uk-light">

            <ul class="uk-navbar-nav">
                <li><a onclick="pageStart();">Inicio</a></li>
                <li><a onclick="pageProduct();">Produtos</a></li>
                <li><a onclick="pagetype();">Tipos de Produtos</a></li>
                <li><a onclick="pageTax();">Impostos</a></li>
                <li><a onclick="pageSale();">Tela de Venda</a></li>
            </ul>

        </div>
        
    </nav>


</header>

<div class="uk-section uk-section-default">
    <div class="uk-container">

        <!-- Página Inicial -->
        <div id="pageStart" style="display: none;">
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    
                     <h2 class="uk-heading-line uk-text-center"><span>Sistema de Vendas Ponta de Caixa</span></h2>




                </div>
                <div class="uk-width-1-2@m">
                    
                    


                </div>
            </div>
        </div>
        <!-- Página Produtos -->
        <div class="" id="pageProduct" style="display: none;">
            <ul class="uk-breadcrumb">
                <li><a onclick="pageStart();">Inicio</a></li>
                <li class="uk-disabled"><a>Produtos</a></li>
            </ul>
            <hr>
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    
                    <div id="loaderProduct_list" align="center">
                        <span uk-spinner="ratio: 4.5"></span>
                    </div>

                    <div id="product_list">

                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>nome</th>
                                    <th>preço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="productsList">
                                <tr>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>




                </div>
                <div class="uk-width-1-2@m">
                    
                    <form>
                        <fieldset class="uk-fieldset">

                            <div class="uk-margin"> 
                                <label>Código:<br></label>                   
                                <input class="uk-input uk-form-width-small" type="text" id="product_id" readonly="true" disabled>
                            </div>

                            <div class="uk-margin"> 
                                <label>*Nome:<br></label>                   
                                <input class="uk-input uk-form-width-large" type="text" id="product_name" placeholder="Nome do Produto">
                            </div>
                            <div class="uk-margin">
                                <label>*Tipo:<br></label>
                                <select class="uk-select uk-form-width-large" id="product_type">
                                    <option value="">Selecione um tipo</option>
                                </select>
                            </div>

                            <div class="uk-margin">
                                <label>*EAN 13 (código de Barras):<br></label>                   
                                <input class="uk-input uk-form-width-medium" type="number" min="0" max="9999999999999" id="product_ean" placeholder="código de Barras">
                            </div>
                            <div class="uk-margin">
                                <label>*Preço:<br></label>                   
                                <input class="uk-input uk-form-width-medium" type="text" onkeyup="k(this);" id="product_price" placeholder="Preço">
                            </div>

                            <div class="uk-margin" align="right">
                                <span class="uk-button uk-button-default" id="product_clear">Limpar</span>
                                <span class="uk-button uk-button-secondary" id="product_save">Salvar</span>
                            </div> 

                            

                        </fieldset>
                    </form>


                </div>
            </div>
        </div>

        <!-- Página Tipos de Produtos -->
        <div id="pageType" style="display: none;">
            <ul class="uk-breadcrumb">
                <li><a onclick="pageStart();">Inicio</a></li>
                <li class="uk-disabled"><a>Tipos de Produtos</a></li>
            </ul>
            <hr>
            <div uk-grid>
                <div class="uk-width-1-2@m">

                    <div id="loaderType_list" align="center">
                        <span uk-spinner="ratio: 4.5"></span>
                    </div>

                    <div id="type_list">

                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>código</th>
                                    <th>descrição</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody id="listTypes">
                                <tr>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>




                </div>
                <div class="uk-width-1-2@m">
                    
                    <form>
                        <fieldset class="uk-fieldset">
                            
                             <div class="uk-margin"> 
                                <label>Código:<br></label>                   
                                <input class="uk-input uk-form-width-small" type="text" id="type_id" readonly="true" disabled>
                            </div>

                            <div class="uk-margin"> 
                                <label>* Descrição:<br></label>                   
                                <input class="uk-input uk-form-width-large" type="text" id="type_description" placeholder="Descrição">
                            </div>
                            <div class="uk-margin" align="right">
                                <span class="uk-button uk-button-default" id="type_clear">Limpar</span>
                                <span class="uk-button uk-button-secondary" id="type_save">Salvar</span>
                            </div> 
                           

                        </fieldset>
                    </form>


                </div>
            </div>
        </div>


        <!-- Página Impostos -->
        <div class="" id="pagetax" style="display: none;">
            <ul class="uk-breadcrumb">
                <li><a onclick="pageStart();">Inicio</a></li>
                <li class="uk-disabled"><a>Impostos</a></li>
            </ul>
            <hr>
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    
                    <div id="loaderTax_list" align="center">
                        <span uk-spinner="ratio: 4.5"></span>
                    </div>

                    <div id="tax_list">

                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>descrição</th>
                                    <th>tipo</th>
                                    <th>imposto</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="taxsList">
                                <tr>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                    <td>Table Data</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>




                </div>
                <div class="uk-width-1-2@m">
                    
                    <form>
                        <fieldset class="uk-fieldset">

                            <div class="uk-margin"> 
                                <label>Código:<br></label>                   
                                <input class="uk-input uk-form-width-small" type="text" id="tax_id" readonly="true" disabled>
                            </div>

                            <div class="uk-margin"> 
                                <label>*Descrição:<br></label>                   
                                <input class="uk-input uk-form-width-large" type="text" id="tax_description" placeholder="Nome do Imposto">
                            </div>
                            <div class="uk-margin">
                                <label>*Tipo:<br></label>
                                <select class="uk-select uk-form-width-large" id="tax_id_type">
                                    <option value="">Selecione um tipo</option>
                                </select>
                            </div>
                            
                            <div class="uk-margin">
                                <label>*Imposto: %<br></label>                   
                                <input class="uk-input uk-form-width-medium" type="number" id="tax_tax" placeholder="">
                            </div>

                            <div class="uk-margin" align="right">
                                <span class="uk-button uk-button-default" id="tax_clear">Limpar</span>
                                <span class="uk-button uk-button-secondary" id="tax_save">Salvar</span>
                            </div> 

                            

                        </fieldset>
                    </form>


                </div>
            </div>
        </div>


        <!-- Página Venda -->
        <div id="pageSale" style="display: none;">
            <ul class="uk-breadcrumb">
                <li><a onclick="pageStart();">Inicio</a></li>
                <li class="uk-disabled"><a>Vendas</a></li>
            </ul>
            <hr>
            <div uk-grid>
                <div class="uk-width-1-3@m uk-background-secondary uk-light uk-padding">
                    
                    <h4>Lista de Produtos</h4>
                    <hr>

                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-expand" uk-leader="fill: -">Nome do Produto</div>
                        <div>Código</div>
                    </div>

                    <div id="productsListAux">
                        
                    </div>

                    <hr>


                </div>
                <div class="uk-width-2-3@m">
                    
                    <form>
                        <fieldset class="uk-fieldset">

                            <legend class="uk-legend">Adicionar itens a compra</legend>

                            <div id="saleAlerts"></div>

                            <div class="uk-margin">
                                <label>Código : </label>
                                <input class="uk-input uk-form-width-small" type="number" id="saleProduct_id" placeholder="Código">
                                <label>Quantidade : </label>
                                <input class="uk-input uk-form-width-small" min="1" value="1" id="saleProduct_amout" type="number">
                                <span class="uk-button uk-button-secondary" id="saleAddProduct"><span uk-icon="icon: plus"></span> Adicionar</span>
                            </div>

                            

                        </fieldset>
                    </form>

                    <table class="uk-table uk-table-divider">                        
                        <tbody id="itensSale">
                            
                        </tbody>
                    </table>


                    <div class="uk-section uk-section-secondary uk-light">
                        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
                             <div>                                  
                                </div>
                            <div id="totalSaleValue">
                                </div>
                            <div id="totalSaleTax">
                                </div>
                        </div>                        
                    </div>


                </div>
            </div>
        </div>

        

        

        
    </div>
</div>


<div class="uk-section uk-section-secondary uk-light">
    <div class="uk-container">

        <h3>Exemplo Software Mercado </h3>

        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
            <div>
                <p><b>Descrição da Atividade - O que deve conter</b></p>
                <p><li>· O cadastro dos produtos;</li>
                <li>· Dos tipos de cada produto;</li>
                <li>· Dos valores percentuais de imposto dos tipos de produtos;</li>
                <li>· A tela de venda;</li>
                <li>· Onde será informado os produtos e quantidades adquiridos;</li>
                <li>· O sistema deve apresentar o valor de cada item multiplicado pela quantidade
                adquirida e a quantidade pago de imposto em cada item, um totalizador do valor da
                compra e um totalizador do valor dos impostos.</li></p>

            </div>
            <div>
                <p><b>Requisitos</b></p>
                <p>
                    <li>· PHP 7.4</li>
                    <li>· PostgreSQL versão 9.4</li>
                </p>
            </div>
            <div>
                
            </div>
        </div>

    </div>
</div>


<script src="js/scriptPagePos.js?66"></script>

</body>
</html>
    <script>
        var user_email = 'teste@gmail.com';
        var user_password = '123';
        
        function loginApi() {
            $.ajax({
                url: "http://localhost/PROJS/VIDEO_AULAS/AULAS/13_JWT/api/auth/login",
                method: 'POST',
                data: {'email' : user_email, 'password':user_password},
                })
                .done(function( data ) {
                    localStorage.setItem('user_token_jwt', data.data);
            });
        }

        function getUsers(){
            $.ajax({
                url: "http://localhost:8080/api/user/getall",
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('user_token_jwt')
                },
                })
                .done(function( data ) {
                    console.log(data);
            });
        }
        function getProdutoEan(){
            $.ajax({
                url: "http://localhost:8080/api/product/list",
                method: 'GET',
                data: { 'ean': '1234567891236' },
                })
                .done(function( data ) {
                    console.log(data);
            });
        }
    </script>
