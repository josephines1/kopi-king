![KopiKing](https://github.com/josephines1/kopi-king/blob/main/public/readme/kopiking_frontpages_home.png "KopiKing")

# KopiKing
## Multi-Purpose Company Profile
This project is a company profile website developed using Laravel 11. It features an admin panel that allows easy management of pages and menus, providing an intuitive interface for administrators to update content seamlessly. This project serves as a personal milestone in my journey to learn Laravel 11, and I plan to continue enhancing its features and functionality in the future.

## Requirements

- [npm](https://nodejs.org/en)
- [Composer](https://getcomposer.org/)
- [XAMPP 8.2.4 or later](https://www.apachefriends.org/download.html) or [Laragon](https://laragon.org/download/)

## Features

- Admin Dashboard: Manage Categories, Menus, Messages, and Web Pages.
- User-Friendly Front Page: The source code includes a simple and easy-to-navigate front page with sections for Home, Menu, About, and Contact, making it accessible for all users.

## Getting Started

Here, you’ll find the essential steps to set up and navigate through the project. Follow these simple instructions to explore the features of the website and make the most of your experience.

1. Clone the Repository
   ```console
   git clone https://github.com/josephines1/kopi-king.git
   ```

2. Install Dependencies
   ```console
   composer install
   npm install
   ```

3. Copy the Environment File
   ```console
   cp .env.example .env
   ```

4. Generate the Application Key
   ```console
   php artisan key:generate
   ```

5. Create Storage Link
   ```console
   php artisan storage:link
   ```

6. Update the Filesystem Disk
   Open your `.env` file and change the `FILESYSTEM_DISK` value from `local` to `public`:
   ```
   FILESYSTEM_DISK=public
   ```

7. Run Migrations
   ```console
   php artisan migrate
   ```

8. Seed the Database
   ```console
   php artisan db:seed --class=DatabaseSeeder
   php artisan db:seed --class=FrontPagesSeeder
   ```

9. Compile Assets
   ```console
   npm run dev
   ```

10. Run the Application
   ```console
   php artisan serve
   ```

## First Usage

After running the seed commands mentioned above, you can log in to the admin panel using the following credentials:

```
Email: admin@example.com
Password: password
```

Once logged in, you can start adding the necessary media files and photos for the website.

## Screenshots

![KopiKing](https://github.com/josephines1/kopi-king/blob/main/public/readme/kopiking_frontpages_home.png "KopiKing")
![KopiKing](https://github.com/josephines1/kopi-king/blob/main/public/readme/kopiking_frontpages_edit.png "KopiKing")
![KopiKing](https://github.com/josephines1/kopi-king/blob/main/public/readme/kopiking_admin_dashboard.png "KopiKing")

## Tech

Teknologi dalam aplikasi ini:
- [Laravel 11](https://laravel.com/docs/11.x/documentation) - a PHP web application framework with expressive, elegant syntax.
- [Breeze Starter Kit](https://laravel.com/docs/11.x/starter-kits#laravel-breeze) - a minimal, simple implementation of all of Laravel's authentication features.
- [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework packed with classes.
- [daisyUI](https://daisyui.com/) - the most popular component library for Tailwind CSS

## Contribution

Contributions to improve this application are greatly appreciated. If you encounter any issues or bugs, please create a new issue in this repository.

## Credits

> Made by [Josephine](https://josephines1.github.io/).
