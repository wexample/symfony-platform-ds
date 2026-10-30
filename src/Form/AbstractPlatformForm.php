<?php

namespace Wexample\SymfonyPlatformDs\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Wexample\SymfonyForms\Form\AbstractForm;

/**
 * A form of a management application: its fields, then the button sending it,
 * added here so that no form goes without one. A form sends itself
 * otherwise by saying so (`hasSubmit()`), names its button
 * (`getSubmitLabel()`), or builds everything itself by overriding
 * `buildForm()`.
 */
abstract class AbstractPlatformForm extends AbstractForm
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $this->buildFields($builder, $options);

        if ($this->hasSubmit()) {
            $this->builderAddSubmit($builder, $this->getSubmitLabel());
        }
    }

    /** The fields the form asks for, its button aside. */
    abstract protected function buildFields(
        FormBuilderInterface $builder,
        array $options
    ): void;

    protected function hasSubmit(): bool
    {
        return true;
    }

    /** The translation key of the button, in the form's own domain. */
    protected function getSubmitLabel(): string
    {
        return 'action.submit';
    }
}
