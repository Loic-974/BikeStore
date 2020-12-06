
<div id="header">


        <h1>BikeStore</h1>
        @if(session('name')!='')
        <p>Utilisateur Connecté : {{session('name')}} 
            <!-- {{session('firstConnect')}}  -->
        

        </p>

        <form method="POST" action="/SignOut">
            @csrf
            <button type="submit">Logout</button>
            </form>
        <!-- <p>deconnexion</p> -->
        @endif


</div>