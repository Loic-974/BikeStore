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
        @if (\Request::is('vente') || (\Request::is('administration')))  
            <div class='sub-container-left'>     
            
                            @if (\Request::is('vente'))

                              @include('/Vente/arrayVente')

                            @endif
                        
                         @if(\Request::is('administration'))

                             @include('/Administration/arrayAdministration')
                    
                         @endif              
            </div>
                <div class='sub-container-right'>   
                    <div class='content-right'>
       
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
                                @if(session('roleManager')<(4))
                                    @if (\Request::is('vente'))
                                        <form id='formProductionAdd'>
                                            <p id='errorFormProduction'></p>                          
                                            <input type='button' value='Nouvelle Vente' class='btn-primary' id='btnAddDataBrand'>                          
                                        </form>
                                    @endif
                                @endif
                                @if(session('roleManager')<(2))
                                    @if (\Request::is('administration'))
                                        <form id='formProductionAdd'>
                                            <p id='errorFormProduction'></p>                          
                                            <input type='button' value='Nouveau Collaborateur' class='btn-primary' id='btnAddColab'>                          
                                        </form>
                                    @endif
                                @endif
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
    @if (\Request::is('administration')) 

        @include('/Administration/modalGestionStaff')

    @endif
        <div class='form-modal-table' id='modalProduction'>  
            <div class="modal-header">
                <h4 class='titreModal'></h4>
            </div>
            <div class="modal-body">
                <p id="modalErrorProduction" class='warning'></p>
                    <form>
                        
                    </form>
                <input type="button" class="btn btn-primary" id="validUpdateModal" value="Valider les modifications">
               
            </div>    
        </div> 
        <div id='backgroundModal'></div>
        @if(session('roleManager')<(4))
            @if (\Request::is('vente')) 
            <!------------------------------------------------------------------------------------------------------------------------>
            <!-------------------------------------------------------  Modal Vente --------------------------------------------------->
            <!------------------------------------------------------------------------------------------------------------------------>
                <div id="modalVente" class='modal'>
                    @include ('/Vente/ModalVente')
                </div>
                <div id="modalFacture" class='modal'>
                    @include ('/Vente/facture')
                </div>
            @endif
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
       
            <script src="js/html2pdf.bundle.min.js"></script> 
            <script type='module' src="js/Vente/vente_setter.js"></script> 
            <script type='module' src="js/Vente/vente_ui.js"></script>
            <script type='module' src="js/Vente/vente_facture.js"></script>
     
        @endif

        <!-------------------------------------------------------------------------------------->
        <!-------------------------  Administration Module  ------------------------------------>
        <!-------------------------------------------------------------------------------------->
        @if (\Request::is('administration')) 

            <script type='module' src="js/Administration/administration_setter.js"></script> 
            <script type='module' src="js/Administration/administration_ui.js"></script>

        @endif

      
    @endif

 <!-------------------------------------------------------------------------------------------------------------------->
 <!--------------------------------------------  Reporting Module  ---------------------------------------------------->
 <!-------------------------------------------------------------------------------------------------------------------->

    @if(\Request::is('reporting'))


    <script type='module' src="js/Chart.min.js"></script>
    <script type='module' src="js/Reporting/reporting_setter.js"></script>
    <script type='module' src="js/Reporting/reporting_ui.js"></script>

    @endif
    
<!-- -------------------------------------------- If not connected -------------------------------------------- -->

    @elseif(!session('id'))

        @php
            header('location:' . URL::to('/'));
            exit();
        @endphp

    @endif