Feature: Creating a admin user

  Background:
    Given there are invited users:
      | email                    |
      | user@example.com         |

  Scenario: The invited user already have account
    Given the invited user is on the authentication route by invitation link
    When the invited user logs in as "user@example.com "
    Then the invited user becomes admin user

  Scenario: Successfully created an account
    Given the invited user is on the authentication route by invitation link
    When the invited user registers with "user@example.com " email address
    Then new administrator with email "user@example.com " should be created

  Scenario: The invitation has expired
    Given the invitation was send more than 7 days ago
    When the invited user is on the authentication route by invitation link
    Then the invited user should see message "Your invitation is expired"
