@files
Feature: List files
    In order to know what files are in consigna
    As a consigna user
    I want to get the list of files
    Background:
      Given existing users:
          | username    | email             | plainPassword | enabled  |
          | user1       | user1@uco.es      | secret1       | 1        |
          | user2       | user2@uco.es      | secret2       | 1        |

      And existing folders:
          | folderName  |   uploadDate   | username    | description   | slug    | userWithAccess |
          | folder1     |   2014/12/27   | user1       | description1  | folder1 | user2          |
          | folder2     |   2014/12/28   | user2       | description2  | folder2 | null           |
          | folder3     |   2014/12/29   | null        | description3  | folder3 | null           |

      And existing files:
          | filename  |   uploadDate   | username    | folder      |
          | file1     |   2014/12/27   | user1       | folder1     |
          | file2     |   2014/12/28   | user2       | null        |
          | file3     |   2014/12/29   | null        | folder2     |

    Scenario: List elements
        Given I am on the homepage
        Then  I should see 6 elements

    Scenario: List elements in a folder
        Given I am on the homepage
        And I am authenticated as "user1" with "secret1"
        When I follow "folder1"
        Then I should be on "/folder/folder1"
        And I should see 1 elements

    Scenario: List elements by logged user
        Given I am authenticated as "user1" with "secret1"
        When I follow "My elements"
        Then I should be on "/user/files"
        And I should see 2 elements

    Scenario: List elements shared with me
        Given I am authenticated as "user1" with "secret1"
        When I follow "Shared with me"
        Then I should be on "/user/shared_elements"
        And I should see 2 elements

    Scenario Outline: Search files by name
        Given I am on the homepage
        When I fill in "search-button" with "<word>"
        And I press "Submit"
        Then I should see <number> elements

        Examples:
            | word      | number    |
            | file1     | 1         |
            | f         | 6         |
            | nothing   | 0         |
