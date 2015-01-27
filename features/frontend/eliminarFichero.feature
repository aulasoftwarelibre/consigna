#language: es
  @borrar
  Característica: Eliminar fichero
  Para borrar un fichero del sistema
  Como usuario de consigna
  Quiero eliminar ficheros

  Antecedentes:

    Dado existen los usuarios:
    |username     |email            |plainPassword   |enabled |
    |juanan       |jamartinez@uco.es|paquete         | 1      |
    |sergio       |sergio@uco.es    |putoamo         |  1     |

    Y estoy autenticado como "juanan"

    Y existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | juanan             |
    |fichero3| fichero creado 1 | 2014/12/29   | pfichero3 | sergio             |


    Escenario: Eliminar fichero propio.
      Dado estoy en la página de inicio
      Entonces debo ver "Bienvenido juanan"
      Y debo ver "Eliminar fichero2"
      Y no debo ver "Eliminar fichero1"
      Y no debo ver "Eliminar fichero3"
      Cuando sigo "Eliminar fichero2"
      Entonces debo ver "Número de elementos: 2"


Escenario: Eliminar fichero que no es mio.
      Dado estoy en la página de inicio.
      Entonces no debo ver "Eliminar fichero1"
      Y no debo ver "Eliminar fichero3"
