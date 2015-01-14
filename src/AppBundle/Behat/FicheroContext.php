<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 19:14
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Fichero;
use Behat\Gherkin\Node\TableNode;

class FicheroContext extends CoreContext
{
    /**
     * @Given existen los ficheros:
     */
    public function crearLista (TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash){
            $fichero = new Fichero();
            $fichero->setNombre($hash['nombre']);
            $fichero->setFechaSubida(new \DateTime($hash['fechaSubida']));
            $fichero->setFechaBorrado(new \DateTime($hash['fechaBorrado']));

            $em-> persist($fichero); //preparamos la entidad para guardarla en la BD
        }
        $em->flush();
    }

    /**
     * @Given fecha actual
     */
    public function fechaActual()
    {
        return getdate();
    }
}