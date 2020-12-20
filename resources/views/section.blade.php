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
                            @if (\Request::is('vente')) 
                                <button type="button" class="btn btn-secondary" id="customersLink">Clients</button>
                                <button type="button" class="btn btn-secondary"  id="venteLink">Ventes</button>
                                <button type="button" class="btn btn-secondary" id="factureLink">Factures</button>
                              <!-- <button type="button" class="btn btn-secondary" id="livraisonLink">Livraison</button> -->
                            @endif
                            </div>
                        </div>

                        <div class='table-content-left'>
                            <table  class ='table table-dark' id="ArrayProduction">
                            </table>
                        </div>                
            </div>
                <div class='sub-container-right'>   
                    <div class='content-right'>
                      
                        <div class='filter-container'>
                            <h4>Filtres</h4>
                            <!-- <select id='SelectBrand'></select>
                            <select id='SelectCategorie'></select>
                            <select id='SelectAnnee'><select>
                            <select id='SelectStore'></select> -->
                            <input type='text' value='' id='searchInput' placeholder='Chercher un produit'>
                            <span class='searchList'></span>     
                        </div>
                
                        <div class='form-container'>
                            @if (\Request::is('vente'))
                                <h4> Ajouts </h4>
                                <form id='formProductionAdd'>
                                    <p id='errorFormProduction'></p>                          
                                    <input type='button' value='Nouvelle Vente' class='btn-primary' id='btnAddDataBrand'>                          
                                </form>

                            
                                <div id="modalVente" class='modal'>
                                    @include ('/Vente/ModalVente')
                                </div>
                         
                          
                        </div>
                
                        <div class='notification-container'>
                            <h4> Notifications </h4>
                        </div>
                        @endif
                        
                    </div>
            </div>    
     </div>
     
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
        <div id='backgroundModal'></div>

    </body>
    <script type='module' src='js/lib/buildFunction.js'></script>
    @if (\Request::is('vente')) 
    <script type='module' src="js/Vente/vente_setter.js"></script> 
    <script type='module' src="js/Vente/vente_ui.js"></script>
    @endif
    


    @elseif(!session('id'))

        @php
            header('location:' . URL::to('/'));
            exit();
        @endphp

    @endif