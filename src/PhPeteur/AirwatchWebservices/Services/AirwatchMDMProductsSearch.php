<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 18/01/2018
 * Time: 20:46
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMProductsSearch extends AirwatchServicesSearch
{
    const URI_MDM_PRODUCTS_SEARCH = AirwatchMDMProducts::URI_MDM_PRODUCTS . '/search';

    
    public function __construct($cfg)
    {

        $arPossibleParams = [ 'name'=> 'Smart Group name',
            'page'=>'Page number',
            'pagesize'=>'Records per page',
        ];
        //'assignments'=>'???'KO
        //'Igid'=> '??' KO

        parent::__construct($cfg,'default_product_fields_to_show', 'possible_product_fields_to_show',$arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Products');

        $this->_uri = self::URI_MDM_PRODUCTS_SEARCH;

    }

}