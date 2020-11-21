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
        <div class='nav'>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary" id="brandLink">Marques</button>
                <button type="button" class="btn btn-secondary"  id="CategorieLink">Categories</button>
                <button type="button" class="btn btn-secondary" id="ProductLink">Produits</button>
                <button type="button" class="btn btn-secondary" id="StockLink">Stock</button>
            </div>
        </div>
        <div class='view-content'>
        <div class='content-left'>
                <div class='table-content-left'>
                    <table  class ='table table-dark' id="ArrayProduction">
                    </table>
                </div>
        </div>
        <!-- <div id='backgroundModal'> -->
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
                    <input type='button' class="btn btn-danger" value='Supprimer la référence'>
                </div>
            </div>
        </div>
        <!-- </div> -->

        <div class='content-right'>

                <h4>Filtres</h4>
                <div class='filter-container'>
                <select id='SelectBrand'></select>
                <select id='SelectCategorie'></select>
                <select id='SelectAnnee'><select>
                <select id='SelectStore'></select>
            
                <input type='range' class='form-control-range' id="SelectPrice" value="2500" step="10" min="0" max="12000" oninput="valueRange.value = SelectPrice.value +'€'">
                <output id="valueRange">2500€</output>
            </div>
            <div class='form-container'>
              <h4> Ajouts </h4>
                <form>
                    <p id='errorFormProduction'><p>
                    <!-- <div class='form-row'> -->
                            <input type='texte' id='newBrandName' class='form-control' value='' placeholder='Nouvelle Marque'>
                    <!-- </div> -->
                    <!-- <div class='form-row'> -->
                            <input type='texte' id='newCatName' class='form-control' value='' placeholder='Nouvelle Catégorie'>              
                    <!-- </div> -->
                    <div class='form-row'>
                            <input type='texte' id='newProductName' class='form-control' value='' placeholder='Nouveau Produit'>
                    </div>
                    <div class='form-row'>
                            <input type='number' id='newYearProduct' class='form-control' value='' placeholder='Année du Modèle'>
                    </div>
                    <div class='form-row'>
                            <input type='number' id='newPriceProduct' class='form-control' value='' placeholder='Prix du Modèle'>
                    </div>
                    <div class='form-row group-selectProduct'>
                    <select id='SelectBrandForm'></select>
                    <select id='SelectCategorieForm'></select>
                    </div>
                    <input type='button' value='Confirmer' class='btn-primary' id='btnAddDataBrand'>
                </form>
            </div>
        </div>
     
        </div>
     
     
     
     
     </div>
    </body>

    <script src="js/Production/production.js"></script>