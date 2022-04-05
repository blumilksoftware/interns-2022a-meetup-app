@application @environment
Feature: Test environment variables

  Scenario: There are proper environment variables set up
    Given application is booted with config:
      | config   | value  |
      | app.name | Meetup |
    Then application name is "Meetup"
