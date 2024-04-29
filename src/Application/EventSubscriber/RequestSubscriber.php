<?php

declare(strict_types=1);

namespace MicroModule\Base\Application\EventSubscriber;

use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestSubscriber implements EventSubscriberInterface
{
    public const KEY_PROCESS_UUID = "processUuid";

    public const KEY_UUID = "uuid";

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => "onKernelRequest",
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $method = $request->getMethod();
        $payload = ($method === Request::METHOD_GET) ? $request->query->all() : $request->request->all();

        if ($request->getContent() !== "") {
            $payload = $request->toArray();
        }

        if (isset($payload[static::KEY_PROCESS_UUID])) {
            return;
        }
        $this->setProcessUuidToRequest($method, $request, $payload);
    }

    protected function setProcessUuidToRequest(string $method, Request $request, array $payload): void
    {
        switch ($method) {
            case Request::METHOD_GET:
                $payload[static::KEY_PROCESS_UUID] = Uuid::uuid6()->toString();
                $request->query->add($payload);
                break;
            case Request::METHOD_POST:
            case Request::METHOD_PATCH:
            case Request::METHOD_PUT:
            case Request::METHOD_DELETE:
            case Request::METHOD_PURGE:
                $payload[static::KEY_PROCESS_UUID] = Uuid::uuid6()->toString();
                $request->request->add($payload);
                break;
        }
    }
}
