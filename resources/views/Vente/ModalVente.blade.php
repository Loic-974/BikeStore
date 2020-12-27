
    <div class ='containerInfoModalVente' id='infoClient'>  

            <h5> Informations Client </h5>
            <input type='texte' id='LastNameClient' class='form-control' name='LastName' value='' placeholder='Nom Client' required>
            <span id='searchListName' class='searchList'></span>                          
            <input type='texte' id='FirstNameClient' name='FirstName' class='form-control' value='' placeholder='Prénom Client' required>              
            <input type='number' id='Phone' name='Phone' class='form-control' value='' placeholder='Téléphone CLient' required>
            <input type='email' id='Email' name='Email'class='form-control' value='' placeholder='Email Client'required>   
            <input type='texte' id='adresse' name='Street' class='form-control' value='' placeholder='Adresse Client'required>     
            <input type='texte' id='ville' name='City' class='form-control' value='' placeholder='Ville Adresse'required>
            <input type='number' id='codePostal' name='ZipCode' class='form-control' value='' placeholder='Code Postal'required>
            <input type='texte' id='pays' name='State' class='form-control' value='' placeholder='Pays'>    
    </div>
    <div class='containerItem'>
        <h5> Informations Client </h5>
        <input type='text' value='' id='ProductOrder' placeholder='Chercher un produit' class='form-control'>
        <span id='searchProductOrder' class='searchList'></span>   
        <div class='orderItemTable'>
            <table id="orderItem">
                <thead>
                    <tr>
                        <th> Nom du produit </th>
                        <th> Quantité </th>
                        <th> Price </th>
                        <th> Reduction </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <input type='button' value='Confirmer la commande' class='btn-primary' id='validOrder'>
    </div>

   
