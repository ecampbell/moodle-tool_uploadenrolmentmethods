<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'local_uploadenrolmentmethods', language 'en', branch 'MOODLE_30_STABLE'
 *
 * @package    local_uploadenrolmentmethods
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Upload enrolment methods';
$string['pluginname_help'] = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['credit'] = 'Eoin Campbell - <a href="http://www.it-tallaght.ie/">Institute of Technology Tallaght</a>';
$string['csvfile'] = 'CSV file';
$string['csvfile_help'] = 'The format of the file should be as follows:

* Each line of the file contains one record.
* Each record is a series of data separated by commas.
* Required are operation, shortname, method';

$string['heading'] = 'Upload course enrolment methods from a CSV file';
$string['uploadcsvfile'] = 'Upload CSV file';
$string['uploadcsvfilerequired'] = 'CSV file required';

$string['errorsend'] = 'Upload:The test email message could not be delivered to the mail server.</p><p><strong>Recommendation:</strong></p><p>Check your Moodle <a href="{$a}" target="blank">Email settings</a>. For more help, see the FAQ section in the documentation.';
$string['errorcommunications'] = 'Upload:Moodle could not communicate with your mail server.</p><p><strong>Recommendation:</strong></p><p>Start by checking your Moodle <a href="{$a}" target="_blank">SMTP mail settings</a>.</p><p>If they look correct, check your SMTP Server and/or firewall settings to ensure that they are configured to accept SMTP connections from your Moodle web server and from your no-reply email address. For more help, see the FAQ section in the documentation.';
$string['sendmethod'] = 'Upload:Email send method';
$string['sentmail'] = 'Upload:Moodle successfully delivered the test message to the SMTP mail server.';
$string['sentmailphp'] = 'Upload:The Moodle test message was successfully accepted by PHP Mail.';
$string['registered'] = 'Upload:Registered user ({$a}).';
$string['notregistered'] = 'Upload:Not registered or not logged in.';
$string['phpmethod'] = 'Upload:PHP default method';
$string['smtpmethod'] = 'Upload:SMTP hosts: {$a}';
$string['message'] = 'Upload:<p>This is a test message. Please disregard.</p>
<p>If you received this email, it means that you have successfully configured your Moodle site\'s email settings.</p>
<hr><p><strong>Additional User Information</strong></p>
<ul>
<li><strong>Registration status :</strong> {$a->regstatus}</li>
<li><strong>Preferred language :</strong> {$a->lang}</li>
<li><strong>User\'s web browser :</strong> {$a->browser}</li>
<li><strong>Message submitted from :</strong> {$a->referer}</li>
<li><strong>Moodle version :</strong> {$a->release}</li>
<li><strong>User\'s IP address :</strong> {$a->ip}</li>
</ul>';
