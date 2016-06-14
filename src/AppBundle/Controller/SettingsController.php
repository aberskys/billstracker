<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class SettingsController
 * @package AppBundle\Controller
 * @Route(path="/settings")
 */
class SettingsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route(path="/new")
     */
    public function newAction() {
    }
}
