Feature: Deleting a meetup

  Background:
    Given there are following meetups:
      | organizer_id  | title                    | date                 | place           | language |
      | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |
    And the user with id equals "1" is logged in
    And the user is not an administrator

  Scenario Outline: Deleting a meetup as an organizer
    Given the user is on the meetup page with organizer id equals "<id>"
    When the user clicks on the delete meetup button
    Then the user should see message "Meetup successfully deleted"
    Examples:
      | id  |
      | 1   |

  Scenario Outline: Attempt to delete a meetup not as an organizer
    Given the user is on the meetup page with organizer id equals "<id>"
    Then the user should see the message "You are not allowed to access this page"
    Examples:
      | id  |
      | 2   |
