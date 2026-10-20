<?php

namespace Wexample\SymfonyPlatformDs\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Wexample\SymfonyForms\Form\AbstractForm;
use Wexample\SymfonyForms\Form\Type\EmailInputType;
use Wexample\SymfonyForms\Form\Type\ProofOfWorkInputType;
use Wexample\SymfonyForms\Form\Type\TextareaInputType;
use Wexample\SymfonyForms\Form\Type\TextInputType;

/**
 * Who writes, where to answer, what they say — and the captcha, the form
 * being open to anyone.
 */
class ContactForm extends AbstractForm
{
    public const string FIELD_NAME = 'name';

    public const string FIELD_EMAIL = 'email';

    public const string FIELD_MESSAGE = 'message';

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add(self::FIELD_NAME, TextInputType::class, [
                self::FIELD_OPTION_NAME_LABEL => true,
                self::FIELD_OPTION_NAME_REQUIRED => true,
                'constraints' => [new NotBlank(), new Length(max: 100)],
            ])
            ->add(self::FIELD_EMAIL, EmailInputType::class, [
                self::FIELD_OPTION_NAME_LABEL => true,
                self::FIELD_OPTION_NAME_REQUIRED => true,
                'constraints' => [new NotBlank(), new Email(), new Length(max: 180)],
            ])
            ->add(self::FIELD_MESSAGE, TextareaInputType::class, [
                self::FIELD_OPTION_NAME_LABEL => true,
                self::FIELD_OPTION_NAME_REQUIRED => true,
                'constraints' => [new NotBlank(), new Length(min: 10, max: 5000)],
            ])
            ->add('captcha', ProofOfWorkInputType::class);

        $this->builderAddSubmit($builder);
    }
}
