@if(session('id'))
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link href="{{ asset('css/section.css') }}" rel="stylesheet">
        <link href="{{asset('css/bootstrap.min.css')}}" rel='stylesheet'>
    </head>

  
   
    <body>
     @include('header')
     
     <div class='container-content'>
        <div class='sub-container'>
            <div class='sub-container-left'>     
                
                        <div class='nav'>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-secondary" id="brandLink">Marques</button>
                                <button type="button" class="btn btn-secondary"  id="CategorieLink">Categories</button>
                                <button type="button" class="btn btn-secondary" id="ProductLink">Produits</button>
                                <button type="button" class="btn btn-secondary" id="StockLink">Stock</button>
                            </div>
                        </div>

                        <div class='table-content-left'>
                            <table  class ='table table-dark' id="ArrayProduction">
                            </table>
                        </div>
                
                <div id='backgroundModal'></div>

                    <div class='form-modal-table' id='modalProduction'>  
                        <div class="modal-header">
                            <h4 class='titreModal'></h4>
                        </div>
                        <div class="modal-body">
                            <p id="modalErrorProduction" class='warning'></p>
                            <form>
                        
                            </form>
                            <input type="button" class="btn btn-primary" id="validUpdateModal" value="Valider les modifications">
                            <div class="modal-header">
                                <h4>Suppimer la référence</h4>
                            </div>
                            <div class="modal-body">
                                <p><span class='warning'>Attention cette action est définitive</span></p>
                                <input type='button' class="btn btn-danger" value='Supprimer la référence' id='modalDeleteProduction'>
                            </div>
                        </div>    
                    </div>
                
               

            </div>
                <div class='sub-container-right'>   
                    <div class='content-right'>
                      
                        <div class='filter-container'>
                        <h4>Filtres</h4>
                            <select id='SelectBrand'></select>
                            <select id='SelectCategorie'></select>
                            <select id='SelectAnnee'><select>
                            <select id='SelectStore'></select>
                            <input type='text' value='' id='searchInput' placeholder='Chercher un produit'>
                            <span class='searchList'></span>     
                        </div>
                
                        <div class='form-container'>
                            <h4> Ajouts </h4>
                            <form id='formProductionAdd'>
                                <p id='errorFormProduction'></p>
                            
                                        <input type='texte' id='newBrandName' class='form-control' name='brandName' value='' placeholder='Nouvelle Marque'>
                            
                            
                                        <input type='texte' id='newCatName' name='category_name' class='form-control' value='' placeholder='Nouvelle Catégorie'>              
                        
                            
                                        <input type='texte' id='newProductName' name='product_name' class='form-control' value='' placeholder='Nouveau Produit'>
                            
                            
                                        <input type='number' id='newYearProduct' name='model_year'class='form-control' value='' placeholder='Année du Modèle'>
                                
                            
                                        <input type='number' id='newPriceProduct' name='list_price' class='form-control' value='' placeholder='Prix du Modèle'>
                        
                            
                                        <input type='number' id='newQuantity' name='quantity' class='form-control' value='' placeholder='Quantité du modèle'>
                            
                            
                                <div class='form-row group-selectProduct'>
                                    <select name='brandSelected' id='SelectBrandForm'></select>
                                    <select name='catSelected' id='SelectCategorieForm'></select>
                                </div>
                                <div class='form-row group-selectProduct groupStock'>
                                    <input type='text' name='selectedProduct' id='selectProduct'></select>
                                    <span id = 'searchList' class='searchList'></span>
                                    <select name='selectedStore' id='selectStore'></select>
                                </div>
                                <input type='button' value='Confirmer' class='btn-primary' id='btnAddDataBrand'>
                            </form>
                          
                        </div>
                
                        <div class='notification-container'>
                            <h4> Notifications </h4>
                            <table id='notificationList'>
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Legende</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            
                            </table>
                        </div>
                    </div>
        
                
     
            </div>   
     
     </div>
    </body>
    <script type='module' src='js/lib/buildFunction.js'></script>
    <script type='module' src="js/Production/production.js"></script>


    @elseif(!session('id'))

        @php
            header('location:' . URL::to('/'));
            exit();
        @endphp

    @endif