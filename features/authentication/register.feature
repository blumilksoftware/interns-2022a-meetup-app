Feature: User registration

  Background:
    Given the user is on the register page

  Scenario Outline: Register with valid data
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    And the user fills in "confirm password" with "<password>"
    And the user fills in "name" with "<name>"
    And the user submits form
    Then the user has successfully sign up
    And the user should get an email on <email>
    Examples:
      | email                    | password        | name          |
      | testuser@example.com     | correctpassword | testuser      |

  Scenario Outline: Register using an existing email
    Given there are following users:
      | email                    | password        |
      | existinguser@example.com | password        |
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    And the user fills in "confirm password" with "<password>"
    And the user submits form
    Then the user should see the message "User with this email actually exist"
    Examples:
      | email                    | password        |
      | existinguser@example.com | password        |

  Scenario Outline: Register using an invalid email
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    And the user fills in "confirm password" with "<password>"
    And the user fills in "name" with "<name>"
    And the user submits form
    Then the user should see "Invalid email"
    Examples:
      | email        | password        | name          |
      | user         | correctpassword | testuser      |

  Scenario: Register without credentials
    When the user submits form
    Then the user should see "Email field is required"
    And the user should see "Password field is required"
    And the user fills in "Confirm password" with "<password>"
    And the user should see "Name field is required"

  Scenario: A logged user attempting to get to the register page
    Given the user is logged in
    Then the user should be redirected to the home page

  Scenario Outline: Attempt to register with mismatching passwords
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    And the user fills in "confirm password" with "<confirmation_password>"
    And the user fills in "name" with "<name>"
    And the user submits form
    Then the user should see "Password and confirmation password do not match"
    Examples:
      | email                 | password        | confirmation_password   | name           |
      | testuser@example.com  | correctpassword | wrongpassword           | testuser       |

  Scenario Outline: Attempt to register with with too short password
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    And the user fills in "confirm password" with "<password>"
    And the user fills in "name" with "<name>"
    And the user submits form
    Then the user should see "Password is too short"
    Examples:
      | email                | password        | name           |
      | testuser@example.com | 123             | testuser       |
