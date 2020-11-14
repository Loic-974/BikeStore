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
        <div class='content-right'>

            <h4>Filtrer le Tableau<h4>
            <select id='SelectBrand'></select>
            <select id='SelectCategorie'></select>
            <select id='SelectAnnee'><select>
        
            <input type='range' id="SelectPrice" value="2500" step="10" min="0" max="12000" oninput="valueRange.value = SelectPrice.value +'€'">
            <output id="valueRange">2500€</output>
            <h4> Modificatio et Ajout <h4>
            <input type='texte' value='' placeholder='Entrer une nouvelle donnée'>
        </div>
     
        </div>
     
     
     
     
     </div>
    </body>

    <script src="js/Production/production.js"></script>