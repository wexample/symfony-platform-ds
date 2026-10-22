`wexample/symfony-platform-ds` holds the screens every application built on symfony-platform shows its visitors. For now, a contact form.

## The contact form

`/{_locale}/contact` (`contact_index`) asks a name, an e-mail address and a message, and mails them to the address the application configures, the visitor as `Reply-To`. The page is public; without an address it is not found.

```yaml
wexample_symfony_platform_ds:
  contact:
    recipient: '%env(default::CONTACT_RECIPIENT)%'
```

Linked with `target: modal` — `button_target(icon, label, path('contact_index'), 'modal')` —, it opens over the page being read and says it is sent in place of the form, in the modal (its processor `answersWithPage()`). The form carries symfony-forms' `ProofOfWorkInputType`, the captcha nobody solves by hand. The mail leaves at once through symfony-mail's `MailSenderService`, without Messenger, its body kept in symfony-mail's journal (`keepBody`): a transport refusing it loses nothing, the visitor is told it is sent, and the administrator reads it among the mails sent (symfony-mail-ds). Its texts are `assets/mails/contact.trans.yml`.

The application still limits how often an address may send it: a `rate_limits` rule of symfony-security on the route.

```yaml
- { name: contact, methods: [POST], routes: '/^contact_index$/', limit: 5, interval: '1 hour' }
```
