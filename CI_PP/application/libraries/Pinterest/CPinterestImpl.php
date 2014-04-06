<?php

/**
 * Description of OEmbedImpl
 *
 * @author Pavol Daňo
 */
require_once('OEmbed/COEmbedImpl.php');

require_once('ICPinRequiredResponseConstants.php');
require_once('ICPinOptionalResponseConstants.php');

require_once('CPinRequiredKeys.php');
require_once('CPinOptionalKeys.php');

require_once('ICPinGenderValueConstants.php');
require_once('ICPinAvailabilityValueConstants.php');

require_once('ICPinterest.php');

class CPinterestImpl extends COEmbedImpl implements ICPinterest{

    public function __construct($params) {
        parent::__construct($params);
    }

    public function add_pinterest_required_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {
            if (!CPinRequiredKeys::isValidValue('CPinRequiredKeys', $key)) {
                throw new CInvalidRequiredPinKeyException('Key "' . $key . '" does not belong to obligatory keys.');
            }

            $response_array[$key] = $value;
        }

        return $response_array;
    }

    public function add_pinterest_optional_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {
            if (!CPinOptionalKeys::isValidValue('CPinOptionalKeys', $key)) {
                throw new CInvalidOptionalPinKeyException('Key "' . $key . '" does not belong to optional keys.');
            }

            $response_array[$key] = $value;
        }

        return $response_array;
    }

    public function add_pinterest_any_response_items($response_array, $key_value_items_array) {
        return parent::add_oembed_any_response_items($response_array, $key_value_items_array);
    }
}

?>
