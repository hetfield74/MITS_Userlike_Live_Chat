<?php
/**
 * --------------------------------------------------------------
 * File: mits_userlike.php
 * Date: 18.01.2023
 * Time: 15:38
 *
 * Author: Hetfield
 * Copyright: (c) 2023 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if (defined('MODULE_MITS_USERLIKE_STATUS') && MODULE_MITS_USERLIKE_STATUS == 'true'
  && defined('MODULE_MITS_USERLIKE_WIDGET_CODE') && !empty(MODULE_MITS_USERLIKE_WIDGET_CODE)) {
  if (defined('MODULE_MITS_USERLIKE_IN_COOKIE_CONSENT') && MODULE_MITS_USERLIKE_IN_COOKIE_CONSENT == 'true'
        && defined('MODULE_MITS_USERLIKE_COOKIE_CONSENT_PURPOSEID') && !empty(MODULE_MITS_USERLIKE_COOKIE_CONSENT_PURPOSEID)
        && defined('MODULE_COOKIE_CONSENT_STATUS') && MODULE_COOKIE_CONSENT_STATUS == 'true'
        && (in_array(MODULE_MITS_USERLIKE_COOKIE_CONSENT_PURPOSEID, $_SESSION['tracking']['allowed']) || defined('COOKIE_CONSENT_NO_TRACKING'))) {
    $userlike_find = array(
          ' type="text/javascript" ',
          ' src="'
    );
    $userlike_replace = array(
          ' data-type="text/javascript" type="as-oil" data-purposes="' . MODULE_MITS_USERLIKE_COOKIE_CONSENT_PURPOSEID . '" data-managed="as-oil" ',
          ' data-src="',
    );
    $uselike_code = str_replace($userlike_find, $userlike_replace,MODULE_MITS_USERLIKE_WIDGET_CODE);
  } else {
    $uselike_code = MODULE_MITS_USERLIKE_WIDGET_CODE;
  }
  echo $uselike_code;
}