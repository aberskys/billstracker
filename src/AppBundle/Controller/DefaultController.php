<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Route(path="")
 */
class DefaultController extends Controller
{
    /**
     * @Route("", name="homepage")
     * @Template("AppBundle:Index:index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}
