# Kartio - The Loyalty Cards Master

- This app provides a simple way for business to issue loayalty cards for their customers.
- It was created as a university project for web appliactions course.

![alt text](image.png)

**Kartio** is a web application designed to help business owners manage their brands and loyalty programs efficiently. It allows business owners to create brands and issue loyalty cards to customers. The application provides an intuitive interface for both business owners and their customers.

![alt text](image-1.png)

# Architecture

## MVC

- Structure of the app is Model-View-Controller
- The app uses Twig as the templating engine `symfony/twig`.

## Design

- Styling is done using Tailwind CSS with preprocessor integrated with Symfony.
- Components are from Daiy UI which is added as a Tailwind plugin. It has to be installed using NPM like this `npm i -D daisyui@latest`

## Database

- Since the author wanted to try MongoDB it was chosen as the main DB.
- The reason is also economical as NoSQL DBs are cheaper to run in the cloud.
- The required composer packages are `mongodb/mongodb` and `doctrine/mongodb-odm-bundle`.
- Instead of ORM it uses ODM but with the same principles as Doctrine ORM.

# Development

- Secrets are only stored in `.env.local`.

## Installation

To install the Kartio application, follow these steps:

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/your-repo/kartio.git
   cd kartio
   ```

2. **Install Dependencies**:

   ```bash
   composer install
   npm install
   ```

3. **Set Up Environment Variables**:

   ```bash
   cp .env.example .env
   # Edit the .env file to add your database and OAuth credentials
   ```

4. **Run Migrations**:

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

5. **Start the Development Server**:
   ```bash
   symfony server:start
   ```

## Configuration

### Security Configuration

The security configuration involves setting up user providers, firewalls, and access control rules. The `security.yaml` file is configured to handle user authentication.

```yaml
security:
  password_hashers:
    Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: "auto"

  providers:
    mongo_provider:
      mongodb:
        class: App\Document\User
        property: email

  firewalls:
    dev:
      pattern: ^/(_(profiler|wdt)|css|images|js)/
      security: false
    main:
      lazy: true
      provider: mongo_provider
      entry_point: form_login
      form_login:
        login_path: app_login
        check_path: app_login
      logout:
        path: app_logout
        target: app_login

  access_control:
    - { path: ^/brands, roles: ROLE_ADMIN }
    - { path: ^/customer, roles: ROLE_USER }

when@test:
  security:
    password_hashers:
      Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface:
        algorithm: auto
        cost: 4 # Lowest possible value for bcrypt
        time_cost: 3 # Lowest possible value for argon
        memory_cost: 10 # Lowest possible value for argon
```
