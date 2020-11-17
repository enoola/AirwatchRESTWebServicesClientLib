<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 20/02/2018
 * Time: 08:39
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Get Product ID
 * Functionality – Get specified Product.
 */
class AirwatchMDMProductSearch extends AirwatchServicesSearch
{
    const URI_MDM_PRODUCT_SEARCH = AirwatchMDMProducts::URI_MDM_PRODUCTS ;
    const CLASS_SENTENCE_AIM = 'Get specified Product.';

    public function __construct($cfg)
    {

        $arPossibleParams = [ 'id'=> 'Product list ID.' ];
        //'assignments'=>'???'KO
        //'Igid'=> '??' KO

        parent::__construct($cfg,'default_mdmproductsearch_fields_to_show', 'possible_mdmproductsearch_fields_to_show',$arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_PRODUCT_SEARCH;

    }

    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_PRODUCT_SEARCH .'/'.$id ;

        $resquery = parent::Search(null, $szContentType);
        
        return ($resquery);
    }
}