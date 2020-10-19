<!DOCTYPE html>
<html lang="fr">

    <head>
      
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
   
    <body>

        <div class="container">
            @include('header')
            <div class="center-container">
              
                    <h1> Espace d'administration </h1>
                    <!-- <p class="error">{{$error}}</p> -->
                    
                    <form id="loginForm" class="card-body" method='POST' action='/'>
                    @csrf
                        <p class="errorForm error">{{$error}}</p>
                        
                        <div class="form-group row">
                            <label class="" for="emailLogin"> Email administrateur</label>      
                            <input type="email" id="emailLogin" value="{{$mail}}" class="form-control @error('email') is-invalid @enderror" placeholder="Entrer votre email" name="emailLogin" onchange="checkMail(this.value);">

                        </div>
                        <div class="form-group ">
                            <label class="" for="mdpLogin"> Mot de passe Administrateur</label>
                                <input type="password" id='mdpLogin' class="form-control @error('password') is-invalid @enderror" value="" placeholder="Entrer le mot de passe" name="mdpLogin">
                           
                        </div>
                        <div class="form-group row mb-0">
                        <input type="submit" value="Connexion">
                        </div>
                    </form>
               
            </div>
        </div>
    </body>
    <script type="text/javascript" src="/js/Login/loginCheck.js"></script>
</html>