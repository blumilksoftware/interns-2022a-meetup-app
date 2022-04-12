Feature: Deleting a speaker

  Background:
    Given there are following speakers:
      | id | name                | description          |
      | 1  | example speaker     | existing speaker     |
    And the administrator is logged in

  Scenario Outline: Successfully deleting a speaker
    Given the administrator is on the deleting speaker page with meetup id equals "<id>"
    When the administrator clicks on the delete speaker button
    Then the administrator should see the message "Speaker successfully deleted"
    Examples:
      | id   |
      | 1    |
