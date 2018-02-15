<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 07/02/2018
 * Time: 12:49
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Get Provisioning Failed Devices
 * Functionality – Returns the details of the devices for which Provisioning is Failed.
 */
class AirwatchMDMProductFailedSearch extends AirwatchServicesSearch
{
    const URI_PRODUCTS_FAILED_SEARCH = '/api/mdm/products';
    const CLASS_SENTENCE_AIM = 'Returns the details of the devices for which Provisioning is Failed.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'product id',
                'page' => 'Page number',
                'pagesize' => 'Page size'
        ] ;

        parent::__construct($cfg,'default_mdmproductfailed_fields_to_show','possible_mdmproductfailed_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_PRODUCTS_FAILED_SEARCH ;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_PRODUCTS_FAILED_SEARCH .'/'.$id . '/failed';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}