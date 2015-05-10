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


    Scenario: List elements
        Given I am on the homepage
        Then  I should see 5 elements

  @download @test
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
        And I should see 1 elements

    Scenario Outline: Search files by name
        Given I am on the homepage
        When I fill in "search-button" with "<word>"
        And I press "Search"
        Then I should see <number> elements

        Examples:
            | word      | number    |
            | file1     | 1         |
            | f         | 7         |
            | nothing   | 0         |
            | tag1      | 2         |

    Scenario: Access to a protected folder
        Given I am on the homepage
        And I am authenticated as "user3" with "secret3"
        When I follow "folder1"
        Then I should see "Password"
        When I fill in "Password" with "secret"
        And I press "Submit"
        Then access is granted to "user3" in "folder1"
        Then I should be on "folder/folder1"

  @download
      Scenario: Download a file
        Given I am authenticated as "user1" with "secret1"
        And "user1" can access to "file4"
        When I follow "Download file4"
        Then I should be on "file/file4/download"

  @download
      Scenario: Download a file with a password
        Given I am authenticated as "user1" with "secret1"
        When I follow "Download file2"
        Then I should be on "/file/file2/download/validation"
        When I fill in "Password" with "secret"
        And I press "Submit"
        Then access is granted to "user1" in file "file2"
        And I should be on "file/file2/download"

  @folder
      Scenario: Create a folder with an authenticated user
        Given I am authenticated as "user1" with "secret1"
        When I follow "Create folder"
        Then I should be on "/folder/create"
        When I fill in "Folder name" with "folder4"
        And I fill in "Description" with "description4"
        And I fill in "Password" with "secret4"
        And I press "Save"
        Then I should see "Folder folder4 has been created successfully"

  @upload
  Scenario: Upload a file with an authenticated user
    Given I am authenticated as "user1" with "secret1"
    When I follow "Upload file"
    Then I should be on "file/create"
    When I fill in "Filename" with "file4"
    And I fill in "Password" with "secret4"
    And I press "Save"
    Then I should see "File file4 has been created successfully"

  @upload
  Scenario: Upload a file with an authenticated user in a folder
    Given I am authenticated as "user1" with "secret1"
    And I am on "folder/folder1"
    And "user1" is the "folder1" owner
    When I follow "Upload file"
    Then I should be on "folder/folder1/uploadFile"
    When I fill in "Filename" with "file4"
    And I fill in "Password" with "secret4"
    And I press "Save"
    Then I should see "File file4 has been created successfully"
    And folder "folder1" has file "file4"

