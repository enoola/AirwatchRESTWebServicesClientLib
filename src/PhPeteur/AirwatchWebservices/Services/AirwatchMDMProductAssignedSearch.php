<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 07/02/2018
 * Time: 22:14
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Get Provisioning Assigned Devices
 * Functionality – Returns the details of the device for which provisioning is assigned.
 */
class AirwatchMDMProductAssignedSearch extends AirwatchServicesSearch
{
    const URI_PRODUCTS_ASSIGNED_SEARCH = '/api/mdm/products';


    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'product id',
            'seensince' => 'Time stamp when the device was last seen',
            'lastjobupdatefrom' => 'Status of the device previous job',
            'page' => 'Page number',
            'pagesize' => 'Page size'
        ];

        parent::__construct($cfg,'default_mdmproductassigned_fields_to_show','possible_mdmproductassigned_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_PRODUCTS_ASSIGNED_SEARCH ;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_PRODUCTS_ASSIGNED_SEARCH .'/'.$id . '/assigned';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}