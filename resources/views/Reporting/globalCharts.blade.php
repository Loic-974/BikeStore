

<div class='containerDataReporting'>

    <div class="containerReporting">
       
        <div class='partReporting'>
            <h4> Evolution Vente </h4>
            <canvas id="weeklyChart" width="800" height="400"></canvas>

        </div>
        <div class='partReporting'>
            <h4> Evolution CA HT</h4>
            <canvas id="monthlyChart" width="800" height="400"></canvas>

        </div>
        <div class='partReporting'>
            <h4> Poids Promo </h4>
            <canvas id="promoChart" width="800" height="400"></canvas>

        </div>
        <div class='partReporting'>
            <h4> Suivi Vente Semaine/Mois </h4>
            <canvas id="vueDesVentes" width="800" height="400"></canvas>

        </div>

    </div>


    <div class='containerFiltre'>
        <h4> Choix de la période </h4>
        <p> Selectionnez un jour </p>
        <p> Les périodes seront calculées à partir du jour sélectionné </p>
        <input type='date' value='' placeholder='Selectionnez une date' id="dateForReporting">
    </div>

</div>