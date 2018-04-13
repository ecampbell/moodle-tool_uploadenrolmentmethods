Local Upload course enrolment methods plugin for Moodle
=======================================================

Copyright
---------
Copyright © 2018 Eoin Campbell

This file is part of Moodle - http://moodle.org/

Moodle is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Moodle is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

Authors
-------
Eoin Campbell

Description
-----------
The Upload course enrolment methods plugin for Moodle allows you to add 
enrolment methods to a range of courses at the same time. Only the Course Metalink
is supported at the moment. You can also delete, enable or disable existing enrolment 
methods in a course.

Requirements
------------
This plugin requires Moodle 2.9+ from http://moodle.org


Installation and Update
-----------------------
Install the plugin, like any other plugin, to the following folder:

    /local/uploadenrolmentmethods

See http://docs.moodle.org/33/en/Installing_plugins for details on installing Moodle plugins.

There are no special considerations required for updating the plugin.

Uninstallation
--------------
Uninstalling the plugin by going into the following:

Home > Administration > Site Administration > Plugins > Manage plugins > Upload enrolment methods

...and click Uninstall. You may also need to manually delete the following folder:

    /local/upload_enrolment_methods

Usage & Settings
----------------
There are no configurable settings for this plugin.

Use the command Administration > Site Administration > Plugins > Enrolments > Upload enrolment methods
to upload a CSV file containing lines of the form:
operation, shortname, method, idnumber, disabled
