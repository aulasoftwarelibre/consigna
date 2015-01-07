#language: es
Característica: ficheros
  Para llevar una gestión de los ficheros
  Como usuario de consigna
  Quiero poder listar todos los ficheros

Antecedentes:
  Dado que existen los ficheros:
  | nombre | fechaSubida  | fechaBorrado  | propietario       |
  |fichero1| 27/12/14     | 05/01/15      | anonimo           |
  |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
  |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

  Escenario: Listar ficheros
    Dado que estoy en la página de inicio
    Entonces debo ver "Número de archivos: 3"
