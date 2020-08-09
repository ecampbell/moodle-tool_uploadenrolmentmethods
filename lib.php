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
 * Local lib code
 *
 * @package    tool_uploadenrolmentmethods
 * @copyright  2020 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Add an upload enrolment methods link to the course user menu.
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the tool
 * @param context $context The context of the course
 * @return void|null return null if we don't want to display the node.
 */
function tool_uploadenrolmentmethods_extend_navigation_course($navigation, $course, $context) {
    global $PAGE;

    // Only add this settings item on non-site course pages.
    if (!$PAGE->course || $PAGE->course->id == SITEID) {
        return null;
    }

    // Check we can view the facility to upload enrolment methods.
    if (!has_capability('tool/uploadenrolmentmethods:add', $context)) {
        return null;
    }

    $url = null;
    $settingnode = null;

    $url = new moodle_url('/admin/tool/uploadenrolmentmethods/index.php', array(
        'contextid' => $context->id
    ));

    // Add the uploadenrolmentmethods link.
    $pluginname = get_string('pluginname', 'tool_uploadenrolmentmethods');
    $node = navigation_node::create(
        $pluginname,
        $url,
        navigation_node::NODETYPE_LEAF,
        'tool_uploadenrolmentmethods',
        'tool_uploadenrolmentmethods'
    );

    // Display the upload methods link only if we are on the Enrolment methods page.
    $enrolmentpage = new moodle_url('/enrol/instances.php', array('id' => $course->id));
    if ($PAGE->url->compare($enrolmentpage, URL_MATCH_EXACT)) {
        $navigation->add_node($node);
    }

}
