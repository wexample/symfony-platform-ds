<?php

namespace Wexample\SymfonyPlatformDs\Controller\Pages;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyForms\Attribute\FormProcessor;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;
use Wexample\SymfonyPlatformDs\Service\FormProcessor\ContactFormProcessor;
use Wexample\SymfonyPlatformDs\Traits\SymfonyPlatformDsBundleClassTrait;

/**
 * A message to the people behind the application, from anyone: opened in a
 * modal from a link of the layout, or on its own.
 */
#[Route(path: '/contact')]
final class ContactController extends AbstractPagesController
{
    use SymfonyPlatformDsBundleClassTrait;

    final public const string ROUTE_INDEX = 'contact_index';

    #[Route(path: '', name: self::ROUTE_INDEX)]
    #[FormProcessor(
        processorClass: ContactFormProcessor::class,
        formArgumentName: 'contact_form'
    )]
    public function index(
        FormInterface $contact_form,
        ?string $contactRecipient
    ): Response {
        if (null === $contactRecipient) {
            throw $this->createNotFoundException();
        }

        return $this->renderPage('index', [
            'contact_form' => $contact_form->createView(),
            'sent' => $contact_form->isSubmitted() && $contact_form->isValid(),
        ]);
    }
}
