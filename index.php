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
 * Displays the form and processes the form submission.
 *
 *
 * @package    local_uploadenrolmentmethods
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');

// Include our function library.
$pluginname = 'uploadenrolmentmethods';
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');

// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;

// Ensure only administrators have access.
$homeurl = new moodle_url('/');
require_login();
if (!is_siteadmin()) {
    redirect($homeurl, "This feature is only available for site administrators.", 5);
}

// URL Parameters.
// There are none.

// Include form.
require_once(dirname(__FILE__).'/class/'.$pluginname.'_form.php');

// Heading ==========================================================.

$title = get_string('pluginname', 'local_'.$pluginname);
$heading = get_string('heading', 'local_'.$pluginname);
$url = new moodle_url('/local/'.$pluginname.'/');
if ($CFG->branch >= 25) { // Moodle 2.5+.
    $context = context_system::instance();
} else {
    $context = get_system_context();
}

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);
admin_externalpage_setup('local_'.$pluginname); // Sets the navbar & expands navmenu.

// Set up the form.
$form = new uploadenrolmentmethods_form(null, array('fromdefault' => ''));
if ($form->is_cancelled()) {
    redirect($homeurl);
}

echo $OUTPUT->header();

// Display or process the form. =====================================.

$data = $form->get_data();
if (!$data) { // Display the form.

    echo $OUTPUT->heading($heading);

    $displaymanageenrollink = 0;
    if (!enrol_is_enabled('meta')) {
        $url = new moodle_url('/admin/settings.php', array('section' => 'manageenrols'));
        echo html_writer::tag('div', get_string('metadisabled', 'local_uploadenrolmentmethods'));
        $displaymanageenrollink = 1;
    }
    if (!enrol_is_enabled('cohort')) {
        $url = new moodle_url('/admin/settings.php', array('section' => 'manageenrols'));
        echo html_writer::tag('div', get_string('cohortdisabled', 'local_uploadenrolmentmethods'));
        $displaymanageenrollink = 1;
    }
    if ($displaymanageenrollink) {
        $strmanage = get_string('manageenrols', 'enrol');
        echo html_writer::tag('a', $strmanage, array('href' => $url));
    }

    // Display the form. ============================================.
    $form->display();

} else {      // Process the CSV file.

    // Set debug level to a minimum of NORMAL: Show errors, warnings and notices.
    $debuglevel = $CFG->debug;
    $debugdisplay = $CFG->debugdisplay;
    if ($CFG->debug < 15) {
        $CFG->debug = 15;
    }
    $CFG->debugdisplay = true;

    // Validate and process the file, and output a report.
    $handler = new local_uploadenrolmentmethods_handler($data->csvfile);
    $handler->validate();
    $report = $handler->process();
    echo $report;

    // Done, revert debug level.
    $CFG->debug = $debuglevel;
    $CFG->debugdisplay = $debugdisplay;
}

// Footing  =========================================================.

echo $OUTPUT->footer();

/*
try {
    if ($data = $mform->get_data()) {
        // Check the user is allowed to use the block.
        if (!has_capability('block/metalink:use', $PAGE->context)) {
            throw new metalink_exception('nopermission', '', 401);
        }

        // Validate and process the file.
        $handler = new block_metalink_handler($data->metalink_csvfile);
        $handler->validate();
        $report = $handler->process();

        // If it's a synchronous request, display a full page with the report
        // from the processing handler. Otherwise, just return the report.
        $PAGE->set_title(get_string('pluginname', 'block_metalink'));
        $PAGE->set_heading(get_string('pluginname', 'block_metalink'));
        if (!$ajax) {
            echo $OUTPUT->header();
        }
        echo $report;
        if (!$ajax) {
            echo $OUTPUT->footer();
        }
    } else {
        throw new metalink_exception('noform', '', 400);
    }
} catch (metalink_exception $e) {
    // If async, set the HTTP error code and print the message as plaintext.
    // Otherwise, display a full Moodle error message.
    if ($ajax) {
        header('HTTP/1.1 '.$e->http);
        die(get_string($e->errorcode, $e->module, $e->a));
    } else {
        print_error($e->errorcode, $e->module, '', $e->a);
    }
}
*/