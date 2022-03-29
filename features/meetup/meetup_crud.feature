Feature: Meetup CRUD operations
  In order to managing meetup
  As a meetup organizer without admin privileges
  I want to be able to use CRUD operations for meetup

  Background:
    Given there are following meetups
      | organizer_id  | title                    | date                 | place           | language |
      | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |
    And I am logged in as user with id equals "1"
    And I am not an admin user

  Scenario Outline: Creating new meetup
    Given I am on the create meetup page
    When I fill the "title" with <title>
    And I fill the "date" with <date>
    And I fill the "place" with <place>
    And I fill the "language" with <language>
    And I submit form
    Then new meetup with matching data should be created
    And Organizer id should be 1
    And I should see message "Meetup was created"
    Examples:
      | title                    | date                 | place           | language |
      | test meetup              | 2023-02-02 10:10:10  | test place      | pl       |

  Scenario Outline: Updating meetup as organizer
    Given I get to the update meetup page with organizer id equals <id>
    When I change the "title" with <title>
    And I change the "date" with <date>
    And I change the "place" with <place>
    And I change the "language" with <language>
    And I submit form
    Then I should see updating meetup with matching data
    And I should see message "Meetup was updated"
    Examples:
      | id  | organizer_id  | title                       | date                 | place              | language |
      | 1   | 1             | updated meetup              | 2024-02-02 10:10:10  | updated place      | en       |

  Scenario: Updating meetup as not an organizer
    When I get to the update meetup page with organizer id equals "2"
    Then I should see "You do not have access"

  Scenario Outline: Show meetup
    When I am on the show meetup page with <id>
    Then I should see meetup details
    Examples:
      | id  | organizer_id  | title                    | date                 | place           | language |
      | 1   | 1             | my meetup                | 2023-01-01 10:10:10  | place           | pl       |
      | 2   | 2             | foreign meetup           | 2023-01-01 10:10:10  | place           | pl       |

  Scenario: Deleting meetup as organizer
    Given I get to the meetup page with organizer id equals "1"
    When I click for delete meetup
    Then I should see message "Meetup was deleted"
