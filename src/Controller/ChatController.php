<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;

class ChatController extends AbstractController
{
    #[Route('/chat', name: 'chat')]
    public function index(): Response
    {
        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
        ]);
    }

    #[Route('/message', name: 'message')]
    public function message(): Response
    {
        return $this->render('chat/message.html.twig', [
            'controller_name' => 'ChatController',
        ]);
    }


    /**
     * @Route("/chat/token", name="get_token", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticate(Request $request): JsonResponse
    {

        $identity = $request->request->get('email');

        // Required for all Twilio access tokens
        $twilioAccountSid = 'ACb5fe3060c17bf285fb39b7f138b8d961';
        $twilioApiKey     = 'SK3b7ccbea5ee32e80fcffcbb5a55aacef';
        $twilioApiSecret  = 'uR3i5090QuMhDLJ4beC2EWLpagJxicRD';

        // Required for Chat grant
        $serviceSid = 'IS690f2d77f7fd4f9a9237ca71554fc82f';

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600,
            'rami.aouin@gmail.com'
        );

        // Create Chat grant
        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid($serviceSid);

        // Add grant to token
        $token->addGrant($chatGrant);

        // render token to json
        return $this->json([
            "status" => "success",
            "token" => $token->toJWT()
        ]);
    }
}
