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
    Given I am on the homepage
    Then  I should see 5 elements
    And I should see "3 folders - 2 files"
    And I should see "300 bytes used in 3 files"

  Scenario Outline: Search items by name
    Given I am on the homepage
    When I fill in "word" with "<word>"
    And I press "search"
    Then I should see <number> elements

  Examples:
    | word      | number    |
    | file1     | 1         |
    | f         | 6         |
    | nothing   | 0         |
    | tag1      | 2         |

  @test
  Scenario: Follow All items in left menu
    Given I am on the homepage
    When I follow "All items"
    Then  I should see 5 elements

  @test
  Scenario: Follow My items in left menu
    Given I am on the homepage
    And I am authenticated as "user1" with "secret1"
    When I follow "menu.left.myfiles"
    Then  I should see 2 elements

  @test
  Scenario: Follow Shared items in left menu
    Given I am on the homepage
    And I am authenticated as "user1" with "secret1"
    When I follow "menu.left.share"
    Then  I should see 1 elements