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

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

class mits_userlike {
  var $code, $title, $description, $enabled;

  function __construct() {
    $this->code = 'mits_userlike';
    $this->name = 'MODULE_' . strtoupper($this->code);
    $this->version = '1.0';
    $this->title = constant($this->name . '_TITLE') . ' - v' . $this->version;
    $this->description = constant($this->name . '_DESCRIPTION');
    $this->sort_order = defined($this->name . '_SORT_ORDER') ? constant($this->name . '_SORT_ORDER') : 0;
    $this->enabled = (defined($this->name . '_STATUS') && constant($this->name . '_STATUS') == 'true') ? true : false;

    $version_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_VERSION'");
    if (xtc_db_num_rows($version_query)) {
      xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $this->version . "' WHERE configuration_key = '" . $this->name . "_VERSION'");
    } elseif (defined($this->name . '_STATUS')) {
      xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())");
    }

    if (defined('MODULE_COOKIE_CONSENT_STATUS') && MODULE_COOKIE_CONSENT_STATUS == 'true' && defined($this->name . '_ORGANISATIONS_ID') && constant($this->name . '_ORGANISATIONS_ID') != '' && defined($this->name . '_COOKIE_CONSENT_PURPOSEID') && constant($this->name . '_COOKIE_CONSENT_PURPOSEID') != '') {
      if (xtc_db_num_rows(xtc_db_query("SHOW TABLES LIKE '" . TABLE_COOKIE_CONSENT_COOKIES . "'"))) xtc_db_query("UPDATE " . TABLE_COOKIE_CONSENT_COOKIES . " SET cookies_list = REPLACE(cookies_list, '{organization-id}', '" . constant($this->name . "_ORGANISATIONS_ID") . "'), cookies_description = REPLACE(cookies_description, '{organization-id}', '" . constant($this->name . "_ORGANISATIONS_ID") . "') WHERE cookies_id = " . constant($this->name . "_COOKIE_CONSENT_PURPOSEID"));
    }
  }

  function process($file) {

  }

  function display() {
    return array(
      'text' => '<br>' . xtc_button(BUTTON_SAVE) . '&nbsp;' .
        xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_MODULE_EXPORT, 'set=' . $_GET['set'] . '&module=' . $this->code))
    );
  }

  function check() {
    if (!isset($this->_check)) {
      $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_STATUS'");
      $this->_check = xtc_db_num_rows($check_query);
    }
    return $this->_check;
  }

  function install() {
    $purpose_id = '';
    $userlike_in_cookie_consent = 'false';

    if (defined('MODULE_COOKIE_CONSENT_STATUS') && MODULE_COOKIE_CONSENT_STATUS == 'true') {
      $languages = array();
      $qr = xtc_db_query("SELECT * FROM " . TABLE_LANGUAGES);
      while ($row = xtc_db_fetch_array($qr)) {
        $languages[$row['languages_id']] = $row;
      }

      $next_id_query = xtc_db_query("SELECT max(cookies_id) as cookies_id FROM " . TABLE_COOKIE_CONSENT_COOKIES);
      $next_id = xtc_db_fetch_array($next_id_query);
      $purpose_id = $cookies_id = $next_id['cookies_id'] + 1;
      $userlike_in_cookie_consent = 'true';

      if (xtc_db_num_rows(xtc_db_query("SHOW TABLES LIKE '" . TABLE_COOKIE_CONSENT_COOKIES . "'"))) {
        $defined_cookies = array();

        $defined_cookies[] = array(
          'id'         => $cookies_id,
          'category'   => 2,
          'name'       => array(
            1 => 'UserLike Live Chat',
            2 => 'UserLike Live Chat'
          ),
          'desc'       => array(
            1 => 'To ensure the functionality of our software, we save a cookie about the application status in the end-user\'s browser. This cookie is technically essential and will populate data only when the chat is being used. Before that its only function is to offer the chat service. This cookie is on your domain and can\'t be used by Userlike to track your visitors in any way.
						
The Userlike Messenger creates a cookie: uslk_umm_{organization-id}_s

In addition to the technical details of the widget status and messenger status, the cookie contains IDs of existing contacts so they can be recognized when visiting again.

Chat-Provider: Userlike UG, Probsteigasse 44-46, D-50670 Köln
Privacy policy: https://www.userlike.com/en/terms#privacy-policy
',
            2 => 'Damit das Userlike Widget funktionieren kann, wird im User-Browser ein Cookie gespeichert. Dieses Cookie ist technisch notwendig und wird erst zu dem Zeitpunkt mit Daten gefüllt, wenn der Chat genutzt wird. Davor hat es eine rein technische Aufgabe, um das Angebot eines Service-Chats erst zu ermöglichen. Dieses Cookie befindet sich auf Ihrer Domain und kann von Userlike nicht verwendet werden, um Ihre Besucher zu tracken.

Der Userlike Chat erstellt ein Cookie:	uslk_umm_{organization-id}_s

Neben technischen Details zum Messenger-Status enthält das Cookie IDs zu existierenden Kontakten, damit diese wiedererkannt werden können.

Chat-Betreiber: Userlike UG, Probsteigasse 44-46, D-50670 Köln
Datenschutzerklärung: https://www.userlike.com/de/terms#privacy-policy
'
          ),
          'cookies'    => 'uslk_s,uslk_e,uslk_umm_{organization-id}_s',
          'sort_order' => 1,
          'status'     => 1,
          'fixed'      => 0
        );

        foreach ($defined_cookies as $row) {
          foreach ($languages as $language_id => $language) {
            if (array_key_exists($language_id, $row['name'])) {
              $sql_data = array(
                'cookies_id'          => $row['id'],
                'categories_id'       => $row['category'],
                'cookies_name'        => decode_utf8($row['name'][$language_id], $language['language_charset']),
                'cookies_description' => decode_utf8($row['desc'][$language_id], $language['language_charset']),
                'cookies_list'        => $row['cookies'],
                'sort_order'          => $row['sort_order'],
                'languages_id'        => $language_id,
                'status'              => $row['status'],
                'date_added'          => 'now()',
                'fixed'               => $row['fixed']
              );
              xtc_db_perform(TABLE_COOKIE_CONSENT_COOKIES, $sql_data);
            }
          }
        }
      }
    }

    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_STATUS', 'true', 6, 1, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_WIDGET_CODE', '', 6, 2, NULL, now());");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_ORGANISATIONS_ID', '', 6, 3, NULL, now());");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_IN_COOKIE_CONSENT', '" . $userlike_in_cookie_consent . "', 6, 4, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_COOKIE_CONSENT_PURPOSEID', '" . $purpose_id . "', 6, 5, NULL, now());");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())");
  }

  function remove() {
    xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '" . $this->name . "_%'");
    xtc_db_query("DELETE FROM " . TABLE_COOKIE_CONSENT_COOKIES . " WHERE cookies_id = " . constant($this->name . '_COOKIE_CONSENT_PURPOSEID'));
  }

  function keys() {
    return array(
      $this->name . '_STATUS',
      $this->name . '_WIDGET_CODE',
      $this->name . '_ORGANISATIONS_ID',
      $this->name . '_IN_COOKIE_CONSENT',
      $this->name . '_COOKIE_CONSENT_PURPOSEID'
    );
  }

}