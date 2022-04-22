Feature: Creating a speaker

  Background:
    Given the administrator is logged in
    And the administrator is on the create speaker page

  Scenario Outline: Successfully creating a speaker
    When the administrator fills in "name" with "<name>"
    And the administrator fills in "description" with "<description>"
    And the administrator submits the form
    Then the speaker with following data should be created:
      | name           | <name>           |
      | description    | <description>    |
    And the administrator should see the message "Speaker successfully created"
    Examples:
      | name                | description          |
      | test speaker        | new speaker          |

  Scenario: Attempt to create a speaker without credentials
    When the administrator sends the form
    Then the administrator should see the message "name field is required"
