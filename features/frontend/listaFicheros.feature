#language: es
@lista
  Característica: Listar ficheros
    Para saber qué ficheros existen en consigna
    Como usuario de consigna
    Quiero una lista de los ficheros

  Antecedentes:
    Dado existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | jamartinez@uco.es  |
    |fichero3| fichero creado 1 | 2014/12/29   | pfichero3 | sergio@uco.es      |

    Escenario: Listar ficheros
      Dado estoy en la página de inicio
      Entonces debo ver "Número de elementos: 3"

    Escenario: Buscar fichero existente
      Dado estoy en la página de inicio
      Cuando relleno "buscar" con "fichero1"
      Y presiono "búsqueda"
      Entonces debo ver "Número de elementos: 1"

    Escenario: Buscar fichero inexistente
      Dado estoy en la página de inicio
      Cuando relleno "buscar" con "guti"
      Y presiono "búsqueda"
      Entonces debo ver "Número de elementos: 0"

    Escenario: Buscar fichero sin completar cuadro de búsqueda
      Dado estoy en la página de inicio
      Cuando relleno "buscar" con "fich"
      Y presiono "búsqueda"
      Entonces debo ver "Número de elementos: 3"