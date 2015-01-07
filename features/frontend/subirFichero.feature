#language: es
Característica: subir ficheros
Para subir ficheros
Como usuario de consigna
Quiero poder subir ficheros

Antecedentes:

Dado que existen los usuarios;

|jamartinez@uco.es|
|sergio@uco.es

Y tiempoAntesDeBorrado es:

|7|

Escenario: subir fichero sin autenticar
  Dado que estoy en la página de inicio
  Y no estoy autenticado
  Y marco "subir fichero"
  Y adjunto el archivo "fichero1"
  Y es fecha "27/12/14"
  Entonces debo ver "El fichero 'fichero1' se ha subido correctamente"

Escenario: subir fichero autenticado
  Dado que estoy en la página de inicio
  Y estoy autenticado como "jamartinez@uco.es"
  Y marco "subir fichero"
  Y adjunto el archivo "fichero2"
  Y es fecha "28/12/14"
  Entonces debo ver "El fichero 'fichero2' se ha subido correctamente"




#Dado que existen los ficheros:
#| nombre | fechaSubida  | fechaBorrado  | propietario       |
#|fichero1| 27/12/14     | 05/01/15      | anonimo           |
#|fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
#|fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |