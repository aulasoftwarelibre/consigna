@delete
  Feature: Delete File
    In order to delete a file of the system
    As a consigna user

  Background:
    Given existing users:
    |username     |email             |plainPassword   |enabled |
    |juanan       |jamartinez@uco.es |paquete         |  1     |
    |sergio       |sergio@uco.es     |putoamo         |  1     |

    And I am authenticated as "juanan"

    And existing files:
    |filename  | description      | uploadDate   | password  | owner              |
    |fichero1  | fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2  | fichero creado 1 | 2014/12/28   | pfichero2 | juanan             |
    |fichero3  | fichero creado 1 | 2014/12/29   | pfichero3 | sergio             |


    Scenario: Delete my own file
      Given I am on the homepage
      Then  I should see "Bienvenido juanan"
      And I should see "Eliminar fichero2"
      When I follow "Eliminar fichero2"
      Then I should see "Número de elementos: 2"

    Scenario: Delete file which is not mine.
      Given I am on the homepage
      Then I should not see "Eliminar fichero1"
      And  I should not see "Eliminar fichero3"
