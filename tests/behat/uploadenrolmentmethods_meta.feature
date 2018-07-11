@admin @uon @tool_uploadenrolmentmethods
Feature: Linking metacourses and target courses by uploading a CSV file.
  In order to make it easier to import users from one course to another
  As an administrator
  I need to be able to upload a CSV file that enrols users from one course in another

  Background:
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C101      |
      | Course 2 | C102      |
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | student1 | Sam       | Student1 | student1@example.com |
      | teacher1 | Terry     | Teacher1 | teacher1@example.com |
    Given the following "course enrolments" exist:
      | user      | course | role           |
      | student1  | C101   | student        |
      | teacher1  | C101   | editingteacher |
    Given I log in as "admin"
    And I navigate to "Manage enrol plugins" node in "Site administration > Plugins > Enrolments"
    And I click on "Enable" "link" in the "Course meta link" "table_row"
    And I am on course index

  @_file_upload
  Scenario: Administrator can upload a CSV file using the upload enrolment methods plugin
    When I log in as "admin"
    And I navigate to "Upload enrolment methods" node in "Site administration > Plugins > Enrolments"
    And I upload "admin/tool/uploadenrolmentmethods/tests/fixtures/enrolmentmethod_meta.csv" file to "Upload this file" filemanager
    And I click on "id_submitbutton" "button"
    And I expand "My courses" node
    And I follow "C102"
    And I click on "Participants"
    Then I should see "Student1"
    And I should not see "Teacher1"

  Scenario: Warning should be displayed if meta enrolment is not activated
    Given I log in as "admin"
    And I navigate to "Manage enrol plugins" node in "Site administration > Plugins > Enrolments"
    And I click on "Disable" "link" in the "Course meta link" "table_row"
    And I navigate to "Upload enrolment methods" node in "Site administration > Plugins > Enrolments"
    Then I should see "Enrolment method ""Course meta link"": Disabled"