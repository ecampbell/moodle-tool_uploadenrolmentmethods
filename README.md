# Upload enrolment methods #

Upload enrolment methods from a CSV file into a range of courses

## Description ##

The Upload course enrolment methods plugin for Moodle allows you to add enrolment methods to a range of courses at the same time. 
The Course meta link and Cohort sync methods are supported.
You can also delete, enable or disable existing enrolment methods in a course. 
The plugin is strongly based on the [Upload Metacourse links (block_metalink)](https://moodle.org/plugins/block_metalink) plugin developed by Mark Johnson, 
and uses code from it.

## Requirements ##

This plugin requires Moodle 2.9+ from http://moodle.org


## Installation and Update ##

Install the plugin, like any other plugin, to the following folder:

    /admin/tool/uploadenrolmentmethods

See http://docs.moodle.org/33/en/Installing_plugins for details on installing Moodle plugins.

There are no special considerations required for updating the plugin.

### Uninstallation ###

Uninstalling the plugin by going into the following:

__Administration &gt; Site administration &gt; Plugins &gt; Manage plugins &gt; Upload enrolment methods__

...and click Uninstall. You may also need to manually delete the following folder:

    /admin/tool/uploadenrolmentmethods

## Usage &amp; Settings ##

There are no configurable settings for this plugin.

Use the command __Administration &gt; Site administration &gt; Plugins &gt; Enrolments &gt; Upload enrolment methods__
to upload a CSV file containing lines of the form:

    operation, enrolment method, target course shortname, meta course shortname or cohort idnumber, disabled status, group name

The format of the CSV file is as follows:
* Lines beginning with a # or ; character are comments, and skipped.
* Each line of the file contains one record.
* Each record is a series of data in a fixed order separated by commas.
* All fields are required.
* The fields are: operation, enrolment method, target course shortname, parent course shortname or cohort idnumber, disabled status, group name.
* Allowed methods are meta and cohort.
* Allowed operations are add, del, upd
* The allowed disabled status field values are 1 (disable) and 0 (enable).
* The group name field is the name of a group into which enrolled students should be placed.
  It will be created if it doesn't already exist.


## License ##

2018 Eoin Campbell

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <http://www.gnu.org/licenses/>.
