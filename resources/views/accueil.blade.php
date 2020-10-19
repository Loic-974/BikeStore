
<!DOCTYPE html>
<html lang="fr">

    <head>
      
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    </head>
   
    <body>
        @include('header')
        @if(session())
        <div class="container">
       
            <div class="sub-container">
                @if(session('roleManager')<(5))
                <div class="card-container">
                    <h3>Production</h3>
                    <a href="#">lorem ipsum</a>             
                </div>
                @endif
                @if(session('roleManager')<(5))
                <div class="card-container">
                    <h3>Vente</h3>
                    <a href="#">lorem ipsum</a>             
                </div>
               @endif
               @if(session('roleManager')<(3))
                <div class="card-container">
                    <h3>Reporting</h3>
                    <a href="#">lorem ipsum</a>             
                </div>
                @endif
                @if(session('roleManager')<(2))
                <div class="card-container">
                    <h3>Administration</h3>
                    <a href="#">lorem ipsum</a>             
                </div>
                @endif

            </div>
        </div>
        @endif

    </body>

