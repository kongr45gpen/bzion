<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package BZiON\Controllers
 */
abstract class HTMLController extends Controller
{
    /**
     * Prepare the twig global variables
     */
    protected function prepareTwig()
    {
        $request = $this->getRequest();

        // Add global variables to the twig templates
        $twig = Service::getTemplateEngine();
        $twig->addGlobal("request", $request);
        $twig->addGlobal("session", $request->getSession());
        $twig->addGlobal("pages", Page::getPages());
        $twig->addGlobal("me",
            new Player($request->getSession()->get('playerId')));
    }

    /**
     * {@inheritDoc}
     *
     * @throws ModelNotFoundException
     */
    protected function findModelInParameters($modelParameter, $routeParameters)
    {
        $model = parent::findModelInParameters($modelParameter, $routeParameters);

        if (!$model instanceof UrlModel || $model->isValid())
            return $model;
        elseif ($modelParameter->getName() !== "me")
            throw new ModelNotFoundException($model->getParamName());

        return $model;
    }

    /**
     * {@inheritDoc}
     */
    public function callAction($action=null)
    {
        try {
            $this->prepareTwig();

            return parent::callAction($action);
        } catch (ModelNotFoundException $e) {
            return $this->forward("NotFound", array("exception" => $e));
        } catch (HTTPException $e) {
            return $this->forward("Error", array(
                                           "message" => $e->getMessage(),
                                           "code" => $e->getErrorCode()));
        } catch (Exception $e) {
            // Let PHP handle the exception on the dev environment
            if (DEVELOPMENT) throw $e;
            return $this->forward("Error", array("message" => "An error occured"));
        }
    }

    /**
     * Action that will be called if an object is not found
     * @param ModelNotFoundException $exception The exception
     */
    public function notFoundAction(ModelNotFoundException $exception)
    {
        return new Response(
            $this->render("notfound.html.twig",
                    array("message" => $exception->getMessage(),
                          "type" => $exception->getType()
                    )),
            404);
    }

    /**
     * @param string $message The message to show
     * @param int    $code    The message's HTTP code
     */
    public function errorAction($message, $code=500)
    {
        return new Response(
            $this->render("error.html.twig",array("message" => $message)),
            $code
        );
    }

    /*
     * Returns the path to the home page
     * @return string
     */
    protected function getHomeURL()
    {
        return Service::getGenerator()->generate('index');
    }

    /*
     * Returns the URL of the previous page
     * @return string
     */
    protected function getPreviousURL()
    {
        // If the request's headers had an HTTP_REFERER parameter, go back there
        // Otherwise just redirect the user to the home page
        return $this->getRequest()->server->get('HTTP_REFERER',
                                                $this->getHomeURL());
    }

    /*
     * Returns a redirect response to the previous page
     * @todo Don't redirect to the same page
     * @return RedirectResponse
     */
    protected function goBack()
    {
        return new RedirectResponse($this->getPreviousURL());
    }

    /**
     * Returns a redirect response to the home page
     * @return RedirectResponse
     */
    protected function goHome()
    {
        return new RedirectResponse($this->getHomeURL());
    }

    /*
     * Assert that the user is logged in
     * @throws HTTPException
     * @param  string        $message The message to show if the user is not logged in
     * @return void
     */
    protected function requireLogin(
        $message="You need to be signed in to do this"
    ) {
        $me = new Player($this->getRequest()->getSession()->get('playerId'));

        if (!$me->isValid())
            throw new ForbiddenException($message);
    }

    /*
     * Show a confirmation (Yes, No) form to the user
     *
     * @param  callable $onYes            What to do if the user clicks on "Yes"
     * @param  callable $onNo             What to do if the user presses "No" - defaults to
     *                                    redirecting them back
     * @param  array    $additionalParams An array of variables to pass to the view
     * @param  string   $action           The text to show on the "Yes" button
     * @return mixed    The response
     */
    protected function showConfirmationForm($onYes, $onNo=null, $additionalParams=array(), $action="Yes")
    {
        $form = Service::getFormFactory()->createBuilder()
            ->add($action, 'submit')
            ->add(($action == 'Yes') ? 'No' : 'Cancel', 'submit')
            ->add('original_url', 'hidden', array(
                'data' => $this->getPreviousURL()
            ))
            ->getForm();

        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            if ($form->get($action)->isClicked())
                return $onYes();
            elseif (!$onNo)
                // We didn't get told about what to do when the user presses
                // no, just get them back where they were
                return new RedirectResponse($form->get('original_url')->getData());
            else
                return $onNo();
        }

        // The form hasn't been submitted, let's render it
        $params = array('form' => $form->createView());

        return array_merge($params, $additionalParams);
    }
}
