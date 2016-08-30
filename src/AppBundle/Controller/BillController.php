<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BillController
 * @package AppBundle\Controller
 * @Route(path="/settings/createbill", name="billCreate")
 */
class BillController extends Controller
{
    /**
     * @Route("", name="billCreate")
     * @return array
     */
    public function showAction()
    {
        echo "<script  type=\"text/javascript\">"
            . "alert(\" You clicked 'Create new bill', good job! \");"
            . "</script>";

        return [];
    }
}