#language: es
  @borrar
  Característica: Eliminar fichero
  Para borrar un fichero del sistema
  Como usuario de consigna
  Quiero eliminar ficheros

  Antecedentes:

    Dado existen los usuarios:
    |username     |email            |password|
    |Juanan       |jamartinez@uco.es|paquete |
    |Sergio       |sergio@uco.es    |putoamo |

    Y estoy autenticado como "Juanan"

    Y existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | Juanan             |
    |fichero3| fichero creado 1 | 2014/12/29   | pfichero3 | Sergio             |


    Escenario: Eliminar fichero propio.
      Dado estoy en la página de inicio.
      Y debo ver "Eliminar fichero2"
      Cuando sigo "Eliminar fichero2"
      Entonces debo ver "Número de elementos: 2"

    Escenario: Eliminar fichero que no es mio.
      Dado estoy en la página de inicio.
      Entonces no debo ver "Eliminar fichero1"
      Y no debo ver "Eliminar fichero3"
