Feature: Showing a meetup

  Background:
    Given there are following meetups
      | id   | organizer_id  | title                    | date                 | place           | language |
      | 1    | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2    | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |
    And The user with id equals "1" is logged in
    And the user is not an administrator

  Scenario Outline: Successfully showing a meetup
    When the user is on the show meetup page with <id>
    Then the user should see following meetup details:
      | id              | <id>               |
      | organizer_id    | <organizer_id>     |
      | title           | <title>            |
      | date            | <date>             |
      |  place          | <place>            |
      | language        | <language>         |
    Examples:
      | id  | organizer_id  | title                    | date                 | place           | language |
      | 1   | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2   | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |

  Scenario Outline: Attempt to show a meetup which does not exist
    When the user in on the show meetup page with id equals "<id>
    Then the user should see the message "Page not found"
    Examples:
      | id   |
      | 999  |
