<?php

declare(strict_types=1);

namespace Ba\Rest\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestSubscriber implements EventSubscriberInterface
{
    private const SUPPORTED_TYPES = ['json', 'application/json'];

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 254],
        ];
    }


    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        if (!in_array($request->getContentType(), self::SUPPORTED_TYPES, true)) {
            return;
        }

        $content = $request->headers->has('data') ? $request->headers->get('data') : $request->getContent();
        $data = json_decode($content, true);
        if (false === $data) {
            throw new BadRequestHttpException('Request data is invalid');
        }

        $request->request->replace(is_array($data) ? $data : []);
    }
}