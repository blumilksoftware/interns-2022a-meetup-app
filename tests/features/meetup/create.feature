Feature: Creating a meetup

  Background:
    Given there are following meetups:
      | organizer_id  | title                    | date                 | place           | language |
      | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |
    And the user with id equals "1" is logged in
    And the user is not an administrator

  Scenario Outline: Successfully creating a meetup
    Given the user is on the create meetup page
    When the user fill in the "title" with "<title>"
    And the user fill in the "date" with "<date>"
    And the user fill in the "place" with "<place>"
    And the user fill in the "language" with "<language>"
    And the user submit form
    Then new meetup with following data should be created:
      |organizer_id  | 1            |
      | title        | <title>      |
      | date         | <date>       |
      | place        | <place>      |
      | language     | <language>   |
    And the user should see the message "Meetup successfully created"
    Examples:
      | title                    | date                 | place           | language |
      | test meetup              | 2023-02-02 10:10:10  | test place      | pl       |

  Scenario: Attempt to create a meetup without credentials
    Given the user is on the create meetup page
    When the user submits the form
    Then the user should see "Title field is required"
    And the user should see "Date field is required"
    And the user should see "Place field is required"
    And the user should see "Language field is required"
