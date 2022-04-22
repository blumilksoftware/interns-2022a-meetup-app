Feature: Showing an organization

  Background:
    Given there are following organizations:
      | id | name                    | description            |
      | 1  | example organization    | existing organization  |
    And the administrator is logged in

  Scenario Outline: Successfully showing an organization
    Given the administrator is on the showing organization page with organization id equals "<id>"
    Then the administrator should see "name" with "<name>"
    And the administrator should see "description" with "<description>"
    Examples:
      | id  | name                    | description            |
      | 1   | example organization    | existing organization  |

  Scenario: Attempt to show an organization which does not exist
    When the administrator get to the show organization page with id equals "999"
    Then the administrator should see the message "Page not found"
