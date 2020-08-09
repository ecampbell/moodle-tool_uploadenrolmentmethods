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

/**
 * Get the group ID, creating a new group with the specified group name if necessary.
 *
 * @param int $courseid the course ID
 * @param string $groupname the name of the group to create or use
 * @return int $groupid Group ID for this cohort.
 */
function uploadenrolmentmethods_get_group($courseid, $groupname) {
    global $DB, $CFG;

    require_once($CFG->dirroot.'/group/lib.php');

    // Check to see if the group name already exists in this course.
    if ($DB->record_exists('groups', array('name' => $groupname, 'courseid' => $courseid))) {
        $group = $DB->get_record('groups', array('name' => $groupname, 'courseid' => $courseid));
        return $group->id;
    }
    // The named group doesn't exist, so create a new one in the course.
    $groupdata = new stdClass();
    $groupdata->courseid = $courseid;
    $groupdata->name = $groupname;
    $groupid = groups_create_group($groupdata);

    return $groupid;
}

