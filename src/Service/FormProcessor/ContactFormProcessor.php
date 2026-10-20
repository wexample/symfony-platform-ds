<?php

namespace Wexample\SymfonyPlatformDs\Service\FormProcessor;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Wexample\SymfonyForms\Service\FormProcessor\AbstractFormProcessor;
use Wexample\SymfonyHelpers\Helper\RoleHelper;
use Wexample\SymfonyMail\Service\MailSenderService;
use Wexample\SymfonyPlatformDs\Form\ContactForm;

/**
 * Mails the message to the application's contact address, the visitor's
 * own as the one to reply to. Answered by its page, which says it is sent —
 * in the modal it was opened in.
 *
 * Sent at once, through the transport: the visitor learns there and then
 * whether it left.
 */
class ContactFormProcessor extends AbstractFormProcessor
{
    private const string MAIL_TEMPLATE = '@WexampleSymfonyPlatformDsBundle/mails/contact.html.twig';

    public function __construct(
        FormFactoryInterface $formFactory,
        RequestStack $requestStack,
        UrlGeneratorInterface $urlGenerator,
        private readonly MailSenderService $mailSender,
        private readonly ?string $contactRecipient,
    ) {
        parent::__construct($formFactory, $requestStack, $urlGenerator);
    }

    public function getRequiredRoles(): array
    {
        return [RoleHelper::PUBLIC_ACCESS];
    }

    public function answersWithPage(): bool
    {
        return true;
    }

    public function onValid(FormInterface $form): void
    {
        $name = $form->get(ContactForm::FIELD_NAME)->getData();
        $email = $form->get(ContactForm::FIELD_EMAIL)->getData();

        // Its page is not found without one either; this is the same answer
        // to a submission sent there anyway.
        $recipient = $this->contactRecipient ?? throw new NotFoundHttpException();

        $this->mailSender->send(
            (new TemplatedEmail())
                ->to($recipient)
                ->replyTo(new Address($email, $name))
                ->htmlTemplate(self::MAIL_TEMPLATE)
                // `email` is the mail itself, in a template.
                ->context([
                    'sender_name' => $name,
                    'sender_email' => $email,
                    'message' => $form->get(ContactForm::FIELD_MESSAGE)->getData(),
                ])
        );
    }
}
