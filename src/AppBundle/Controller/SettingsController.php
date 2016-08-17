<?php
namespace AppBundle\Controller;

use AppBundle\Controller\Traits\Doctrine;
use AppBundle\Entity\Settings;
use AppBundle\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SettingsController
 * @package AppBundle\Controller
 * @Route(path="/settings", name="settings")
 */
class SettingsController extends Controller
{
    use Doctrine;

    /**
     * @Route(path="", name="settings:index")
     * @Template("AppBundle:Settings:settingsIndex.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}

