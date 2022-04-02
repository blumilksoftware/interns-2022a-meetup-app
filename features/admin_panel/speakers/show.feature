Feature: Showing a speaker

  Background:
    Given there are following speakers
      | id | name                | description          |
      | 1  | example speaker     | existing speaker     |
    And the administrator is logged in

  Scenario Outline: Successfully showing a speaker
    Given the administrator is on the showing speaker page with speaker id <id>
    Then the administrator should see "name" with "<name>"
    And the administrator should see "description" with "<description>"
    Examples:
      | id  | name                    | description            |
      | 1   | example speaker         | existing speaker       |

  Scenario Outline: Attempt to show a speaker which does not exist
    When the administrator get to the show speaker page with id equals "<id>"
    Then the administrator should see the message "Page not found"
    Examples:
      | id   |
      | 999  |
