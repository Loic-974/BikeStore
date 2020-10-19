<nav id="header">

<h1>BikeStore</h1>
@if(session('name')!='')
<p>Utilisateur Connecté : {{session('name')}}</p>
<!-- <p>deconnexion</p> -->
@endif


</nav>