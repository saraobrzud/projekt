<?php
/**
 * Hello controller.
 *
 * @copyright (c) 2016 Tomasz Chojna
 * @link http://epi.chojna.info.pl
 */
namespace Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Form\PollForm;

/**
 * Class HomeController
 */
class PollController implements ControllerProviderInterface
{
    /**
     * Routing settings.
     *
     * @param \Silex\Application $app Silex application
     *
     * @return \Silex\ControllerCollection Result
     */
    public function connect(Application $app)
    {
        $controller = $app['controllers_factory'];
        $controller->match('list', array($this, 'indexAction'))
            ->bind('poll_list');
        $controller->match('add', array($this, 'addAction'))
            ->bind('poll_add');
        return $controller;
    }

    /**
     * Index action.
     *
     * @param \Silex\Application                        $app     Silex application
     * @param \Symfony\Component\HttpFoundation\Request $request Request object
     *
     * @return string Response
     */
    public function indexAction(Application $app, Request $request)
    {
        $queryBuilder = $app['db']->createQueryBuilder();
        $queryBuilder->select('id', 'name')
            ->from('poll');

        $result = $queryBuilder->execute()->fetchAll();
        return $app['twig']->render('poll/list.html.twig', [
            'polls' => $result
        ]);
    }

    public function addAction(Application $app, Request $request)
    {
        $form = $app['form.factory']->createBuilder(PollForm::class)->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $conn = $app['db'];
            $conn->insert('poll', $data);
            echo 'Dodano ankiete';
        }

        $this->view['form'] = $form->createView();

        return $app['twig']->render('poll/add.html.twig', array('form' => $form->createView()));
    }

}