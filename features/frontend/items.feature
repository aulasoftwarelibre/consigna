@items
Feature: manage items
  In order to get and to share items
  As a consigna user
  I want to manage items
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
      | file1     | user1       | null        |      user1     | tag2 |
      | test.pdf  | user1       | null        |      null      | null |

  Scenario: List elements in a folder
      Given I am on the main folder
      And I am authenticated as "user1" with "secret1"
      And "user1" has access to "folder1"
      When I follow "folder1"
      Then I should be on "en/folder/folder1"
      And I should see 1 elements

  Scenario: Access to a protected folder
      Given I am on the main folder
      And I am authenticated as "user3" with "secret3"
      When I follow "folder1"
      Then I should see "Password"
      When I fill in "Password" with "secret"
      And I press "Check password"
      Then access is granted to "user3" in "folder1"
      Then I should be on "en/folder/folder1"

  Scenario: Download a file
    Given I am on the main folder
    And I am authenticated as "user3" with "secret3"
    When I follow "Download test.pdf"
    Then I should see "Download file"
    When I fill in "Password" with "secret"
    And I press "Check password"
    And I should see "valid"
    And "user3" can access to "test.pdf"
    When I follow "Download test.pdf"
    Then I should see response status code "200"
    And I should see in the header "content-type":"application/pdf"

  Scenario: Download a file in a folder
    Given I am authenticated as "user1" with "secret1"
    And "user1" has access to "folder1"
    And I go to "en/folder/folder1"
    When I follow "Download file1"
    Then I should see response status code "200"
    And I should see in the header "content-type":"application/pdf"

  Scenario: Create a folder
    Given I am on the main folder
    And I am authenticated as "user1" with "secret1"
    When I follow "New folder"
    Then I should be now on "folder_new"
    When I fill in "Name" with "folder4"
    And I fill in "Tags" with "tag2"
    And I fill in "Password" with "secret4"
    And I fill in "Repeat password" with "secret4"
    And I press "Create folder"
    Then I should see 6 elements
    Then I should see "Folder folder4 has been created successfully"

  Scenario: Try to create a folder without authentication
    Given I am on the main folder
    When I go to "en/folder/new"
    Then I should be on "/login"

  @javascript
  Scenario: Upload a file
    Given I am authenticated as "user2" with "secret2"
    And I am on the main folder
    Then I should be on the main folder
    When I follow "Upload file"
    Then I should be now on "file_upload"
    When I attach the file "~/Descargas/test2.pdf" to "File"
    And I fill in "Tags" with "tag2"
    And I fill in "Password" with "secret4"
    And I fill in "Repeat password" with "secret4"
    And I press "Upload"
    Then I should see "File test2.pdf has been uploaded successfully"
    And I should see 6 elements

  @javascript
  Scenario: Upload a file in a folder
    Given I am authenticated as "user1" with "secret1"
    And "user1" has access to "folder1"
    And I go to "en/folder/folder1"
    And I should see "Upload File"
    And I follow "Upload file"
    Then I should be on "en/folder/folder1/file/upload"
    When I attach the file "~/Descargas/test2.pdf" to "File"
    And I press "Upload"
    Then I should see 2 elements
    And I should see "File test2.pdf has been uploaded successfully"

  @javascript
  Scenario: Try to upload a file in a folder that is not yours
    Given I am authenticated as "user2" with "secret2"
    And "user2" has access to "folder1"
    And I go to "en/folder/folder1"
    Then I should not see "Upload File"
    And I go to "en/folder/folder1/file/upload"
    Then I should see "Access Denied."

  @javascript
  Scenario: Remove my own file
    Given I am on the main folder
    And I am authenticated as "user1" with "secret1"
    When I follow "Delete file1"
    And I follow "delete"
    Then I should see 4 elements

  @javascript
  Scenario: Remove my own folder
    Given I am on the main folder
    And I am authenticated as "user1" with "secret1"
    When I follow "Delete folder1"
    And I follow "delete"
    Then I should see 4 elements

  @javascript
  Scenario: Share a file
    Given I am on the main folder
    And I am authenticated as "user1" with "secret1"
    When I follow "Share file1"
    And I press "sharebtn"

  @javascript
  Scenario: Share my folder
    Given I am on the main folder
    And I am authenticated as "user1" with "secret1"
    When I follow "Share folder1"
    And I press "sharebtn"

  @javascript
  Scenario: Share a file in a folder
    Given I am authenticated as "user1" with "secret1"
    And "user1" has access to "folder1"
    And I go to "en/folder/folder1"
    When I follow "Share file1"
    And I press "sharebtn"

  @javascript
  Scenario: Share a file in a folder
    Given I am authenticated as "user1" with "secret1"
    And "user1" has access to "folder1"
    And I go to "en/folder/folder1"
    When I follow "Delete file1"
    And I follow "delete"
    Then I should see 0 elements

