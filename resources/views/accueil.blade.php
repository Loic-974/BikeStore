
<!DOCTYPE html>
<html lang="fr">

    <head>
      
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
   
    <body>
        @include('header')
        <div class="container">
       
            <div class="sub-container">
                @if(session('roleManager')<(5))
                <div class="card-container">
                    <h4>Production {{session('roleManager')}}</h4>
                    <a href="#">lorem ipsum</a>             
                </div>
                @endif
                @if(session('roleManager')<(5))
                <div class="card-container">
                    <h4>Vente</h4>
                    <a href="#">lorem ipsum</a>             
                </div>
               @endif
               @if(session('roleManager')<(3))
                <div class="card-container">
                    <h4>Reporting</h4>
                    <a href="#">lorem ipsum</a>             
                </div>
                @endif
                @if(session('roleManager')<(2))
                <div class="card-container">
                    <h4>Administration</h4>
                    <a href="#">lorem ipsum</a>             
                </div>
                @endif

            </div>
        </div>

    </body>

