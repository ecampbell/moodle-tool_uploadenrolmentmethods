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
 * Output tracker.
 *
 * @package    tool_uploadenrolmentmethods
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/weblib.php');

/**
 * Class output tracker.
 *
 * Copied from /admin/tool/uploadcourse/classes/tracker.php and modified
 * @package    tool_uploadenrolmentmethods
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_uploadenrolmentmethods_tracker {

    /**
     * Constant to output nothing.
     */
    const NO_OUTPUT = 0;

    /**
     * Constant to output HTML.
     */
    const OUTPUT_HTML = 1;

    /**
     * Constant to output plain text.
     */
    const OUTPUT_PLAIN = 2;

    /**
     * @var array columns to display.
     */
    protected $columns = array();

    /**
     * @var int row number.
     */
    protected $rownb = 0;

    /**
     * @var int chosen output mode.
     */
    protected $outputmode;

    /**
     * @var object output buffer.
     */
    protected $buffer;

    /**
     * Constructor.
     *
     * @param int $outputmode desired output mode.
     */
    public function __construct($outputmode = self::NO_OUTPUT) {
        $this->outputmode = $outputmode;
        if ($this->outputmode == self::OUTPUT_PLAIN) {
            $this->buffer = new progress_trace_buffer(new text_progress_trace());
        }
    }

    /**
     * Start the output.
     *
     * @param array $reportheadings list of headings for output report, with names and labels
     * @return void
     */
    public function start(array $reportheadings) {

        if ($this->outputmode == self::NO_OUTPUT) {
            return;
        }

        // Set the columns.
        foreach ($reportheadings as $hkey => $label) {
            $this->columns[$hkey] = $label;
        }
        if ($this->outputmode == self::OUTPUT_PLAIN) {
            $this->buffer->output(implode("\t", $this->columns));
        } else if ($this->outputmode == self::OUTPUT_HTML) {
            // Print HTML table.
            echo html_writer::start_tag('table', array('class' => 'generaltable boxaligncenter flexible-wrap'));

            echo html_writer::start_tag('thead');
                echo html_writer::start_tag('tr', array('class' => 'heading r' . $this->rownb));

            // Print the headings in array order, and keep track of the column order for printing rows.
            $ci = 0;
            foreach ($reportheadings as $hkey => $label) {
                // Don't put the line number and outcome into the columns array to simplify outputting the message row.
                if ($hkey !== 'line' && $hkey !== 'outcome') {
                    $this->columns[$hkey] = $label;
                }
                echo html_writer::tag('th', $label,
                    array('class' => 'c' . $ci++, 'scope' => 'col'));
            }
            echo html_writer::end_tag('tr');
            echo html_writer::end_tag('thead');
            echo html_writer::start_tag('tbody');
        }
    }

    /**
     * Output one more line.
     *
     * @param int $line line number.
     * @param bool $outcome success or not?
     * @param array $rowdata data for each column of report
     * @param array $message array of explanation text
     * @return void
     */
    public function output($line, $outcome, $rowdata, $message) {
        global $OUTPUT;

        if ($this->outputmode == self::NO_OUTPUT) {
            return;
        }

        $tracer = new html_progress_trace();
        $tracer->output("<pre>" . var_dump($rowdata, true) . "</pre>");

        if ($this->outputmode == self::OUTPUT_PLAIN) {
            $message = array(
                $line,
                $outcome ? 'OK' : 'NOK',
                isset($rowdata['line']) ? $rowdata['line'] : '',
                isset($rowdata['op']) ? $rowdata['op'] : '',
                isset($rowdata['op']) ? $rowdata['methodname'] : '',
                isset($rowdata['shortname']) ? $rowdata['shortname'] : '',
                " (" . isset($rowdata['id']) ? $rowdata['id'] : '' . ")",
                isset($rowdata['metacohort']) ? $rowdata['metacohort'] : '',
            );
            $this->buffer->output(implode("\t", $message));
            if (!empty($message)) {
                foreach ($message as $st) {
                    $this->buffer->output($st, 1);
                }
            }
        } else if ($this->outputmode == self::OUTPUT_HTML) {
            $ci = 0;
            $this->rownb++;
            // Handle a possible multi-line message with details.
            if (is_array($message)) {
                $message = implode(html_writer::empty_tag('br'), $message);
            }
            // Print a nice icon (green tickbox or red x) for the outcome.
            if ($outcome) {
                $outcome = $OUTPUT->pix_icon('i/valid', '');
            } else {
                $outcome = $OUTPUT->pix_icon('i/invalid', '');
            }

            echo html_writer::start_tag('tr', array('class' => 'r' . $this->rownb % 2));
            echo html_writer::tag('td', $line, array('class' => 'c' . $ci++));
            echo html_writer::tag('td', $outcome, array('class' => 'c' . $ci++));
            foreach ($this->columns as $key => $value) {
                if (isset($rowdata[$key])) {
                    $tracer->output("column key: $key; rowdata: " . isset($rowdata[$key]) ? $rowdata[$key] : '');
                    echo html_writer::tag('td', $rowdata[$key], array('class' => 'c' . $ci++));
                }
            }
            echo html_writer::tag('td', $message, array('class' => 'c' . $ci++));
            echo html_writer::end_tag('tr');
        }
    }

    /**
     * Finish the output.
     *
     * @return void
     */
    public function finish() {
        if ($this->outputmode == self::NO_OUTPUT) {
            return;
        }

        if ($this->outputmode == self::OUTPUT_HTML) {
            echo html_writer::end_tag('tbody');
            echo html_writer::end_tag('table');
        }
    }

    /**
     * Output the results.
     *
     * @param array $message Summary of completed operations.
     * @return void
     */
    public function results(array $message) {
        if ($this->outputmode == self::NO_OUTPUT) {
            return;
        }

        if ($this->outputmode == self::OUTPUT_PLAIN) {
            foreach ($message as $msg) {
                $this->buffer->output($total);
            }
        } else if ($this->outputmode == self::OUTPUT_HTML) {
            $buffer = new progress_trace_buffer(new html_list_progress_trace());
            foreach ($message as $msg) {
                $buffer->output($msg);
            }
            $buffer->finished();
        }
    }
}
