@admin @uon @tool_uploadenrolmentmethods
Feature: Linking cohorts and target courses by uploading a CSV file.
  In order to make it easier to import users from one course to another
  As an administrator
  I need to be able to upload a CSV file that enrols users from one course in another

  Background:
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C101      |
      | Course 2 | C102      |
    Given the following "users" exist:
      | username | firstname | lastname | email        |
      | student1 | Sam     | Student1 | student1@example.com |
      | teacher1 | Terry   | Teacher1 | teacher1@example.com |
    Given the following "cohorts" exist:
      | name   | idnumber |
      | Cohort 1 | cohort1  |
    Given the following "cohort members" exist:
      | cohort  | user   |
      | cohort1 | student1 |
    Given I log in as "admin"
    And I navigate to "Plugins > Manage enrol plugins" in site administration
    And I click on "Disable" "link" in the "Cohort sync" "table_row"
    And I click on "Enable" "link" in the "Cohort sync" "table_row"
    And I am on course index

  @javascript @_file_upload
  Scenario: Administrator can upload a CSV file using the upload enrolment methods plugin
    When I log in as "admin"
    And I navigate to "Plugins > Upload enrolment methods" in site administration
    And I upload "admin/tool/uploadenrolmentmethods/tests/fixtures/enrolmentmethod_cohort.csv" file to "File" filemanager
    And I click on "id_submitbutton" "button"
    When I am on the "C101" "course" page logged in as "admin"
    And I follow "Participants"
    Then I should see "Student1"
    And I should not see "Teacher1"

  Scenario: Warning should be displayed a message if cohort sync enrolment is not activated
    Given I log in as "admin"
    And I navigate to "Plugins > Manage enrol plugins" in site administration
    And I click on "Disable" "link" in the "Cohort sync" "table_row"
    And I navigate to "Plugins > Upload enrolment methods" in site administration
    Then I should see "Enrolment method \"Cohort sync\" disabled."
