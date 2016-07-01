<?php namespace AppBundle\Controller;

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
 * @Route(path="/settings")
 */
class SettingsController extends Controller
{
    use Doctrine;

    /**
     * @Route("", name="settings:index");
     * @return array
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }
    /**
     * New settings creation action. Creates Form, validates it & saves data
     *
     * @Route(path="/new", name="app:settings:new")
     * @Template
     *
     * @param Request $request
     * @return array
     */
    public function newAction(Request $request) {
        $form = $this->createForm(SettingsType::class, $settings = new Settings());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->persist($form->getData());
            $this->flush();

            return $this->redirectToRoute('app:settings');
        }

        // Template is rendered from the one that is in annotation. You can tell the system in annotation what template
        // will be used, but if you leave empty @Template() value, it will use action name as template name by default,
        // e.g. newAction will use new.html.twig, editAction will use edit.html.twig, etc.
        return [
            'form' => $form->createView(),
            'settings' => $settings
        ];
    }

    /**
     * Edit action edits existing entry & updates data that was saved before
     *
     * @Route(path="/edit/{id}", name="app:settings:edit")
     *
     * @param Settings $settings
     * @param Request $request
     * @return array
     */
    public function editAction(Settings $settings, Request $request)
    {
        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->persist($form->getData());
            $this->flush();

            return $this->redirectToRoute('app:settings');
        }

        // You can use existing twig templates instead of creating ones when needed.
        // But the best way is to create different template for different action (new, edit, confirm, etc.)
        // If you have the need to use existing template code, create new template and include it in different parent
        // templates.
        return $this->render('AppBundle:Settings:new.html.twig', [
            'form' => $form->createView(),
            'settings' => $settings
        ]);
    }

    /**
     * Deletes selected entry from the system DB
     *
     * @Route(path="/delete/{id}", name="app:settings:delete")
     *
     * @param Settings $settings
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Settings $settings)
    {
        $this->remove($settings);
        $this->flush();

        return $this->redirectToRoute('app:settings');
    }

    /**
     * @Route(path="/test", name="app:settings:test")
     */
    public function testAction()
    {
        @Template("AppBundle:Settings:index.html.twig");
    }
}

