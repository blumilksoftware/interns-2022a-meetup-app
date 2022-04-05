@application @environment
Feature: Test environment variables

  Scenario: No environment variables is overwritten
    Then application name is "Meetup application"

  Scenario: Environment variable for title is overwritten
    Given application is booted with config:
      | config   | value  |
      | app.name | Meetup |
    Then application name is "Meetup"
