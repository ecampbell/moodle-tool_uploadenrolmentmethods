@admin @uon @tool_uploadenrolmentmethods
Feature: Linking metacourses and target courses by uploading a CSV file.
    In order to make it easier to import users from one course to another
    As a editing teacher
    I need to be able to upload a csv file that imports users from one course to another

    Background:
        Given the following "courses" exist:
            | fullname | shortname | summary | category | idnumber |
            | Course 1 | C101      | Prove the upload enrolment methods plugin works - Parent Course | 0 | idnum1 |
            | Course 2 | C102      | Prove the upload enrolment methods plugin works - Target Course | 0 | idnum2 |
        Given the following "users" exist:
            | username    | firstname | lastname | email            |
            | student1    | Sam       | Student  | student1@asd.com |
            | teacher1    | Teacher   | One      | teacher1@asd.com |
        Given the following "cohorts" exist:
            | name     | idnumber |
            | Cohort 1 | cohort1  |
        Given the following "course enrolments" exist:
            | user        | course | role    |
            | student1    | C101   | student |
            | teacher1    | C101   | editingteacher |  
        Given I log in as "admin"
        And I expand "Site administration" node
        And I expand "Plugins" node
        And I expand "Enrolments" node
        And I follow "Manage enrol plugins"
        And I click on "Enable" "link" in the "Course meta link" "table_row"
        And I log out 
   
    @_file_upload
    Scenario: Manager can upload a CSV file using the upload enrolment methods plugin
        When I log in as "admin"
        And I expand "Site administration" node
        And I expand "Plugins" node
        And I expand "Enrolments" node
        And I follow "Upload enrolment methods"
        And I upload "admin/tool/uploadenrolmentmethods/tests/fixtures/uploadenrolmentmethods_test.csv" file to "Select CSV file" filemanager
        And I click on "id_submitbutton" "button"
        And I follow "Courses"
        And I follow "Course 2"
        And I expand "Users" node
        And I follow "Enrolled users"
        Then I should see "student1"
        And I should see "teacher1"

    Scenario: Warning should be displayed a message if meta enrolment is not activated
        Given I log in as "admin"
        And I expand "Site administration" node
        And I expand "Plugins" node
        And I expand "Enrolments" node
        And I follow "Upload enrolment methods"
        And I click on "Disable" "link" in the "Course meta link" "table_row"
        And I expand "Site administration" node
        And I expand "Plugins" node
        And I expand "Enrolments" node
        And I follow "Upload enrolment methods"
        Then I should see "The ""Course meta link"" enrolment plugin is disabled"
