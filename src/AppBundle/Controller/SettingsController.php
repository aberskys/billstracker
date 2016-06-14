<?php namespace AppBundle\Controller;

use AppBundle\Controller\Traits\Doctrine;
use AppBundle\Entity\Settings;
use AppBundle\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route(path="", name="app:settings")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        // If you'll need some data from database or you will have an urge to write data to DB, use Doctrine trait in
        // controller (Read: http://php.net/manual/en/language.oop5.traits.php)
        // Main functions are: persist(), flush(), remove().
        // Persist - creates object out of given data before saving it to the database
        // Remove - removes entry from DB.
        // Flush - flushes data changes to DB (note, that this can be done only once in an action). Flush() must always
        // be done after persist() or remove() method.
        $settings = $this->repo(Settings::class)->findAll();
        return [
            'settings' => $settings
        ];
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
}
