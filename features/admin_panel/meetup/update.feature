Feature: Updating a meetup

  Background:
    Given there are following meetups
      | id | title                    | date                 | place           | language |
      | 1  | example meetup           | 2023-01-01 10:10:10  | example place   | pl       |
    And the administrator is logged in

  Scenario Outline: Successfully updating a meetup title
    Given the administrator is on the update meetup page with id equals "<id>"
    When the administrator fills in "title" with "<title>"
    And the administrator sends the form
    Then the administrator should see message "Meetup successfully updated"
    And the administrator should see "title" matches "<title>"
    Examples:
      | id  | title                 |
      | 1   | updated meetup        |

  Scenario Outline: Successfully updating a meetup date
    Given the administrator is on the update meetup page with id equals "<id>"
    When the administrator fills in "date" with "<date>"
    And the administrator sends the form
    Then the administrator should see message "Meetup successfully updated"
    And the administrator should see "date" matches "<date>"
    Examples:
      | id  | date                    |
      | 1   | 2024-02-02 10:10:10     |

  Scenario Outline: Successfully updating a meetup place
    Given the administrator is on the update meetup page with id equals "<id>"
    When the administrator fills in "place" with "<place>"
    And the administrator sends the form
    Then the administrator should see message "Meetup successfully updated"
    And the administrator should see "place" matches "<place>"
    Examples:
      | id  | place                |
      | 1   | updated place        |

  Scenario Outline: Successfully updating a meetup language
    Given the administrator is on the update meetup page with id equals "<id>"
    When the administrator fills in "language" with "<language>"
    And the administrator sends the form
    Then the administrator should see message "Meetup successfully updated"
    And the administrator should see "language" matches "<language>"
    Examples:
      | id  | language           |
      | 1   | en                 |

  Scenario Outline: Attempt to update a meetup without credentials
    Given the administrator is on the update meetup page with id equals "<id>"
    When the administrator sends the form
    Then the administrator should see the message "Title field is required"
    And the administrator should see the message "Date field are required"
    And the administrator should see the message "Place field are required"
    And the administrator should see the message "Language field are required"
    Examples:
      | id  |
      | 1   |

  Scenario Outline: Attempt to update a meetup which does not exist
    When the administrator get to the update meetup page with id equals "<id>"
    Then the administrator should see the message "Page not found"
    Examples:
      | id   |
      | 999  |
