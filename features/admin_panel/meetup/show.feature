Feature: Showing a meetup

  Background:
    Given there are following meetups
      | id | title                    | date                 | place           | language |
      | 1  | example meetup           | 2023-01-01 10:10:10  | example place   | pl       |
    And the administrator is logged in

  Scenario Outline: Successfully showing a meetup
    Given the administrator is on the showing meetup page with meetup id equals "<id>"
    Then the administrator should see "title" with "<title>"
    And the administrator should see "date" with "<date>"
    And the administrator should see "place" with "<place>"
    And the administrator should see "language" with "<language>"
    Examples:
      | id  | title                    | date                 | place           | language |
      | 1   | example meetup           | 2023-01-01 10:10:10  | example place   | pl       |

  Scenario Outline: Attempt to show a meetup which does not exist
    When the administrator get to the show meetup page with id equals "<id>"
    Then the administrator should see the message "Page not found"
    Examples:
      | id   |
      | 999  |
