#language: es
@carpetas

  Característica: Acceso a carpeta
    Para ver ficheros de una carpeta
    Como usuario de consigna
    Quiero acceder a carpetas

  Antecedentes:

    Dado existen las carpetas:

    |nombre  | descripción      |fechaCreacion| password  |
    |Carpeta1| carpeta número 1 | 12015/08/01 | pCarpeta1 |

    Y estoy autorizado

    Escenario: Acceder a carpeta con clave

      Dado estoy en la página de inicio
      Cuando presiono "Carpeta1"
      Entonces debo ver "Introduzca la contraseña para acceder a la carpeta"
      Cuando relleno "password" con "ContraseñaCarpeta1"
      Entonces debo estar en Carpeta1.


