Feature: Creating new admin user
  In order to have access to admin panel
  As a invited user
  I want to be able to creating account with admin privileges

  Background:
    Given there are invited users:
      | email                    |
      | user@example.com         |

  Scenario: Invited user already have account
    Given I get to authentication route by invitation link
    When I log in as "user@example.com"
    Then I become admin user

  Scenario Outline: Successfully created an account
    Given I get to authentication route by invitation link
    When I fill "email" with <email>
    And I fill "password" with <password>>
    And I fill "name" with <name>
    Then I create new account with email <email>
    And I become admin user
    Examples:
      | email                    | password       | name       |
      | user@example.com         | validpassword  | newadmin   |
  Scenario: Invitation is expired
    Given Invitation was send more than 7 days ago
    When I get to authentication route by invitation link
    Then I should see message "Your invitation is expired"