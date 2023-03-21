<?php

namespace App\Controller;

use OpenAI;
use App\Form\CoverType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    #[Route('/app', name: 'app_index')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CoverType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $client = OpenAI::client($this->getParameter('openai'));
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'My name is'.$data['firstname'].' '.$data['lastname']],
                    ['role' => 'user', 'content' => 'My defrees '.$data['degrees']],
                    ['role' => 'user', 'content' => 'Target company'.$data['company']],
                    ['role' => 'user', 'content' => 'Target job'.$data['job']],
                    ['role' => 'user', 'content' => 'Offer '.$data['offer']],
                    ['role' => 'user', 'content' => 'Write a persuasive and personalized cover letter'],
                ],
            ]);

            $message = $response->toArray()['choices'][0]['message']['content'];
        }

        return $this->render('app/index.html.twig', [
            'form' => $form->createView(),
            'message' => $message ?? null,
        ]);
    }
}
