Feature: Meetup CRUD operations
  In order to managing meetups
  As a admin user
  I want to be able to use CRUD operations for meetup

  Background:
    Given there are following meetups
      | id | title                    | date                 | place           | language |
      | 1  | example meetup           | 2023-01-01 10:10:10  | example place   | pl       |
    And I am logged in as admin

  Scenario Outline: Creating new meetup
    Given I am on the create meetup page with meetup id <id>
    When I fill the "title" with <title>
    And I fill the "date" with <date>
    And I fill the "place" with <place>
    And I fill the "language" with <language>
    Then new meetup with matching data should be created
    And I should see message "Meetup was created"
    Examples:
      | title                    | date                 | place           | language |
      | test meetup              | 2023-02-02 10:10:10  | test place      | pl       |

  Scenario Outline: Updating meetup
    Given I am on the update meetup page
    When I change the "title" with <title>
    And I change the "date" with <date>
    And I change the "place" with <place>
    And I change the "language" with <language>
    Then I should see updating meetup with matching data
    And I should see message "Meetup was updated"
    Examples:
      | id | title                 | date                 | place              | language |
      | 1  | updated meetup        | 2024-02-02 10:10:10  | updated place      | en       |
