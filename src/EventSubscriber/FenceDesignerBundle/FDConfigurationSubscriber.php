<?php

namespace App\EventSubscriber\FenceDesignerBundle;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\FenceDesignerBundle\FDConfiguration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FDConfigurationSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['prepareItemsCollection', EventPriorities::PRE_VALIDATE]
            ]
        ];
    }

    public function prepareItemsCollection(ViewEvent $event)
    {
        $item = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($item instanceof FDConfiguration && Request::METHOD_POST === $method) {
            // handle collection
        } else {
            return;
        }
    }
}