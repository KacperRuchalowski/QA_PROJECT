<?php
/**
 * Question controller.
 */

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
use App\Form\QuestionType;
use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use App\Service\QuestionService;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
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
     * Question service.
     */
    private QuestionService $questionService;

    /**
     * QuestionController constructor.
     *
     * @param QuestionService $questionService Question service
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="question_index",
     *
     * )
     */
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $pagination = $this->questionService->createPaginatedList($page);

        return $this->render(
            'Question/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * @param Request          $request
     * @param Question         $question
     * @param AnswerRepository $answerRepository
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *
     *     "/{id}",
     *     methods={"POST", "GET"},
     *     name="question_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     */
    public function show(Request $request, Question $question, AnswerRepository $answerRepository): Response
    {
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);
        $id = $question->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $answer->setQuestion($question);
            $answerRepository->save($answer);

            return $this->redirectToRoute('question_show', ['id' => $id]);
        }

        return $this->render(
            'Question/show.html.twig',
            ['question' => $question, 'form' => $form->createView()]
        );
    }

    /**
     * Create action.
     *
     * @param Request            $request            HTTP request
     * @param QuestionRepository $questionRepository Question repository
     *
     * @return Response HTTP response
     *
     * @IsGranted("ROLE_ADMIN")
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *     "/create",
     *     methods={"GET", "POST"},
     *     name="question_create",
     * )
     */
    public function create(Request $request, QuestionRepository $questionRepository): Response
    {
        $question = new Question();

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setCreatedAt(new DateTime());
            $questionRepository->save($question);
            $this->addFlash('success', 'question_created_successfully');

            return $this->redirectToRoute('question_index');
        }

        return $this->render(
            'Question/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request            $request            HTTP request
     * @param Question           $question           Question entity
     * @param QuestionRepository $questionRepository Question repository
     *
     * @return Response HTTP response
     *
     * @IsGranted("ROLE_ADMIN")
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="question_edit",
     * )
     */
    public function edit(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        $form = $this->createForm(QuestionType::class, $question, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->save($question);

            $this->addFlash('success', 'question_updated_successfully');

            return $this->redirectToRoute('question_index');
        }

        return $this->render(
            'Question/edit.html.twig',
            [
                'form' => $form->createView(),
                'question' => $question,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request            $request            HTTP request
     * @param Question           $question           Question entity
     * @param QuestionRepository $questionRepository Question repository
     *
     * @return Response HTTP response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="question_delete",
     * )
     */
    public function delete(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        if ($question->getAnswers()->count()) {
            $this->addFlash('warning', 'message_category_contains_questions');

            return $this->redirectToRoute('question_index');
        }

        $form = $this->createForm(FormType::class, $question, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->delete($question);
            $this->addFlash('success', 'question.deleted_successfully');

            return $this->redirectToRoute('question_index');
        }

        return $this->render(
            'Question/delete.html.twig',
            [
                'form' => $form->createView(),
                'question' => $question,
            ]
        );
    }
}
