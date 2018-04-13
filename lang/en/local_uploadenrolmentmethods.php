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


$string['cantreadcsv']  = 'Unable to read CSV file';
$string['childisparent'] = '{$a->child} is a parent of {$a->parent}, so cannot be added as its child.';
$string['childnotfound'] = 'Line {$a->line}: Child Course not found';
$string['cohortdisabled'] = 'The "Cohort sync" enrolment plugin is disabled. Enable it to use this plugin.';
$string['csvfile'] = 'Select CSV file';
$string['csvfile_help'] = 'The format of the file should be as follows:

* Each line of the file contains one record.
* Each record is a series of data separated by commas.
* Required fields are operation, parent course idnumber, child course idnumber, disabled, group.
* Allowed operations are add, del, mod';
$string['heading'] = 'Upload course enrolment methods from a CSV file';
$string['invalidop'] = 'Line {$a->line}: Invalid operation {$a->op}';
$string['metadisabled'] = 'The "Course meta link" enrolment plugin is disabled. Enable it to use this plugin.';
$string['musthavefile'] = 'You must select a file';
$string['nodir'] = '{$a} does not exist or is not writable. Please check folder permissions.';
$string['parentnotfound'] = 'Line {$a->line}: Parent Course not found';
$string['pluginname'] = 'Upload enrolment methods';
$string['pluginname_help'] = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['reladded'] = '{$a->child} sucessfully linked to {$a->parent}';
$string['reladderror'] = 'Error linking {$a->child} to {$a->parent}';
$string['relalreadyexists'] = '{$a->child} already linked to {$a->parent}';
$string['reldeleted'] = '{$a->child} unlinked from {$a->parent}';
$string['reldoesntexist'] = '{$a->child} not linked to {$a->parent}, so can\'t be removed';
$string['relmodified'] = '{$a->child} modified';
$string['toofewcols'] = 'Line {$a}: Too few columns, expecting 5.';
$string['toomanycols'] = 'Line {$a}: Too many columns, expecting 5.';
$string['uploadcsvfile'] = 'Upload CSV file';
$string['uploadcsvfilerequired'] = 'CSV file required';
