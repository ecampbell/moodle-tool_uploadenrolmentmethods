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

$string['cohortnotfound'] = '{$a->line} {$a->linenum}: Cohort "{$a->name}" not found';
$string['csvfile_help'] = 'The format of the CSV file must be as follows:

* Each line of the file contains one record.
* Each record is a series of data separated by commas.
* Required fields are operation, enrolment method, target course idnumber, parent course or cohort idnumber, disabled, group.
* Allowed methods are meta and cohort.
* Allowed operations are add, del, mod';
$string['heading'] = 'Upload course enrolment methods from a CSV file';
$string['invalidmethod'] = '{$a->line} {$a->linenum}: Invalid method "{$a->method}"';
$string['invalidop'] = '{$a->line} {$a->linenum}: Invalid operation "{$a->op}"';
$string['methoddisabled'] = '{$a->line} {$a->linenum}: "{$a->method}" {$a->disabled}. {$a->skipped}.';
$string['methoddisabledwarning'] = '"{$a->method}": {$a->disabled}';
$string['musthavefile'] = 'You must select a file';
$string['parentnotfound'] = '{$a->line} {$a->linenum}: Parent "{$a->parent}" not found. {$a->skipped}.';
$string['pluginname'] = 'Upload enrolment methods';
$string['pluginname_help'] = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['reladded'] = '{$a->line} {$a->linenum}: "{$a->target}" ({$a->targetid}) successfully linked to "{$a->parent}" ({$a->parentid})';
$string['reladderror'] = '{$a->line} {$a->linenum}: Error linking "{$a->target}" ({$a->targetid}) to "{$a->parent}" ({$a->parentid}). {$a->skipped}.';
$string['relalreadyexists'] = '{$a->line} {$a->linenum}: "{$a->target}" ({$a->targetid}) already linked to "{$a->parent}" ({$a->parentid}). {$a->skipped}.';
$string['reldeleted'] = '{$a->line} {$a->linenum}: "{$a->target}" ({$a->targetid}) unlinked from "{$a->parent}" ({$a->parentid})';
$string['reldoesntexist'] = '{$a->line} {$a->linenum}: "{$a->target}" ({$a->targetid}) not linked to "{$a->parent}" ({$a->parentid}), so can\'t be removed. {$a->skipped}.';
$string['relmodified'] = '{$a->line} {$a->linenum}: "{$a->target}" ({$a->targetid}) modified.';
$string['targetisparent'] = '{$a->line} {$a->linenum}: "{$a->target}" ({$a->targetid}) is a parent of "{$a->parent}" ({$a->parentid}), so cannot be added as its target. {$a->skipped}.';
$string['targetnotfound'] = '{$a->line} {$a->linenum}: {$a->message}. {$a->skipped}.';
$string['toofewcols'] = '{$a->line} {$a->linenum}: Too few columns, expecting 6. {$a->skipped}.';
$string['toomanycols'] = '{$a->line} {$a->linenum}: Too many columns, expecting 6. {$a->skipped}.';
