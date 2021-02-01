 <div id="header">

<h1>BikeStore</h1>
      
        <nav id='navContainer'>
            <ul>       
                <a href='/production'>Production</a>
                @if(session('roleManager')<(4))
                 <a href='/vente'>Vente</a>
                @endif
                @if(session('roleManager')<(3))
                    <a href='/reporting'>Reporting</li>
                @endif
                @if(session('roleManager')<(2))
                    <a href='/administration'>Administration</a>
                @endif
            </ul>
        </nav>
   
        @if(session('name')!='')
        <p>Utilisateur Connecté : {{session('name')}} 
           <!-- {{session('firstConnect')}}  -->
       </p>

        <form method="POST" action="/SignOut">
            @csrf
            <button type="submit">Logout</button>
            </form>
   
        @endif 


</div> 





