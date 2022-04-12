Feature: Deleting a meetup

  Background:
    Given there are following meetups:
      | id | title                    | date                 | place           | language |
      | 1  | example meetup           | 2023-01-01 10:10:10  | example place   | pl       |
    And the administrator is logged in

  Scenario Outline: Successfully deleting a meetup
    Given the administrator is on the deleting meetup page with meetup id equals "<id>"
    When the administrator clicks on the delete meetup button
    Then the administrator should see the message "Meetup successfully deleted"
    Examples:
      | id   |
      | 1    |
