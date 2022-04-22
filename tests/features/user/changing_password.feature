Feature: Changing a password

  Background:
    Given there are following users:
      | email                    | password        |
      | existinguser@example.com | correctpassword |

  Scenario Outline: Successfully changing password
    Given the user is logged in as "<email>"
    When the user fills in "old password" with "<old_password>"
    And the user fills in "new password" with "<new_password>"
    And the user fills in "confirm new password" with "<new_password>"
    Then the user should see "Password successfully changed"
    Examples:
    | email                     | old_password             | new_password       |
    | existinguser@example.com  | correctpassword          | newpassword        |

  Scenario Outline: Attempt to change the password with mismatching passwords
    Given the user is logged in as "<email>"
    When the user fills in "old password" with "<old_password>"
    And the user fills in "new password" with "<new_password>"
    And the user fills in "confirm new password" with "<confirmation_password>"
    Then the user should see "Password and confirmation password do not match"
    Examples:
    | email                     | old_password             | new_password       | confirmation_password     |
    | existinguser@example.com  | correctpassword          | newpassword        | wrongpassword             |

  Scenario Outline: Attempt to change the password with wrong old password
    Given the user is logged in as "<email>"
    When the user fills in "old password" with "<old_password>"
    And the user fills in "new password" with "<new_password>"
    And the user fills in "confirm new password" with "<new_password>"
    Then the user should see "Incorrect password"

    Examples:
      | email                     | old_password           | new_password       |
      | existinguser@example.com  | wrongpassword          | newpassword        |

  Scenario Outline: Attempt to change the password with too short new password
    Given the user is logged in as "<email>"
    When the user fills in "old password" with "<old_password>"
    And the user fills in "new password" with "<new_password>"
    And the user fills in "confirm new password" with "<new_password>"
    Then the user should see "New password is too short"

    Examples:
      | email                     | old_password             | new_password       |
      | existinguser@example.com  | correctpassword          | 123                |
