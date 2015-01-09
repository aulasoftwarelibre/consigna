#language: es
@carpetas

Característica: Eliminar una carpeta desde la página principal
Para poder eliminar una carpeta sin necesidad de entrar en el backend.
Como usuario propietario de la carpeta.
Quiero poder eliminar carpetas

Antecedentes:

existe la carpeta:

  |id|nombre  |fechaCreacion|fechaBorrado|propietario      |
  |01|Carpeta1|  08/01/2015 |15/01/2015  |jamartinez@uco.es|
  |02|Carpeta2|  08/01/2015 |15/01/2015  |sergio@uco.es    |
  |03|Carpeta3|  08/01/2015 |15/01/2015  |anónimo          |


Y existe el usuario:

  |jamartinez@uco.es|
  |sergio@uco.es    |


Escenario: Eliminar mi propia carpeta

  Dado que estoy en la página principal
  Y soy el usuario "jamartinez@uco.es"
  Y hago click en el botón "eliminar" de "Carpeta1"
  Entonces debo ver "Introduzca la contraseña"
  Cuando introduzco "ContraseñaCarpeta1" en el cuadro de texto de password.
  Y la password es correcta.
  Entonces la carpeta se eliminará de la BD.

Escenario: Eliminar una carpeta que no es mía.

  Dado que estoy en la página principal
  Y soy el usuario "jamartinez@uco.es"
  Y hago click en el botón "eliminar" de "Carpeta2"
  Entonces debo ver "Solo 'sergio@uco.es' puede eliminar esta carpeta"


Escenario: Eliminar una carpeta creada por un usuario anónimo.
  Dado que estoy en la página principal
  Y soy cualquier usuario de consigna.
  Y hago click en el botón "eliminar" de "Carpeta3"
  Entonces debo ver "esta carpeta no puede ser eliminada manualmente"

