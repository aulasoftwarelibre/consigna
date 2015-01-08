#language: es
@login
  Característica: Hacer login
  Para poder acceder a consigna como usuario autenticado
  Como usuario de consigna sin autenticar
  Quiero poder hacer login

  Antecedentes:

    existen los usuarios;

    |jamartinez@uco.es|
    |sergio@uco.es    |

  Escenario: acceder a la página de login desde página principal
    Dado que estoy en la página principal
    Y soy un usuario no autenticado
    Cuando hago click en el botón "autenticarme"
    Entonces debo estar en la página de login


  Escenario: hacer login como usuario existente

    Dado que estoy en la pagina de login
    Y soy un usuario no autenticado
    Cuando introduzco "jamartinez@uco.es" en el cuadro de texto de usuario.
    Y introduzco la password en el cuadro de texto de password.
    Y hago click en el botón de submit
    Entonces debo estar logueado como jamartinez@uco.es


  Escenario: hacer login como usuario no existente

    Dado que estoy en la página de login
    Y soy un usuario no autenticado
    Cuando introduzco "pericoeldelospalotes" en el cuadro de texto de usuario.
    Y introduzco la password en el cuadro de texto de password.
    Y hago click en el botón de submit
    Entonces debo ver "usuario no registrado, regístrese previamente"

  Escenario: hacer login y olvidar escribir el nombre de usuario

    Dado que estoy en la página de login
    Y soy un usuario no autenticado
    Cuando introduzco la password en el cuadro de texto de password.
    Y hago click en el botón de submit
    Entonces debo ver "Debe completar el campo 'usuario'"

  Escenario: hacer login y olvidar escribir el nombre de usuario

    Dado que estoy en la página de login
    Y soy un usuario no autenticado
    Cuando introduzco "pericoeldelospalotes" en el cuadro de texto de usuario.
    Y hago click en el botón de submit
    Entonces debo ver "Debe completar el campo 'password'"

  Escenario: hacer login con un usuario no existente en la BD, pero existente en RedIris.

    Dado que estoy en la página de login
    Y soy un usuario no autenticado
    Cuando hago click en el botón "autenticar como usuario de Universidad de Córdoba"
    Entonces debo estar en la página de redIris.
    Cuando introduzco como usuario "sergio@uco.es"
    Y introduzco como contraseña "contraseñadesergio"
    Entonces debo estar logueado como "sergio@uco.es"
    Y debe crearse un registro en la BD

  |id|         nombre       |   usuario    |    password      |
  |2 |sergio gomez bachiller|sergio@uco.es |contraseñadesergio|


  Escenario: hacer logout.

    Dado que estoy en la página principal
    Y soy un usario autenticado "jamartinez@uco.es"
    Cuando hago click en el botón "logout"
    Entonces debo estar en la página principal
    Y debo no estar autenticado