<?php

namespace Drupal\mymodule;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * FirstMiddleware middleware.
 */
class CustomMiddleware implements HttpKernelInterface {

    use StringTranslationTrait;

    /**
     * The kernel.
     *
     * @var \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected $httpKernel;

    /**
     * Constructs the FirstMiddleware object.
     *
     * @param \Symfony\Component\HttpKernel\HttpKernelInterface $http_kernel
     *   The decorated kernel.
     */
    public function __construct(HttpKernelInterface $http_kernel) {
        $this->httpKernel = $http_kernel;
    }

    /**
     * {@inheritdoc}
     */

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE): Response { 
       /* if ($request->getClientIp() == '127.0.0.1') {
            return new Response($this->t('hello world!'), 403);
        }*/
        return $this->httpKernel->handle($request, $type, $catch);
    }
}