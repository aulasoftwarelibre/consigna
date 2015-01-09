#language: es
@carpetas

  Característica: Crear carpeta
  Para poder clasificar ficheros
  Como usuario de consigna
  Quiero poder crear carpetas

  Antecedentes:

  existen los usuarios;

  |jamartinez@uco.es|
  |sergio@uco.es    |

  Escenario: Crear carpeta

    Dado que estoy en la página principal
    Como usuario de consigna
    Y hago click en el botón "crear carpeta"
    Entonces debo ver una ventana con: "Nombre de la carpeta" y "password"
    Cuando escribo "Carpeta1" en el cuadro de texto de "Nombre de la carpeta"
    Y escribo "passwordCarpeta1" en el cuadro de texto de "password"
    Y es fecha "08/01/2015"
    Entonces debe aparecer "Carpeta1" en la lista de ficheros y carpetas de la página principal.
    Y debe existir un registro en la BD

    |id|nombre  |fechaCreacion|fechaBorrado|propietario      |
    |01|Carpeta1|  08/01/2015 |15/01/2015  |jamartinez@uco.es|





