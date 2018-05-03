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

$string['cantreadcsv']  = 'Unable to read CSV file';
$string['cohortdisabled'] = 'The "Cohort sync" enrolment plugin is disabled. Cannot sync cohort "{$a->cohort}" as enrolment method.';
$string['cohortdisabledwarning'] = 'The "Cohort sync" enrolment plugin is disabled. Enable it to use this plugin.';
$string['cohortnotfound'] = 'Line {$a->line}: Cohort "{$a->target}" not found';
$string['csvfile'] = 'Select CSV file';
$string['csvfile_help'] = 'The format of the file should be as follows:

* Each line of the file contains one record.
* Each record is a series of data separated by commas.
* Required fields are operation, parent course idnumber, target course idnumber, disabled, group.
* Allowed operations are add, del, mod';
$string['heading'] = 'Upload course enrolment methods from a CSV file';
$string['invalidmethod'] = 'Line {$a->line}: Invalid method "{$a->method}"';
$string['invalidop'] = 'Line {$a->line}: Invalid operation "{$a->op}"';
$string['metadisabled'] = 'The "Course meta link" enrolment plugin is disabled. Cannot add meta link to "{$a->parent}" as enrolment method';
$string['metadisabledwarning'] = 'The "Course meta link" enrolment plugin is disabled. Enable it to use this plugin.';
$string['musthavefile'] = 'You must select a file';
$string['nodir'] = '{$a} does not exist or is not writable. Please check folder permissions.';
$string['parentnotfound'] = 'Line {$a->line}: Parent "{$a->parent}" not found';
$string['pluginname'] = 'Upload enrolment methods';
$string['pluginname_help'] = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['reladded'] = '"{$a->target}" ({$a->targetid}) successfully linked to "{$a->parent}" ({$a->parentid})';
$string['reladderror'] = 'Error linking "{$a->target}" ({$a->targetid}) to "{$a->parent}" ({$a->parentid})';
$string['relalreadyexists'] = '"{$a->target}" ({$a->targetid}) already linked to "{$a->parent}" ({$a->parentid})';
$string['reldeleted'] = '"{$a->target}" ({$a->targetid}) unlinked from "{$a->parent}" ({$a->parentid})';
$string['reldoesntexist'] = '"{$a->target}" ({$a->targetid}) not linked to "{$a->parent}" ({$a->parentid}), so can\'t be removed';
$string['relmodified'] = '"{$a->target}" ({$a->targetid}) modified';
$string['targetisparent'] = '"{$a->target}" ({$a->targetid}) is a parent of "{$a->parent}" ({$a->parentid}), so cannot be added as its target.';
$string['targetnotfound'] = 'Line {$a->line}: Target course not found';
$string['toofewcols'] = 'Line {$a}: Too few columns, expecting 6.';
$string['toomanycols'] = 'Line {$a}: Too many columns, expecting 6.';
$string['uploadcsvfile'] = 'Upload CSV file';
$string['uploadcsvfilerequired'] = 'CSV file required';
