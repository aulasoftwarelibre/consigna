@sprint1
  Feature: User identification
    In order to access to consigna as authenticated user
    As a consigna user
    I want to get identification with a login form

  Background:
    Given existing users:
    |username     |email             |plainPassword |enabled |
    |juanan       |jamartinez@uco.es |paquete       | 1      |
    |sergio       |sergio@uco.es     |putoamo       | 1      |

    Scenario: login with an existing user
      Given I am on "/login"
      When I fill in "username" with "juanan"
      And I fill in "password" with "paquete"
      And I press "submit"
      Then I should see "Sign out"

    Scenario: login with a non existing user
      Given I am on "login"
      When I fill in "username" with "pedro"
      And I fill in "password" with "pedro"
      And I press "submit"
      Then I should see "Bad credentials"

    Scenario: go to /login from homepage
      Given I am on the homepage
      When I follow "Sign in"
      Then I am on "/Login"


#  Escenario: acceder a la página de login desde página principal
#  Dado estoy en la página principal
#  Cuando presiono "autenticarme"
#  Entonces debo estar en "página de login"
#
#  Escenario: hacer login con un usuario no existente en la BD, pero existente en RedIris.
#    Dado estoy en "página de login"
#    Cuando presiono "autenticar como usuario de Universidad de Córdoba"
#    Entonces debo estar en "página de redIris".
#    Cuando relleno "usuario" con "sergio@uco.es"
#    Y relleno "password" con "contraseñasergio"
#    Entonces debo ver "Autenticado como Sergio"
