#language: es
@ficheros

  Característica: Gestionar ficheros
    Para tener un mayor control de los ficheros que hay en consigna.
    Como usuario administrador
    Debo poder eliminar y modificar ficheros

  Antecedentes:
    Dado que existen los ficheros:
    | nombre | fechaSubida  | fechaBorrado  | propietario         |
    |fichero1| 27/12/14     | 05/01/15      | anonimo             |
    |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es   |
    |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es       |

    Y existen los usuarios:
    |id|nombre|usuario           |password        |rol            |
    |01|admin |admin@uco.es      |admin           |administrador  |
    |02|juanan|jamartinez@uco.es |paquete         |usuario        |

    Y tiempoAntesDeBorrado es:

    |7|

  Escenario: eliminar fichero
    Dado que estoy en la página de administración
    Y soy un usuario con rol de administrador
    Cuando hago click en "gestión de ficheros"
    Entonces debo estar en la página de administración de ficheros.
    Y debo ver 3 ficheros
    Cuando hago click en el botón "eliminar fichero" de "fichero1"
    Entonces debo ver "¿está seguro que desea eliminar el fichero?"
    Cuando hago click en "aceptar"
    Entonces debe eliminarse "fichero1" de la BD
    Y debo ver dos ficheros

  Escenario: modificar campo de un fichero
    Dado que estoy en la página de administración
    Y soy un usuario con rol de administrador
    Cuando hago click en "gestión de ficheros"
    Entonces debo estar en la página de administración de ficheros
    Y debo ver 3 ficheros
    Cuando hago click en el botón "modificar fichero" de "fichero1"
    Entonces debe aparecer un formulario relleno, que puede ser modificado
    Cuando modificamos el nombre "fichero1" por "fichero" en el campo nombre
    Y pulsamos el botón submit
    Entonces debo ver:

    | nombre | fechaSubida  | fechaBorrado  | propietario         |
    |fichero | 27/12/14     | 05/01/15      | anonimo             |
    |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es   |
    |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es       |


  Escenario: modificar fecha de borrado automático de fichero
    Dado que estoy en la página de administración
    Y soy un usuario con rol de administrador
    Cuando hago click en "configuración"
    Entonces debo ver un formulario.
    Entonces modifico "7" por "5" en el campo "días para borrado automático"
    Y hago click en "submit"
    Entonces debe comparar si hay algún fichero que cumpla los días hoy.
    Y debo ver:

    | nombre | fechaSubida  | fechaBorrado  | propietario         |
    |fichero | 27/12/14     | 01/01/15      | anonimo             |
    |fichero2| 28/12/14     | 02/01/15      | jamartinez@uco.es   |
    |fichero3| 29/12/14     | 03/01/15      | sergio@uco.es       |