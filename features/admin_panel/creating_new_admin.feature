Feature: Creating a admin user

  Background:
    Given there are invited users:
      | email                    |
      | user@example.com         |

  Scenario: The invited user already have account
    Given the invited user is on the authentication route by invitation link
    When the invited user logs in as "<email>"
    Then the invited user becomes admin user

  Scenario Outline: Successfully created an account
    Given the invited user is on the authentication route by invitation link
    When the invited user registers with "<email>" email address
    Then new administrator with email "<email>" should be created
    Examples:
      | email                    |
      | user@example.com         |

  Scenario: The invitation has expired
    Given the invitation was send more than 7 days ago
    When the invited user is on the authentication route by invitation link
    Then the invited user should see message "Your invitation is expired"
