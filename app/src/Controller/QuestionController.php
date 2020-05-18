<?php
/**
 * Question controller.
 */

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuestionController.
 *
 * @Route("/question")
 */
class QuestionController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \App\Repository\QuestionRepository $questionRepository QuestionRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="question_index",
     * )
     */
    public function index(QuestionRepository $questionRepository): Response
    {
        return $this->render(
            'question/index.html.twig',
            ['questions' => $questionRepository->findAll()]
        );
    }
}