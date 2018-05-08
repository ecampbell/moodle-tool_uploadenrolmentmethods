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
 * Strings for component 'tool_uploadenrolmentmethods', language 'en'
 *
 * @package    tool_uploadenrolmentmethods
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cohortnotfound']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Cohort "{$a->parentname}" not found. {$a->skipped}.';
$string['csvfile'] = '';
$string['csvfile_help']          = 'The format of the CSV file must be as follows:

* Each line of the file contains one record.
* Each record is a series of data separated by commas.
* Required fields are operation, enrolment method, target course shortname, parent course shortname or cohort idnumber, disabled, group.
* Allowed methods are meta and cohort.
* Allowed operations are add, del, upd';
$string['heading']               = 'Upload course enrolment methods from a CSV file';
$string['invalidmethod']         = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Invalid method.';
$string['invalidop']             = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Invalid operation "{$a->op}".';
$string['methoddisabled']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: "{$a->method}" {$a->disabled}. {$a->skipped}.';
$string['methoddisabledwarning'] = 'Enrolment method "{$a->method}": {$a->disabled}.';
$string['parentnotfound']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Meta course "{$a->parentname}" not found. {$a->skipped}.';
$string['pluginname']            = 'Upload enrolment methods';
$string['pluginname_help']       = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['reladded']              = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: "{$a->targetname}" ({$a->targetid}) successfully linked to "{$a->parentname}" ({$a->parentid}) with name "{$a->instancename}". {$a->status}.';
$string['reladderror']           = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Error linking "{$a->targetname}" ({$a->targetid}) to "{$a->parentname}" ({$a->parentid}). {$a->skipped}.';
$string['relalreadyexists']      = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: "{$a->targetname}" ({$a->targetid}) already linked to "{$a->parentname}" ({$a->parentid}). {$a->skipped}.';
$string['reldeleted']            = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Deleted "{$a->instancename}" method from "{$a->targetname}" ({$a->targetid}).';
$string['reldoesntexist']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: "{$a->targetname}" ({$a->targetid}) not linked to "{$a->parentname}" ({$a->parentid}), so can\'t be removed. {$a->skipped}.';
$string['relupdated']            = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Updated "{$a->instancename}" method in "{$a->targetname}" ({$a->targetid}). {$a->status}.';
$string['targetisparent']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: "{$a->targetname}" ({$a->targetid}) is a parent of "{$a->parentname}" ({$a->parentid}), so cannot be added as its target. {$a->skipped}.';
$string['targetnotfound']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Unknown course "{$a->targetname}". {$a->skipped}.';
$string['toofewcols']            = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Too few columns, expecting 6. {$a->skipped}.';
$string['toomanycols']           = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Too many columns, expecting 6. {$a->skipped}.';
