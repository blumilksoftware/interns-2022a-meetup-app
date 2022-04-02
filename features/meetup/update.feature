Feature: Updating a meetup

  Background:
    Given there are following meetups
      | organizer_id  | title                    | date                 | place           | language |
      | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |
    And the user with id equals "1" is logged in
    And the user is not an administrator

  Scenario Outline: Successfully updating a meetup title as organizer
    Given the user is on the update meetup page with id equals "<id>"
    When the user fills in "title" with "<title>"
    And the user sends the form
    Then the user should see message "Meetup successfully updated"
    And the user should see "title" matches "<title>"
    Examples:
      | id  | title                 |
      | 1   | updated meetup        |

  Scenario Outline: Successfully updating a meetup date as organizer
    Given the user is on the update meetup page with id equals "<id>"
    When the user fills in "date" with "<date>"
    And the user sends the form
    Then the user should see message "Meetup successfully updated"
    And the user should see "date" matches "<date>"
    Examples:
      | id  | date                    |
      | 1   | 2024-02-02 10:10:10     |

  Scenario Outline: Successfully updating a meetup place as organizer
    Given the user is on the update meetup page with id equals "<id>"
    When the user fills in "place" with "<place>"
    And the user sends the form
    Then the user should see message "Meetup successfully updated"
    And the user should see "place" matches "<place>"
    Examples:
      | id  | place                |
      | 1   | updated place        |

  Scenario Outline: Successfully updating a meetup language as organizer
    Given the user is on the update meetup page with id equals "<id>"
    When the user fills in "language" with "<language>"
    And the user sends the form
    Then the user should see message "Meetup successfully updated"
    And the user should see "language" matches "<language>"
    Examples:
      | id  | language           |
      | 1   | en                 |

  Scenario Outline: Attempt to update a meetup without credentials
    Given the user is on the update meetup page with id equals "<id>"
    When the user sends the form
    Then the user should see the message "Title field is required"
    And the user should see the message "Date field are required"
    And the user should see the message "Place field are required"
    And the user should see the message "Language field are required"
    Examples:
      | id  |
      | 1   |

  Scenario Outline: Updating meetup as not an organizer
    When The user is on the update meetup page with organizer id equals "<id>"
    Then The user should see "You are not allowed to do this"
    Examples:
      | id |
      | 2  |
