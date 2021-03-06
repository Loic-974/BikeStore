<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
     '/accueil/updatePwd',
     '/accueil',

 //----------------------------------------------------------//
 //------------------- PRODUCTION ---------------------------//    
 //----------------------------------------------------------//
     '/production',
// -------------- Production Brand --------------------//
     '/production/postBrand',
     '/production/updateBrand',
     '/production/deleteBrand',
// -------------- Production Categorie --------------------//
     '/production/postCategory',
     '/production/updateCategory',
     '/production/deleteCategory',

 // -------------- Production Produit --------------------//
    '/production/postProduct',    
    '/production/updateProduct',
    '/production/deleteProduct',
 // -------------- Production Stock --------------------//
    '/production/insertStock',
    '/production/updateStock',

//----------------------------------------------------------//
//------------------------ VENTE ---------------------------//    
//----------------------------------------------------------//


'/vente/newOrder',
'/vente/updateCustomer',
'/vente/getFacture',


//----------------------------------------------------------//
//-------------------- Notification ------------------------//    
//----------------------------------------------------------//

'/notificationUpdate',

'/Reporting/GetReporting',

    ];
}
