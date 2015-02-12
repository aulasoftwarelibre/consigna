@sprint1
  Feature: List files
    In order to know what files are in consigna
    As a consigna user
    I want a list of files

  Background:

    Given existing users:
      |username     |email             |plainPassword    |enabled |
      |juanan       |jamartinez@uco.es |paquete          |  1     |
      |sergio       |sergio@uco.es     |putoamo          |  1     |
      |anonimo      |anonimo@uco.es    |putoamo          |  1     |

    And existing files:
    | filename |   uploadDate   | password   |username|
    |fichero1  |   2014/12/27   | pfichero1  |juanan  |
    |fichero2  |   2014/12/28   | pfichero2  |sergio  |
    |fichero3  |   2014/12/29   | pfichero3  |anonimo |

    Scenario: List files
      Given I am on the homepage
      Then  I should see "fichero1"
      And  I should see "fichero2"
      And  I should see "fichero3"

    #Escenario: Buscar fichero existente
    #  Dado estoy en la página de inicio
    #  Cuando relleno "buscar" con "fichero1"
    #  Y presiono "búsqueda"
    #  Entonces debo ver "Número de elementos: 1"

    #Escenario: Buscar fichero inexistente
    #  Dado estoy en la página de inicio
    #  Cuando relleno "buscar" con "guti"
    #  Y presiono "búsqueda"
    #  Entonces debo ver "Número de elementos: 0"

    #Escenario: Buscar fichero sin completar cuadro de búsqueda
    #  Dado estoy en la página de inicio
    #  Cuando relleno "buscar" con "fich"
    #  Y presiono "búsqueda"
    #  Entonces debo ver "Número de elementos: 3"