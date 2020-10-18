<!DOCTYPE html>

<html lang="fr">

    <head>
        <script src=''></script>
    </head>

    <body>

        <div id="container">
            @include('header')
            <div class="central container">
                <h1> Connexion </h1>
                <form id="loginForm" method='POST' action='/validlogin'>
                @csrf
                    {{$error}}
                    <label class="formLogin"> Email administrateur
                        <input type="email" value="" placeholder="Entrer votre email administrateur" name="emailLogin">
                    </label>
                    <label class="formLogin"> Mot de passe Administrateur
                        <input type="password" value="" placeholder="Entrer le mot de passe administrateur" name="mdpLogin">
                    </label>
                    <input type="submit" value="Connexion">
                </form>
            </div>
        </div>
    </body>

</html>