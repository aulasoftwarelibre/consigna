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
          | user3       | user3@uco.es      | secret3       | 1        |

      And existing tags:
          | tagName |
          | tag1    |
          | tag2    |

      And existing folders:
          | folderName  |   uploadDate   | username    | description   | slug    | password |userWithAccess | tags |
          | folder1     |   2014/12/27   | user1       | description1  | folder1 | secret   |user2          | tag1 |
          | folder2     |   2014/12/28   | user2       | description2  | folder2 | secret   |null           | tag2 |
          | folder3     |   2014/12/29   | null        | description3  | folder3 | secret   |null           | null |

      And existing files:
          | filename  |   uploadDate   | username    | folder      | userWithAccess | tags |
          | file1     |   2014/12/27   | user1       | folder1     |      user1     | tag1 |
          | file2     |   2014/12/28   | user2       | null        |      null      | tag2 |
          | file3     |   2014/12/29   | null        | folder2     |      null      | null |

    Scenario: List elements
        Given I am on the homepage
        Then  I should see 6 elements

    Scenario: List elements in a folder
        Given I am on the homepage
        And I am authenticated as "user1" with "secret1"
        And "user1" has access to "folder1"
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
            | tag1      | 2         |

    Scenario: Access to a protected folder
        Given I am on the homepage
        When I follow "folder1"
        Then I should see "Password"
        When I fill in "Password" with "secret"
        And I press "form_submit"
        Then access is granted to "user3" in "folder1"
        Then I should be on "folder/folder1"

    Scenario: Download a file
        Given I am authenticated as "user1" with "secret1"
        And "user1" can access to "file1"
        When I follow "Download file1"
        Then I should see "File downloaded successfully"

