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
$string['csvcomment']            = '{$a->line} {$a->linenum} [Comment]: {$a->skipped}.';
$string['csvfile']               = '';
$string['csvfile_help']          = 'The format of the CSV file must be as follows:

* Lines beginning with a # or ; character are comments, and skipped.
* Each line of the file contains one record.
* Each record is a series of data in a fixed order separated by commas.
* The fields are: operation, enrolment method, target course shortname, parent course shortname or cohort idnumber, disabled status, group name[, role].
* All fields are required except role, which can be omitted for backwards compatibility.
* The operations are add, del(ete) and upd(ate).
* The supported enrolment methods are meta and cohort.
* The disabled status values are 1 (disabled) or 0 (enabled).
* Students enrolled via the method will be placed in the group specified in the group name field.
  The group will be created if it doesn\'t already exist.
* The role field must be a valid role name such as editingteacher, student, etc.';
$string['heading']               = 'Upload course enrolment methods from a CSV file';
$string['invalidmethod']         = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->method}]: Invalid method.';
$string['invalidop']             = '{$a->line} {$a->linenum} [{$a->op} {$a->method}]: Invalid operation.';
$string['methoddisabled']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: {$a->disabled}. {$a->skipped}.';
$string['methoddisabledwarning'] = 'Enrolment method "{$a->methodname}": {$a->disabled}.';
$string['parentnotfound']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: Meta course "{$a->parentname}" not found. {$a->skipped}.';
$string['pluginname']            = 'Upload enrolment methods';
$string['pluginname_help']       = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['privacy:metadata']      = 'The Upload enrolment methods administration tool does not store personal data.';
$string['reladded']              = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: Course "{$a->targetname}" ({$a->targetid}) linked to "{$a->parentname}" ({$a->parentid}) with name "{$a->instancename}". {$a->status}.';
$string['reladderror']           = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: Error linking "{$a->targetname}" ({$a->targetid}) to "{$a->parentname}" ({$a->parentid}). {$a->skipped}.';
$string['relalreadyexists']      = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: "{$a->targetname}" ({$a->targetid}) already linked to "{$a->parentname}" ({$a->parentid}). {$a->skipped}.';
$string['reldeleted']            = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: Deleted "{$a->instancename}" method from "{$a->targetname}" ({$a->targetid}).';
$string['reldoesntexist']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: "{$a->targetname}" ({$a->targetid}) not linked to "{$a->parentname}" ({$a->parentid}), so cannot be removed. {$a->skipped}.';
$string['relupdated']            = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: Updated "{$a->instancename}" method in "{$a->targetname}" ({$a->targetid}). {$a->status}.';
$string['targetisparent']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: "{$a->targetname}" ({$a->targetid}) is a parent of "{$a->parentname}" ({$a->parentid}), so cannot be added as its target. {$a->skipped}.';
$string['targetnotfound']        = '{$a->line} {$a->linenum} [{$a->oplabel} {$a->methodname}]: Unknown course "{$a->targetname}". {$a->skipped}.';
$string['toofewcols']            = '{$a->line} {$a->linenum}: Too few columns, expecting 6/7. {$a->skipped}.';
$string['toomanycols']           = '{$a->line} {$a->linenum}: Too many columns, expecting 6/7. {$a->skipped}.';
$string['unknownrole']           = '{$a->line} {$a->linenum}: [{$a->oplabel} {$a->methodname}]: {$a->unknownrole}. {$a->skipped}.';
