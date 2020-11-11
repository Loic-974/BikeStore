<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
       
    </head>

  
   
    <body>
     @include('header')

     <div class='container-content'>
        <div class='sub-container'>
            <nav id="">
            <ul class="nav">
                <li class="nav-item nav-link active" id="brandLink">
                    Brand
                </li>
                <li class="nav-item" id="CategorieLink">
                    Categorie
                </li>
                <li class="nav-item" id="ProductLink">
                    Product
                </li>
                <li class="nav-item">
                    Stock
                </li>
            </ul>
            </nav>

        <div class='content-left'>

            <div id="brandView">
                <div class='table-content-left'>
                    <table  id="ArrayProduction">
                    </table>
                </div>
            </div>


        </div>
        <div class='content-right'>

        <select id='SelectBrand'></select>
        <select id='SelectCategorie'></select>
        <select id='SelectAnnee'><select>
      
        <input type='range' id="SelectPrice" value="2500" step="10" min="0" max="12000" oninput="valueRange.value = SelectPrice.value +'€'">
        <output id="valueRange">2500€</output>

        <input type='texte' value='' placeholder='Entrer une nouvelle donnée'>




        </div>
     
     
     
     
     
     
     </div>
    </body>

    <script src="js/Production/production.js"></script>