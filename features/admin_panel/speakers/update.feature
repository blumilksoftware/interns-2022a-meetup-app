Feature: Updating a speaker

  Background:
    Given there are following speakers
      | id | name                | description          |
      | 1  | example speaker     | existing speaker     |
    And the administrator is logged in

  Scenario Outline: Successfully updating a speaker name
    Given the administrator is on the update speaker page with id equals "<id>"
    When the administrator fills in "name" with "<name>"
    And the administrator sends the form
    Then the administrator should see the message "Organization successfully updated"
    And the administrator should see "name" matches "<name>"
    Examples:
      | id  | name                     |
      | 1   | updated speaker          |

  Scenario Outline: Attempt to update a speaker without credentials
    Given the administrator is on the update speaker page with id equals "<id>"
    When the administrator sends the form
    Then the administrator should see the message "Name field is required"
    Examples:
      | id  |
      | 1   |

  Scenario Outline: Attempt to update a speaker which does not exist
    When the administrator get to the update speaker page with id equals "<id>"
    Then the administrator should see the message "Page not found"
    Examples:
      | id   |
      | 999  |
