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
 * Library of functions for uploading a course enrolment methods CSV file.
 *
 * @package    tool_uploadenrolmentmethods
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/lib/enrollib.php');
require_once($CFG->dirroot.'/enrol/meta/locallib.php');
require_once($CFG->dirroot.'/enrol/cohort/lib.php');
require_once($CFG->dirroot.'/enrol/cohort/locallib.php');
require_once($CFG->dirroot.'/admin/tool/uploaduser/locallib.php');

/**
 * Validates and processes files for uploading a course enrolment methods CSV file
 *
 * Original code developed by Mark Johnson <mark.johnson@tauntons.ac.uk>
 *
 * @copyright   2010 Tauntons College, UK
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_uploadenrolmentmethods_handler {

    /**
     * The ID of the file uploaded through the form
     *
     * @var string
     */
    private $filename;

    /**
     * Constructor, sets the filename
     *
     * @param string $filename
     */
    public function __construct($filename) {
        $this->filename = $filename;
    }

    /**
     * Attempts to open the file
     *
     * Open an uploaded file using the File API.
     * Return the file handler.
     *
     * @throws uploadenrolmentmethods_exception if the file can't be opened for reading
     * @return object File handler
     */
    public function open_file() {
        global $USER;
        if (is_file($this->filename)) {
            if (!$file = fopen($this->filename, 'r')) {
                throw new uploadenrolmentmethods_exception('cannotreadfile', $this->filename, 500);
            }
        } else {
            $fs = get_file_storage();
            $context = context_user::instance($USER->id);
            $files = $fs->get_area_files($context->id,
                                         'user',
                                         'draft',
                                         $this->filename,
                                         'id DESC',
                                         false);
            if (!$files) {
                throw new uploadenrolmentmethods_exception('cannotreadfile', $this->filename, 500);
            }
            $file = reset($files);
            if (!$file = $file->get_content_file_handle()) {
                throw new uploadenrolmentmethods_exception('cannotreadfile', $this->filename, 500);
            }
        }
        return $file;
    }

    /**
     * Processes the file to handle the enrolment methods
     *
     * Opens the file, loops through each row. Cleans the values in each column,
     * checks that the operation is valid and the methods exist. If all is well,
     * adds, updates or deletes the enrolment method metalink in column 3 to/from the course in column 2
     * context as specified.
     * Returns a report of successes and failures.
     *
     * @see open_file()
     * @uses enrol_meta_sync() Meta plugin function for syncing users
     * @return string A report of successes and failures.
     */
    public function process() {
        global $DB;
        $report = array();

        // Prepare reporting message strings.
        $strings = new stdClass;
        $strings->skipped = get_string('skipped');
        $strings->disabled = get_string('statusdisabled', 'enrol_manual');
        $strings->line = get_string('csvline', 'tool_uploadcourse');
        $strings->status = get_string('statusenabled', 'enrol_manual');
        $strings->role = get_string('unknownrole', 'enrol_manual');

        // Set a counter so we can report line numbers for errors.
        $line = 0;

        // Open the file.
        $file = $this->open_file();

        // Course roles lookup cache.
        $rolecache = uu_allowed_roles_cache();

        // Loop through each row of the file.
        while ($csvrow = fgetcsv($file)) {
            $line++;
            $strings->linenum = $line;

            // Skip any comment lines starting with # or ;.
            if ($csvrow[0][0] == '#' or $csvrow[0][0] == ';') {
                $report[] = get_string('csvcomment', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }

            // Check for the correct number of columns.
            if (count($csvrow) < 6) {
                $report[] = get_string('toofewcols', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }
            if (count($csvrow) > 7) {
                $report[] = get_string('toomanycols', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }

            // Read in clean parameters to prevent sql injection.
            $op = clean_param($csvrow[0], PARAM_TEXT);
            $method = clean_param($csvrow[1], PARAM_TEXT);
            $targetshortname = clean_param($csvrow[2], PARAM_TEXT);
            $parentid = clean_param($csvrow[3], PARAM_TEXT);
            $disabledstatus = clean_param($csvrow[4], PARAM_TEXT);
            $groupname = clean_param($csvrow[5], PARAM_TEXT);
            // Handle optional role field, if blank, use 'student' as the default.
            $rolename = 'student';
            if (count($csvrow) == 7) {
                $rolename = clean_param($csvrow[6], PARAM_TEXT);
            }

            // Add line-specific reporting message strings.
            $strings->linenum = $line;
            $strings->op = $op;
            $strings->method = $method;
            $strings->methodname = get_string('pluginname', 'enrol_' . $method);
            $strings->targetname = $targetshortname;
            $strings->parentname = $parentid;
            $strings->groupname = $groupname;

            if ($op == 'add') {
                $strings->oplabel = get_string('add');
            } else if ($op == 'del' || $op == 'delete') {
                $strings->oplabel = get_string('delete');
                $op = 'del';
            } else if ($op == 'upd' || $op == 'update' || $op == 'mod' || $op == 'modify') {
                $strings->oplabel = get_string('update');
                $op = 'upd';
            }

            // Need to check the line is valid. If not, add a message to the report and skip the line.

            // Check we've got a valid operation.
            if (!in_array($op, array('add', 'del', 'upd'))) {
                $report[] = get_string('invalidop', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }
            // Check we've got a valid method.
            if (!in_array($method, array('meta', 'cohort'))) {
                $strings->method = $method;
                $report[] = get_string('invalidmethod', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }
            // Check the requested enrolment method is enabled.
            if ($method == 'meta' && !enrol_is_enabled('meta')) {
                $report[] = get_string('methoddisabled', 'tool_uploadenrolmentmethods', $strings);
                continue;
            } else if ($method == 'cohort' && !enrol_is_enabled('cohort')) {
                // Check the cohort sync enrolment method is enabled.
                $report[] = get_string('methoddisabled', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }

            // Check the target course we're assigning the method to exists.
            if (!$target = $DB->get_record('course', array('shortname' => $targetshortname))) {
                $report[] = get_string('targetnotfound', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }
            // Check the parent metacourse we're assigning exists.
            if ($method == 'meta' && !($parent = $DB->get_record('course', array('shortname' => $parentid)))) {
                $report[] = get_string('parentnotfound', 'tool_uploadenrolmentmethods', $strings);
                continue;
            } else if ($method == 'cohort' && (!$parent = $DB->get_record('cohort', array('idnumber' => $parentid)))) {
                // Check the cohort we're syncing exists.
                $report[] = get_string('cohortnotfound', 'tool_uploadenrolmentmethods', $strings);
                continue;
            }

            // Check we have a valid role.
            if (!array_key_exists($rolename, $rolecache)) {
                $strings->unknownrole = get_string('unknownrole', 'error', s($rolename));
                $report[] = get_string('unknownrole', 'tool_uploadenrolmentmethods', $strings);
                continue;
            } else {
                $roleid = $rolecache[$rolename]->id;
            }

            $strings->targetid = $target->id;
            $strings->parentid = $parent->id;

            $enrol = enrol_get_plugin($method);

            $instanceparams = array(
                'courseid' => $target->id,
                'customint1' => $parent->id,
                'enrol' => $method
            );
            if ($op == 'del') {
                // Deleting, so check the parent is already linked to the target, and remove the link.
                // Skip the line if they're not.
                if ($instance = $DB->get_record('enrol', $instanceparams)) {
                    $enrol->delete_instance($instance);
                    $report[] = get_string('reldeleted', 'tool_uploadenrolmentmethods', $strings);
                } else {
                    $report[] = get_string('reldoesntexist', 'tool_uploadenrolmentmethods', $strings);
                }
            } else if ($op == 'upd') {
                // Updating, so check the parent is already linked to the target, and change the status.
                // Skip the line if they're not.
                if ($instance = $DB->get_record('enrol', $instanceparams)) {
                    // Found a valid  instance, so  enable or disable it.
                    $strings->instancename = $enrol->get_instance_name($instance);
                    if ($disabledstatus == 1) {
                        $strings->status = get_string('statusdisabled', 'enrol_manual');
                        $enrol->update_status($instance, ENROL_INSTANCE_DISABLED);
                    } else {
                        $enrol->update_status($instance, ENROL_INSTANCE_ENABLED);
                    }
                    $report[] = get_string('relupdated', 'tool_uploadenrolmentmethods', $strings);
                } else {
                    $report[] = get_string('reldoesntexist', 'tool_uploadenrolmentmethods', $strings);
                }
            } else if ($op == 'add') {
                // Adding, so check that the parent is not already linked to the target, and add them.
                // Array of parameters to check if meta instance is circular.
                $instancemetacheck = array(
                    'courseid' => $parent->id,
                    'customint1' => $target->id,
                    'enrol' => $method
                );

                $instancenewparams = array(
                    'customint1' => $parent->id,
                    'roleid' => $roleid
                );

                // If method members should be added to a group, create it or get its ID.
                if ($groupname != '') {
                    $instancenewparams['customint2'] = uploadenrolmentmethods_get_group($target->id, $groupname);
                }

                if ($method == 'meta' && ($instance = $DB->get_record('enrol', $instancemetacheck))) {
                    $report[] = get_string('targetisparent', 'tool_uploadenrolmentmethods', $strings);
                } else if ($instance = $DB->get_record('enrol', $instanceparams)) {
                    // This is a duplicate, skip it.
                    $report[] = get_string('relalreadyexists', 'tool_uploadenrolmentmethods', $strings);
                } else if ($instanceid = $enrol->add_instance($target, $instancenewparams)) {
                    // Successfully added a valid new instance, so now instantiate it.

                    // Synchronise the enrolment.
                    if ($method == 'meta') {
                        enrol_meta_sync($instancenewparams['customint1']);
                    } else if ($method == 'cohort') {
                        $trace = new null_progress_trace();
                        enrol_cohort_sync($trace, $target->id);
                        $trace->finished();
                    }

                    // Is it initially disabled?
                    if ($disabledstatus == 1) {
                        $instance = $DB->get_record('enrol', array('id' => $instanceid));
                        $enrol->update_status($instance, ENROL_INSTANCE_DISABLED);
                        $strings->status = get_string('statusdisabled', 'enrol_manual');
                    }

                    $strings->instancename = $enrol->get_instance_name($instance);
                    $report[] = get_string('reladded', 'tool_uploadenrolmentmethods', $strings);
                } else {
                    // Instance not added for some reason, so report an error and go to the next line.
                    $report[] = get_string('reladderror', 'tool_uploadenrolmentmethods', $strings);
                }
            }
        }
        fclose($file);
        return implode("<br/>", $report);
    }
}

/**
 * An exception for reporting errors when processing files
 *
 * Extends the moodle_exception with an http property, to store an HTTP error
 * code for responding to AJAX requests.
 *
 * @copyright   2010 Tauntons College, UK
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class uploadenrolmentmethods_handler_exception extends moodle_exception {

    /**
     * Stores an HTTP error code
     *
     * @var int
     */
    public $http;

    /**
     * Constructor, creates the exeption from a string identifier, string
     * parameter and HTTP error code.
     *
     * @param string $errorcode
     * @param string $a
     * @param int $http
     */
    public function __construct($errorcode, $a = null, $http = 200) {
        parent::__construct($errorcode, 'tool_uploadenrolmentmethods', '', $a);
        $this->http = $http;
    }
}
