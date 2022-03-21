Feature: Speaker CRUD operations
  In order to managing speakers
  As a admin user
  I want to be able to use CRUD operations for speakers

  Background:
    Given there are following speakers
      | id | name                | description          |
      | 1  | example speaker     | existing speaker     |
    And I am logged in as admin

  Scenario Outline: Creating new organization
    Given I am on the create speaker page
    When I fill the "name" with <name>
    And I fill the "description" with <description>
    Then New speaker with matching data should be created
    And I should see message "Speaker was created"
    Examples:
      | name                | description          |
      | test speaker        | new speaker          |

  Scenario Outline: Updating speaker
    Given I am on the update speaker page with speaker id equals <id>
    When I change the "name" with <name>
    And I change the "description" with <description>
    Then I should see updating speaker with matching data
    And I should see message "Speaker was updated"
    Examples:
      | id | name                    | description          |
      | 1  | updated speaker         | updated speaker      |