#language: es

  Característica: subir fichero
  Para poder compartir ficheros
  Como usuario de consigna
  Quiero subir ficheros

  Antecedentes:
    Dado existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | jamartinez@uco.es  |

  Escenario: subir fichero
  Dado que estoy en la página de inicio
  Y fecha actual "2015/01/14"
  Cuando presiono "subir fichero"
  Y adjunto el archivo "fichero1"
  Y relleno "password" con "pfichero1"
  Entonces debo ver "Número de elementos: 3"
