#language: es
@carpetas

Característica: Descargar un fichero dentro de una carpeta
Para poder tener el fichero que me interesa compartido en una carpeta
Como usuario de consigna
Quiero poder descargar ficheros que se encuentren dentro de carpetas

Antecedentes:

Dado que existe la carpeta:
  |id|nombre  |fechaCreacion|fechaBorrado|propietario      |password          |
  |01|Carpeta1|  08/01/2015 |15/01/2015  |jamartinez@uco.es|ContraseñaCarpeta1|


Y existen los ficheros:
  | nombre | fechaSubida  | fechaBorrado  | propietario       |
  |fichero1| 27/12/14     | 05/01/15      | anonimo           |
  |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
  |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

Y existen los usuarios;
|jamartinez@uco.es|
|sergio@uco.es    |

Escenario: Acceder a una carpeta
  Dado que estoy en la página de inicio
  Y hago click en la carpeta "Carpeta1"
  Entonces debo ver "Introduzca la contraseña para acceder a la carpeta"
  Cuando introduzco "ContraseñaCarpeta1" en el cuadro de texto de password.
  Entonces debo estar en la página de la carpeta.
  Dado que estoy en la página de la carpeta
  Y hago click en el botón descargar de "fichero1"
  Entonces debe descargarse el fichero
  Y debo ver "Fichero descargado correctamente"



