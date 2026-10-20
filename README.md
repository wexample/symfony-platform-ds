# symfony-platform-ds

Version: 2.0.0

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

## Table of Contents

- [The contact form](#the-contact-form)
- [Integration in the Suite](#integration-in-the-suite)
- [Dependencies](#dependencies)
- [Versioning & Compatibility Policy](#versioning--compatibility-policy)
- [License](#license)
- [About us](#about-us)
- [Migration Notes](#migration-notes)

## Integration in the Suite

This package is part of the Wexample Suite — a collection of high-quality, modular tools designed to work seamlessly together across multiple languages and environments.

### Related Packages

The suite includes packages for configuration management, file handling, prompts, and more. Each package can be used independently or as part of the integrated suite.

## Dependencies

- php: >=8.5
- symfony/validator: ^7.4 || ^8.0
- wexample/symfony-design-system: >=38.0.0
- wexample/symfony-forms: >=14.0.0
- wexample/symfony-helpers: >=17.0.0
- wexample/symfony-loader: >=23.3.0
- wexample/symfony-mail: >=3.0.0
- wexample/symfony-security: >=4.0.0

## Versioning & Compatibility Policy

Wexample packages follow **Semantic Versioning** (SemVer):

- **MAJOR**: Breaking changes
- **MINOR**: New features, backward compatible
- **PATCH**: Bug fixes, backward compatible

We maintain backward compatibility within major versions and provide clear migration guides for breaking changes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Free to use in both personal and commercial projects.

## About us

[Wexample](https://wexample.com) stands as a cornerstone of the digital ecosystem — a collective of seasoned engineers, researchers, and creators driven by a relentless pursuit of technological excellence. More than a media platform, it has grown into a vibrant community where innovation meets craftsmanship, and where every line of code reflects a commitment to clarity, durability, and shared intelligence.

This packages suite embodies this spirit. Trusted by professionals and enthusiasts alike, it delivers a consistent, high-quality foundation for modern development — open, elegant, and battle-tested. Its reputation is built on years of collaboration, refinement, and rigorous attention to detail, making it a natural choice for those who demand both robustness and beauty in their tools.

Wexample cultivates a culture of mastery. Each package, each contribution carries the mark of a community that values precision, ethics, and innovation — a community proud to shape the future of digital craftsmanship.

Built and maintained by [Romain Weeger](https://weeger.io).

## Migration Notes

When upgrading between major versions, refer to the migration guides in the documentation.

Breaking changes are clearly documented with upgrade paths and examples.
