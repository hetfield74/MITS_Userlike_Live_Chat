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

define('MODULE_MITS_USERLIKE_TITLE', 'MITS Userlike Live Chat <span style="white-space:nowrap;">&copy; by <span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (<a href="https://www.merz-it-service.de/" target="_blank">MerZ IT-SerVice</a>)</span></span>');
define('MODULE_MITS_USERLIKE_DESCRIPTION', '
   <div> 
    <a href="https://www.merz-it-service.de/" target="_blank">
      <img src="' . xtc_href_link_admin(DIR_WS_IMAGES . 'merz-it-service.png') . '" border="0" alt="" style="display:block;max-width:100%;height:auto;" />
    </a><br />
    <h3>Userlike Live Chat</h3>
    <div>    
      <p>Mit diesem Modul k&ouml;nnen Sie den Userlike Live Chat in die modified eCommerce Shopsoftware integrieren.</p>
      <ul>
        <li>Einfache Integration der Chatsoftware in das Shopsystem durch dieses Modul.</li>
        <li>Vorbereitet zur Einbindung in den Cookie Consent der modified eCommerce Shopsoftware.</li>
        <li>DSGVO-konforme Chat-Software, entwickelt und gehostet in Deutschland.</li>
      </ul>
			<div style="text-align:center;"><a href="https://www.userlike.com/?ref=9a05c32f-709d-412a-8b7c-9edd38261bac" target="_blank" class="button" onclick="this.blur();">Jetzt auf Userlike registrieren</a></div>
      <p>Bei Fragen, Problemen oder W&uuml;nschen zu diesem Modul oder auch zu anderen Anliegen rund um die modified eCommerce Shopsoftware nehmen Sie einfach Kontakt zu uns auf:</p> 
      <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Kontaktseite auf MerZ-IT-SerVice.de</strong></a></div>
    </div>
  </div>
');
define('MODULE_MITS_USERLIKE_STATUS_TITLE', 'Modul aktivieren?');
define('MODULE_MITS_USERLIKE_STATUS_DESC', 'Das Modul MITS Userlike aktivieren?');
define('MODULE_MITS_USERLIKE_WIDGET_CODE_TITLE','Widget-Code');
define('MODULE_MITS_USERLIKE_WIDGET_CODE_DESC','Geben Sie hier den Widget-Code ein, den Sie f&uuml;r ihr Website-Widget von Userlike erhalten haben.<br /><small>Zu finden ist dieser im Userlike-Dashboard unter <i>Kanäle</i> > <i>Website-Widgets</i>. W&auml;hlen sie das entsprechende Widget zum Bearbeiten aus. Im Widget-Editor klicken sie bitte auf den Tab <strong>INSTALLIEREN</strong> und dann auf <i>JavaScript-Widget-Code</i>. Dort finden sie den Widget-Code, den sie dann bitte komplett per Copy&Paste hier einf&uuml;gen. Hier gibt es auch eine Anleitung von Userlike: <a href="https://userlike-de.helpscoutdocs.com/article/747-wo-finde-ich-den-widget-code-und-den-widget-key" target="_blank">Wo finde ich den Widget-Code?</a></small>');
define('MODULE_MITS_USERLIKE_ORGANISATIONS_ID_TITLE', 'Organisations-ID');
define('MODULE_MITS_USERLIKE_ORGANISATIONS_ID_DESC', 'Ihre Organisations-ID finden Sie in Ihrem Dashboard unter Account > Organisationen. Wenn Sie auf die Organisation klicken, steht die ID am Ende der URL.');
define('MODULE_MITS_USERLIKE_IN_COOKIE_CONSENT_TITLE', 'Cookie Consent Integration');
define('MODULE_MITS_USERLIKE_IN_COOKIE_CONSENT_DESC', 'Ist im Shop der mitgelieferte Cookie-Consent aktiviert und soll der Userlike Lice Chat darin integriert werden, dann w&auml;hlen sie hier bitta <i>ja (true)</i> aus.');
define('MODULE_MITS_USERLIKE_COOKIE_CONSENT_PURPOSEID_TITLE', 'Cookie Consent PURPOSE-ID');
define('MODULE_MITS_USERLIKE_COOKIE_CONSENT_PURPOSEID_DESC', 'Falls die Cookie Consent Integration auf <i>ja (true)</i> steht, dann muss hier die entsprechende PURPOSE-ID eingetragen werden. Im Regelfall &uuml;bernimmt das Modul die Installation in den Cookie Consent. In diesem Fall ist bereits eine PURPOSE-ID eingetragen. Bitte checken sie die korrekte Eintragung im Cookie Consent auch auf die rechtlichen und technischen Vorschriften, da sich die rechtlichen und technischen Gegebenheiten st&auml;ndig ver&auml;ndern können. F&uuml;r die Korrektheit der Integration kann keine Haftung &uuml;bernommen werden. ');
