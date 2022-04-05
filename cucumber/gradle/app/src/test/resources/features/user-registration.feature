Feature: User Registration
  User will initiate registration request to system and
  system will validate the information and add user to system

  Scenario: Basic Flow
    Given User visit registration
    When User enter his registration details
    Then System validate the information
    And User get registered

