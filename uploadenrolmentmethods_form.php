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
 * @package    tool_uploadenrolmentmethods
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
require_once($CFG->libdir.'/formslib.php');

/**
 * Form to prompt administrator for a CSV file to upload.
 *
 * @copyright  2018 Eoin Campbell
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class uploadenrolmentmethods_form extends moodleform {

    /**
     * Define the form.
     */
    public function definition() {
        $mform = $this->_form;

        // Heading.
        $mform->addElement('html', '<p>'.get_string('pluginname_help', 'tool_uploadenrolmentmethods').'</p>');

        // Insert a File picker element.
        $this->_form->addElement('filepicker', 'csvfile', get_string('file'));
        $this->_form->addHelpButton('csvfile', 'csvfile', 'tool_uploadenrolmentmethods');
        $this->_form->addRule('csvfile', null, 'required', null, 'client');

        $choices = csv_import_reader::get_delimiter_list();
        $mform->addElement('select', 'delimiter_name', get_string('csvdelimiter', 'tool_uploadcourse'), $choices);
        if (array_key_exists('cfg', $choices)) {
            $mform->setDefault('delimiter_name', 'cfg');
        } else if (get_string('listsep', 'langconfig') == ';') {
            $mform->setDefault('delimiter_name', 'semicolon');
        } else {
            $mform->setDefault('delimiter_name', 'comma');
        }
        $mform->addHelpButton('delimiter_name', 'csvdelimiter', 'tool_uploadcourse');

        $choices = core_text::get_encodings();
        $mform->addElement('select', 'encoding', get_string('encoding', 'tool_uploadcourse'), $choices);
        $mform->setDefault('encoding', 'UTF-8');
        $mform->addHelpButton('encoding', 'encoding', 'tool_uploadcourse');

        // Standard buttons.
        $this->add_action_buttons(true, get_string('uploadthisfile'));
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

        if (empty($data['csvfile'])) {
            $errors['csvfile'] = get_string('uploadcsvfilerequired', 'tool_uploadenrolmentmethods');
        }

        return $errors;
    }
}
