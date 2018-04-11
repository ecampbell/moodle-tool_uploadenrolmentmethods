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
 * Main form for uploading course enrolment methods.
 *
 * @package    local_uploadenrolmentmethods
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
require_once($CFG->libdir.'/formslib.php');

/**
 * Form to prompt administrator for a CSV file to upload.
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class uploadenrolmentmethods_form extends moodleform {

    /**
     * Define the form.
     */
    public function definition() {
        global $USER, $CFG;
        $mform = $this->_form;

        // Header.

        $mform->addElement('html', '<p>'.get_string('pluginname_help', 'local_uploadenrolmentmethods').'</p>');

        // File picker
        $this->_form->addElement('filepicker', 'uploadfilepicker', null, null, $this->_customdata['options']);
        $this->_form->addHelpButton('filepicker', get_string('uploadcsvfile', 'local_uploadenrolmentmethods'), 'local_uploadenrolmentmethods');
        $this->_form->addRule('uploadfilepicker', null, 'required', null, 'client');

        // Buttons.
        $this->add_action_buttons(true, get_string('uploadcsvfile', 'local_uploadenrolmentmethods'));

    }

    /**
     * Validate submitted form data, recipient in this case, and returns list of errors if it fails.
     *
     * @param      array  $data   The data fields submitted from the form.
     * @param      array  $files  Files submitted from the form (not used)
     *
     * @return     array  List of errors to be displayed on the form if validation fails.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (empty($data['uploadfilepicker'])) {
            $errors['uploadfilepicker'] = get_string('uploadcsvfilerequired', 'local_uploadenrolmentmethods');
        }

        return $errors;
    }
}
