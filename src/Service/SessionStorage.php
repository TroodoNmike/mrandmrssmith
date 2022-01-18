<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionStorage implements StorageInterface
{
    public const DEFAULT_RESULT = 0;
    public const SESSION_RESULT_KEY = 'result';

    protected SessionInterface $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public function get(): float
    {
        return $this->session->get(self::SESSION_RESULT_KEY, self::DEFAULT_RESULT);
    }

    public function save(float $result): void
    {
        $this->session->set(self::SESSION_RESULT_KEY, $result);
    }

    public function reset(): void
    {
        $this->session->set(self::SESSION_RESULT_KEY, self::DEFAULT_RESULT);
    }
}
