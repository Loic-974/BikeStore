
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    </head>
  
    <body>
        @include('header')

        <div class="container">  
        @if($firstConnect==1)  
            <div class="sub-container">
                @if(session('roleManager')<(5))
                <a class='card-container' href="/production"> 
                 
               <h3> Production </h3>        
                </a>  
                @endif
                @if(session('roleManager')<(5))
                <a  class="card-container"  href="/vente">
                <h3> Vente</h3>
                </a>
               @endif
               @if(session('roleManager')<(3))
                <a class="card-container" href="/reporting">
                    <h3>Reporting</h3>        
                </a>
                @endif
                @if(session('roleManager')<(2))
                <a class="card-container" href="/administration">
                    <h3>Administration</h3>        
                </a>
                @endif
        @endif
        @if($firstConnect!=1)
        <div class='passwordContainer'>
            <p> Première Connection : Changement de mot de passe </p>
            <form id="changePassword" method='POST' action='/accueil'>
                @csrf
                <p id="errorUpdate" class='error'><p>
                <div class="form-group-column">
                    <input type="password" id='newPassword' name="newPassword" value="" placeholder="Entrez votre nouveau mot de passe">
                    <input type="password" id='confirmNewPassword' value="" placeholder="Confirmer votre mot de passe">
                    <input type="submit" class='btn primary buttonConnexion' id="validUpdate" value="Valider la modification">
                </div>
            </form>
        </div>
        <script src="js/Accueil/updatePwd.js"></script>
        @endif
     </div>

     
    </body>

