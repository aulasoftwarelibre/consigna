@list
Feature: List files
  In order to know what files are in consigna
  As a consigna user
  I want to get the list of files
  Background:
    Given existing users:
      | username    | email             | plainPassword | enabled  |
      | user1       | user1@uco.es      | secret1       | 1        |
      | user2       | user2@uco.es      | secret2       | 1        |
      | user3       | user3@uco.es      | secret3       | 1        |

    And existing tags:
      | tagName |
      | tag1    |
      | tag2    |

    And existing folders:
      | folderName  | username  | userWithAccess | tags |
      | folder1     | user1     | user2          | tag1 |
      | folder2     | user2     | null           | tag2 |
      | folder3     | user3     | null           | tag1, tag2 |

    And existing files:
      | filename  | username    | folder      | userWithAccess | tags |
      | file1     | user1       | folder1     |      user1     | tag1 |
      | file2     | null        | null        |      null      | tag2 |
      | file3     | null        | null        |      null      | null |

  Scenario: List items
    Given I am on the main folder
    Then  I should see 5 elements
    And I should see "3 folders - 2 files"
    And I should see "300 bytes used in 3 files"

  Scenario Outline: Search items by name
    Given I am on the main folder
    When I fill in "word" with "<word>"
    And I press "search"
    Then I should see <number> elements

  Examples:
    | word      | number    |
    | file1     | 1         |
    | f         | 6         |
    | nothing   | 0         |
    | tag1      | 2         |

  Scenario: Follow All items in left menu
    Given I am on the main folder
    When I follow "All items"
    Then  I should see 5 elements

  Scenario: Follow My items in left menu
    Given I am on the main folder
    And I am authenticated as "user1" with "secret1"
    When I follow "My items"
    Then  I should see 2 elements

  Scenario: Follow Shared items in left menu
    Given I am on the main folder
    And I am authenticated as "user2" with "secret2"
    When I follow "Shared items"
    Then  I should see 1 elements

  Scenario: Follow main folder in breadcrum
    Given I am on the main folder
    When I follow "Main folder"
    Then I should be on the main folder

  Scenario: Follow ConsignaUco title
    Given I am on the main folder
    When I follow "ConsignaUCO"
    Then I should be on the main folder
