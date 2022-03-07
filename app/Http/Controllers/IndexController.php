<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Asciisd\Zoho\Facades\ZohoManager;
use Asciisd\Zoho\ZohoModule;
use zcrmsdk\crm\crud\ZCRMModule;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\exception\ZCRMException;
use Asciisd\Zoho\CriteriaBuilder;

class IndexController extends Controller
{

    /**
     * TESTTING ZOHO CRM  */    
    
    
    // Documentar despues --- 
    // Error 1 encontrado -- email y variables de entorno deben estar bien puestas
    // Error 2 encontrado -- offset 0 -- Error certificado ssl se debe pegar en la ubicacion dque indique el php.ini  een la linea 'curl.cainfo='  este problema se debe a que zoho solicita una conexion segura

    /**
     * Show the index for a given user.
     *
     * @param  none
     * @return \Illuminate\index\index
     */
    public function index()
    {

        // Se busca en la API Contacts o Interesados
        $rut = '16.478.729-k';

        $contact = ZohoManager::useModule('Contacts')->searchRecordsByWord($rut);

        $entityId = $contact[0]->getEntityId();

        $builder = CriteriaBuilder::where('Contact_Name', $entityId);
        $deals = ZohoManager::useModule('Deals')->searchRecordsByCriteria($builder->toString());

        dd($contact, $deals);

        return view('index.index');

    }
}
