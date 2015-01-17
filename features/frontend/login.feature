#language: es
@login
  Característica: Identificación de usuario.
  Para poder acceder a consigna como usuario autenticado
  Como usuario de consigna
  Quiero poder identificarme mediante un formulario de login

  Antecedentes:
    Dado existen los usuarios;
    |nombre       |email            |password|
    |Juan Antonio |jamartinez@uco.es|paquete |
    |Sergio       |sergio@uco.es    |putoamo |

  Escenario: acceder a la página de login desde página principal
    Dado estoy en la página principal
    Cuando presiono "autenticarme"
    Entonces debo estar en "página de login"

  Escenario: hacer login con usuario existente
    Dado estoy en "página de login"
    Cuando relleno "usuario" con "jamartinez@uco.es"
    Y relleno "password" con "paquete"
    Y presiono "submit"
    Entonces debo ver "Autenticado como Juan Antonio"

  Escenario: hacer login como usuario no existente
    Dado estoy en "página de login"
    Cuando relleno "usuario" con "pericoeldelospalotes"
    Y relleno "password" con "palotes"
    Y presiono "submit"
    Entonces debo ver "Usuario no registrado, regístrese previamente"

  Escenario: hacer login y olvidar escribir un campo.
    Dado estoy en "página de login"
    Cuando relleno "password" con "paquete"
    Y presiono "submit"
    Entonces debo ver "Debe completar el campo 'usuario'"

  Escenario: hacer login con un usuario no existente en la BD, pero existente en RedIris.
    Dado estoy en "página de login"
    Cuando presiono "autenticar como usuario de Universidad de Córdoba"
    Entonces debo estar en "página de redIris".
    Cuando relleno "usuario" con "sergio@uco.es"
    Y relleno "password" con "contraseñasergio"
    Entonces debo ver "Autenticado como Sergio"