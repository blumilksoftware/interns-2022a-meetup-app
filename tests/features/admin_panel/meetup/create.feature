Feature: Creating a meetup

  Background:
    Given the administrator is logged in
    And the administrator is on the create meetup page

  Scenario Outline: Successfully creating a meetup
    When the administrator fills in "title" with "<title>"
    And the administrator fills in "date" with "<date>"
    And the administrator fills in "place" with "<place>"
    And the administrator fills in "language" with "<language>"
    And the administrator submits the form
    Then the meetup with following data should be created:
      | title        | <title>      |
      | date         | <date>       |
      | place        | <place>      |
      | language     | <language>   |
    And the administrator should see the message "Meetup successfully created"
    Examples:
      | title                    | date                 | place           | language |
      | test meetup              | 2023-02-02 10:10:10  | test place      | pl       |

  Scenario: Attempt to create a meetup without credentials
    When the administrator sends the form
    Then the administrator should see the message "Title field is required"
    And the administrator should see the message "Date field are required"
    And the administrator should see the message "Place field are required"
    And the administrator should see the message "Language field are required"
