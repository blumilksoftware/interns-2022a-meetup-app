Feature: Updating an organization

  Background:
    Given there are following organizations:
      | id | name                    | description            |
      | 1  | example organization    | existing organization  |
    And the administrator is logged in

  Scenario Outline: Successfully updating an organization name
    Given the administrator is on the update meetup page with id equals "<id>"
    When the administrator fills in "name" with "<name>"
    And the administrator sends the form
    Then the administrator should see the message "Organization successfully updated"
    And the administrator should see "name" matches "<name>"
    Examples:
      | id  | name                     |
      | 1   | updated organization     |

  Scenario: Attempt to update an organization without credentials
    Given the administrator is on the update organization page with id equals "1"
    When the administrator sends the form
    Then the administrator should see the message "Name field is required"

  Scenario: Attempt to update an organization which does not exist
    When the administrator get to the update organization page with id equals "999"
    Then the administrator should see the message "Page not found"
