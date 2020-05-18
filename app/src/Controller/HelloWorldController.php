<?php
/**
 * Hello World controller.
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HelloWorldController.
 */
class HelloWorldController
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="hello-world_index",
     * )
     */
    public function index(): Response
    {
        return new Response('Hello World!');
    }
}
