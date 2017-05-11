<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use VehiculeBundle\Entity\Vehicule;
use Symfony\Component\HttpFoundation\File\File;

class UploadListener {

    private $target;

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if ($entity instanceof Vehicule) {
            $this->target = 'uploads/images/vehicules';
        } elseif ($entity instanceof Vehicule) {
            $this->target = 'uploads/images/profils';
        } else {
            return;
        }
        $fileName = $entity->getPath();
        $file_path = $this->getTarget() . '/' . $fileName;
        if (!is_file($file_path)) {
            $entity->setPath(new File($this->getTarget() . '/default_vehicule.png'));
        } else {
            $entity->setPath(new File($file_path));
        }
    }

    private function getTarget() {
        // return $this->getParameter('brochures_directory');
        return $this->target;
    }

}
