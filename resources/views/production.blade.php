<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <script src="js/Production/production.js"></script>
    </head>

  
   
    <body>
     @include('header')

     <div class='container-content'>
     
     

        <div class='sub-container'>
            <nav id="">

            
            </nav>

        <div class='content-left'>
            <div class='table-content-left'>
                <table id="toto">
                </table>


            </div>
            <div class='form-content-left'>


            </div>


        </div>
        <div class='content-right'>




        </div>
     
     
     
     
     
     
     </div>
    </body>