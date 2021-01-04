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
            @if (\Request::is('vente') || \Request::is('administration')) 
                @if (\Request::is('vente'))    
                    @include('/Vente/arrayVente')
                @endif      
            @endif     
            @if (\Request::is('reporting'))  
            @include('/Reporting/globalCharts')
            @endif  
            </div>
                <div class='sub-container-right'>   
                    <div class='content-right'>
            @if (\Request::is('vente') || \Request::is('administration'))       
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
                                  
                    </div>
            @endif   
            </div>    
     </div>
        @if (\Request::is('vente') || \Request::is('administration')) 
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
            @if (\Request::is('vente')) 
                <div id="modalVente" class='modal'>
                    @include ('/Vente/ModalVente')
                </div>
            @endif
        @endif
    </body>
    @if (\Request::is('vente') || \Request::is('administration')) 
        <script type='module' src='js/lib/buildFunction.js'></script>
        <script type='module' src='js/GlobalSetter/notificationSetter.js'></script>

        @if (\Request::is('vente')) 
            <script type='module' src="js/Vente/vente_setter.js"></script> 
            <script type='module' src="js/Vente/vente_ui.js"></script>
        @endif
    @endif
    
<!-- -------------------------------------------- If not connected -------------------------------------------- -->

    @elseif(!session('id'))

        @php
            header('location:' . URL::to('/'));
            exit();
        @endphp

    @endif