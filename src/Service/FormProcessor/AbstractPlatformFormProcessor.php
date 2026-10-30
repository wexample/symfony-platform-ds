<?php

namespace Wexample\SymfonyPlatformDs\Service\FormProcessor;

use Symfony\Component\Form\FormInterface;
use Wexample\SymfonyForms\Service\FormProcessor\AbstractFormProcessor;

/**
 * What a management application does with a valid form: it saves what the
 * form holds, then goes back where the reader came for — a list, most often.
 * A processor writes the saving (`save()`) and says where it leads
 * (`getRedirectRoute()`, `getRedirectParameters()`); one that leads nowhere
 * stays on the form, and one doing more overrides `onValid()`.
 */
abstract class AbstractPlatformFormProcessor extends AbstractFormProcessor
{
    public function onValid(FormInterface $form): void
    {
        $this->save($form);

        if ($route = $this->getRedirectRoute($form)) {
            $this->redirectToRoute($route, $this->getRedirectParameters($form));
        }
    }

    /** Saves what the valid form holds. */
    abstract protected function save(FormInterface $form): void;

    /** The route led to once saved, or null to stay. */
    protected function getRedirectRoute(FormInterface $form): ?string
    {
        return null;
    }

    protected function getRedirectParameters(FormInterface $form): array
    {
        return [];
    }

    /** A parameter of the page the form was sent from: a project, a scenario. */
    protected function getPageParameter(string $name): string
    {
        return (string) $this->request?->attributes->get($name);
    }
}
