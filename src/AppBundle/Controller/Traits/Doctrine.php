<?php  namespace AppBundle\Controller\Traits;

use Doctrine\Common\Collections\ArrayCollection;

trait Doctrine
{
    /**
     * @param ...$entities
     * @return $this
     */
    protected function persist(...$entities)
    {
        $manager = $this->getDoctrine()->getManager();
        foreach ($entities as $entity) {
            $manager->persist($entity);
        }
        return $this;
    }

    /**
     * @param array|ArrayCollection $entities
     * @return $this
     */
    protected function removeEntities($entities)
    {
        $manager = $this->getDoctrine()->getManager();

        foreach ($entities as $entity) {
            $manager->remove($entity);
        }

        return $this;
    }

    /**
     * @param ...$entities
     * @return $this
     */
    protected function remove(...$entities)
    {
        $manager = $this->getDoctrine()->getManager();

        foreach ($entities as $entity) {
            $manager->remove($entity);
        }

        return $this;
    }

    protected function flush($class = null)
    {
        $this->getDoctrine()->getManager()->flush($class);
    }

    /**
     * @param string $class
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function repo($class)
    {
        return $this->getDoctrine()->getManager()->getRepository($class);
    }

    private function inTransaction(Callable $func)
    {
        return $this->getDoctrine()->getConnection()->transactional($func);
    }
}
