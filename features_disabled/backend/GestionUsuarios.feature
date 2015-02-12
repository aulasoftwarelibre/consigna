#language: es
@usuarios

  Característica: Gestionar usuarios
    Para tener un control de los usuarios de consigna
    Como usuario administrador de consigna
    Quiero poder crear, borrar y modificar usuarios

  Antecedentes:
    Dado que existen los usuarios:

  |id|nombre|usuario     |password|rol          |
  |01|admin |admin@uco.es|admin   |administrador|
  |02|juanan |jamartinez@uco.es|paquete   |administrador|

  Escenario: crear nuevo usuario
    Dado que estoy en la página de administración
    Y soy un usuario con rol de administrador
    Cuando hago click en "gestión de usuarios"
    Entonces debo estar en la página de administración de usuarios.
    Y debo ver 1 usuario
    Cuando hago click en "crear nuevo usuario"
    Entonces debe aparecer un formulario para completar.
    Cuando escribo "juanan" en el cuadro de texto de nombre
    Y escribo "jamartinez@uco.es" en el cuadro de texto de usuario
    Y escribo "paquete" en el cuadro de texto de password
    Y selecciono un rol en el desplegable (en este caso "usuario")
    Y hago click en submit.
    Entonces debe crearse un nuevo registro en la BD:

      |id|nombre |usuario          |password  |rol          |
      |03|sergio |sergio@uco.es    |paquete   |administrador|

    Y debo leer "usuario creado satisfactoriamente"

  Escenario: eliminar usuario
    Dado que estoy en la página de administración
    Y soy un usuario con rol de administrador
    Cuando hago click en "gestión de usuarios"
    Entonces debo estar en la página de administración de usuarios.
    Y debo ver dos usuarios
    Cuando hago click en el botón "eliminar usuario" de jamartinez@uco.es
    Entonces debo ver "¿está seguro que desea eliminar el usuario?"
    Cuando hago click en "aceptar"
    Entonces debe eliminarse jamartinez@uco.es de la BD
    Y debo ver un usuario en la lista.

  Escenario: modificar campo de un usuario
    Dado que estoy en la página de administración
    Y soy un usuario con rol de administrador
    Cuando hago click en "gestión de usuarios"
    Entonces debo estar en la página de administración de usuarios
    Y debo ver la lista de usuarios
    Cuando hago click en el botón "modificar usuario" de jamartinez@uco.es
    Entonces debe aparecer un formulario relleno, que puede ser modificado
    Cuando modificamos el nombre "juanan" por "juan antonio" en el campo nombre
    Y pulsamos el botón submit
    Entonces debo ver:

      |id|nombre       |usuario          |password  |rol          |
      |01|admin        |admin@uco.es     |admin     |administrador|
      |02|juan antonio |jamartinez@uco.es|paquete   |administrador|


