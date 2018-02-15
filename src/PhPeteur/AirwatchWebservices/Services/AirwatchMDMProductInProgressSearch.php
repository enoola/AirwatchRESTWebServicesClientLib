<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 07/02/2018
 * Time: 21:25
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Get Provisioning In-Progress Devices
 * Functionality – Returns the details of the device for which Provisioning is In-Progress.
 */
class AirwatchMDMProductInProgressSearch extends AirwatchServicesSearch
{
    const URI_PRODUCTS_INPROGRESS_SEARCH = '/api/mdm/products';
    const CLASS_SENTENCE_AIM = 'Returns the details of the device for which Provisioning is In-Progress.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'product id',
            'page' => 'Page number',
            'pagesize' => 'Page size'
        ] ;

        parent::__construct($cfg,'default_mdmproductfailed_fields_to_show','possible_mdmproductfailed_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_PRODUCTS_INPROGRESS_SEARCH ;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_PRODUCTS_INPROGRESS_SEARCH .'/'.$id . '/inprogress';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}