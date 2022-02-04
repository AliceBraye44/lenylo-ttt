## Checkpoint 4 - Leny Lo ttt

## Présentation

Ce projet est un site de réservations de tatouage. Il propose un espace administarteur pour gérer les flashs, les categories et gérer les demandes de réservations effectuées.

### Installer le projet

1. Cloner le projet
2. Run `composer install`
3. Run `yarn install`
4. Run `yarn encore dev`
5. Run `symfony server:start`
6. Run `yarn watch`

### Tester le projet

1. Configurer son .env.local
2. Run `php /bin console doctrine:database:create`
2. Run `php /bin console doctrine:make:migration`
2. Run `php /bin console doctrine:fixtures:load`
3. Go `localhost:8000/login`
4. Identifiant admin  braye.alice@gmail.com . Pour se connecter rendez-vous sur /login .


## Built With

- [Symfony](https://github.com/symfony/symfony)
- [Sass-Lint](https://github.com/sasstools/sass-lint)
- [VichUploader](https://github.com/dustin10/VichUploaderBundle)
- [Materializecss](https://materializecss.com/)
