 <div id="header">

<h1>BikeStore</h1>
    @if(session('name'))
        <nav id='navContainer'class='navbar-nav'>
                  
                <a href='/production'>Production</a>
                
                 <a href='/vente'>Vente</a>
                
                @if(session('roleManager')<(3))
                    <a href='/reporting'>Reporting</li>
                @endif
                @if(session('roleManager')<(2))
                    <a href='/administration'>Administration</a>
                @endif
            
        </nav>
    @endif
        @if(session('name')!='')
        <p>Utilisateur Connecté : {{session('name')}}</p>
           <!-- {{session('firstConnect')}}  -->

        <form method="POST" action="/SignOut">
            @csrf
            <button type="submit" class='btn'>Logout</button>
            </form>
   
        @endif 


</div> 





