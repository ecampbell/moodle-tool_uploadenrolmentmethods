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

$string['cohortnotfound']        = 'Cohort not found.';
$string['csvcomment']            = '{$a->line} {$a->linenum} [Comment]:';
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
$string['invalidmethod']         = 'Invalid method.';
$string['invalidop']             = 'Invalid operation.';
$string['metacohort']            = 'Cohort or meta course';
$string['method']                = 'Method';
$string['methoddisabledwarning'] = 'Enrolment method "{$a}" disabled.';
$string['methodstotal']          = 'Total: {$a}';
$string['methodscreated']        = 'Created: {$a}';
$string['methodsupdated']        = 'Updated: {$a}';
$string['methodsdeleted']        = 'Deleted: {$a}';
$string['methodserrors']         = 'Errors: {$a}';
$string['operation']             = 'Operation';
$string['outcome']               = 'Outcome';
$string['parentnotfound']        = 'Meta course not found.';
$string['pluginname']            = 'Upload enrolment methods';
$string['pluginname_help']       = 'Upload enrolment methods from a CSV file to set enrolment methods for a range of courses in a single operation.';
$string['privacy:metadata']      = 'The Upload enrolment methods administration tool does not store personal data.';
$string['reladded']              = 'Medhod added.';
$string['reladderror']           = 'Error linking method to course.';
$string['relalreadyexists']      = 'Method already linked to course.';
$string['reldeleted']            = 'Deleted method.';
$string['reldoesntexist']        = 'Method doesn\'t exist.';
$string['relupdated']            = 'Updated method.';
$string['result']                = 'Result';
$string['results']               = 'Upload Enrolment method results';
$string['targetisparent']        = 'Method is a parent of the course, so cannot be added as its target.';
$string['targetnotfound']        = 'Unknown course.';
$string['toofewcols']            = 'Too few columns, expecting 6/7.';
$string['toomanycols']           = 'Too many columns, expecting 6/7.';
