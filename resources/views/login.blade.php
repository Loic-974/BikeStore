<!DOCTYPE html>
<html lang="fr">

    <head>
      
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
   
    <body>

        <div class="container">
            @include('header')
            <div class="card-header">
                <h1> Connexion </h1>
                <p class="error">{{$error}}</p>
                
                <form id="loginForm" class="card-body" method='POST' action='/'>
                @csrf
                    <p class="errorForm error"></p>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right"> Email administrateur
                            <input type="email" value="{{$mail}}" class="form-control @error('email') is-invalid @enderror" placeholder="Entrer votre email" name="emailLogin" onchange="checkMail(this.value);">
                        </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right"> Mot de passe Administrateur
                            <input type="password" class="form-control @error('password') is-invalid @enderror" value="" placeholder="Entrer le mot de passe" name="mdpLogin">
                        </label>
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