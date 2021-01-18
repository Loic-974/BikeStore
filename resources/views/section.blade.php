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
        @if(\Request::is('reporting'))

            @include('/Reporting/globalCharts')

        @endif
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
                        @if (\Request::is('vente') || (\Request::is('administration')))  
                            <div class='table-content-left'>
                                <table  class ='table table-dark' id="ArrayVente">
                                    <div class="spinner-border text-light" role="status" id='loader'>
                                            <span class="sr-only">Loading...</span>
                                    </div>
                                </table>
                            </div>   
                        @endif             
            </div>
                <div class='sub-container-right'>   
                    <div class='content-right'>
                    @if (\Request::is('vente') || (\Request::is('administration')))       
                        <div class='filter-container'>
                            <h4>Filtres</h4>
                                @if (\Request::is('vente'))
                                    <input type='text' value='' id='searchInput' placeholder='Chercher un Client/Commande'>
                                @endif
                                @if (\Request::is('administration'))
                                    <input type='text' value='' id='searchInput' placeholder='Chercher un Collaborateur'>
                                @endif
                            <span class='searchList'></span>     
                        </div>

                        <div class='form-container'>                    
                                <h4> Ajouts </h4>
                                <form id='formProductionAdd'>
                                    <p id='errorFormProduction'></p>                          
                                    <input type='button' value='Nouvelle Vente' class='btn-primary' id='btnAddDataBrand'>                          
                                </form>
                        </div>                
                        <div class='notification-container' >
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
                @if (\Request::is('production') || (\Request::is('administration'))) 
                    <div class="modal-header">
                        <h4>Suppimer la référence</h4>
                    </div>
                    <div class="modal-body">
                        <p><span class='warning'>Attention cette action est définitive</span></p>
                            <input type='button' class="btn btn-danger" value='Supprimer la référence' id='modalDeleteProduction'>
                    </div>
                @endif
            </div>    
        </div> 
        <div id='backgroundModal'></div>
        
        @if (\Request::is('vente')) 
        <!------------------------------------------------------------------------------------------------------------------------>
        <!-------------------------------------------------------  Modal Vente --------------------------------------------------->
        <!------------------------------------------------------------------------------------------------------------------------>
            <div id="modalVente" class='modal'>
                @include ('/Vente/ModalVente')
            </div>
        @endif


    </body>
 <!-------------------------------------------------------------------------------------------------------------------->
 <!-----------------------------------------------  Common Module  ---------------------------------------------------->
 <!-------------------------------------------------------------------------------------------------------------------->
    @if (\Request::is('vente') || \Request::is('administration')) 
        <script type='module' src='js/lib/buildFunction.js'></script>
        <script type='module' src='js/GlobalSetter/notificationSetter.js'></script>
         <!------------------------------------------------------------------------------------->
        <!--------------------------------  Selling Module  ------------------------------------>
        <!-------------------------------------------------------------------------------------->
        @if (\Request::is('vente')) 
            <script type='module' src="js/Vente/vente_setter.js"></script> 
            <script type='module' src="js/Vente/vente_ui.js"></script>
        @endif

        <!-------------------------------------------------------------------------------------->
        <!-------------------------  Administration Module  ------------------------------------>
        <!-------------------------------------------------------------------------------------->
    @endif

 <!-------------------------------------------------------------------------------------------------------------------->
 <!--------------------------------------------  Reporting Module  ---------------------------------------------------->
 <!-------------------------------------------------------------------------------------------------------------------->

    @if(\Request::is('reporting'))

    <script type='module' src="js/Reporting/reporting_ui.js"></script>

    @endif
    
<!-- -------------------------------------------- If not connected -------------------------------------------- -->

    @elseif(!session('id'))

        @php
            header('location:' . URL::to('/'));
            exit();
        @endphp

    @endif