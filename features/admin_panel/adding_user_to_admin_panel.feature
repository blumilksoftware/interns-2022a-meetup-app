Feature: Adding a user to admin panel

  Background:
    Given the administrator is logged in
    And the administrator is on the page with invitation form

  Scenario Outline: Successfully send invitation to unregistered user
    Given the invited user doesn't have an account
    When the administrator fills in "email" with "<email>"
    And the administrator sends the form
    Then the administrator should see "Successfully send invitation"
    And the invited user should get an invitation link on "<email>"
    Examples:
    | email                     |
    | firstuser@example.com     |

  Scenario Outline: The invited user is already an administrator
    Given the user with "<email>" email address is already an administrator
    When the administrator fills in "email" with "<email>"
    And the administrator sends the form
    Then the administrator should see the message "This user is already an administrator"
    Examples:
      | email                         |
      | existingadmin@example.com     |

  Scenario Outline: Successfully send invitation to already registered user
    Given There is a user with "<email>" email address
    And the invited user is not an administrator yet
    When the administrator fills in "email" with "<email>"
    And the administrator sends the form
    Then the administrator should see "Successfully send invitation"
    And invited user should get an invitation link on "<email>"
    Examples:
      | email                     |
      | firstuser@example.com     |
