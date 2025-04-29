# E-Commerce Laravel Project

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.1-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![Status](https://img.shields.io/badge/status-Active-brightgreen)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-blueviolet)

---

## Overview
This is a modern e-commerce web application built using Laravel.  
The application includes features such as secure user authentication, dynamic product browsing with related product suggestions, cart management, a checkout process with Paymob payment integration, and an admin panel with separate authentication.

---

## Features

- User authentication (signup, login, logout) using Laravel Breeze
- Admin authentication using Laravel native auth
- Product listing with categories and related products
- Product details view
- Add products to cart
- View and manage cart
- Increase/decrease product quantities
- Remove products from the cart
- Clear the entire cart
- Search feature for quick product discovery
- Checkout process with Paymob payment integration
- Admin panel to manage products and categories
- Responsive design using Bootstrap 5

---

## Installation

To run this project locally, follow these steps:

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel 11
- Node.js and npm
- MySQL or any other supported database

### Steps

1. Clone the repository

   ```bash
   git clone https://github.com/fathy196/shop.git
   cd shop
2. Install dependencies
 
   ```bash
    composer install
    npm install && npm run dev
3. Copy the .env file   

   ```bash
     cp .env.example .env
4. Generate an application key

   ```bash
    php artisan key:generate
5. Configure the .env file

    Update your database and Paymob settings:
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    
    PAYMOB_API_KEY=your_paymob_api_key
    PAYMOB_IFRAME_ID=your_paymob_iframe_id
    PAYMOB_INTEGRATION_ID=your_paymob_integration_id
6. Run the migrations:

   ```bash
   php artisan migrate
7. (Optional) Seed the database:

   ```bash
    php artisan db:seed
8. Serve the application:
  
   ```bash
    php artisan serve

## Visit the Application
 ### Open your web browser and visit:
 
   

     http://localhost:8000
    
     User Area: /
    
     Admin Area: /dashboard/login

## Usage
### User Authentication
- Signup: Users can register for a new account.

- Login: Existing users can log in.

- Logout: Users can safely log out.

### Product Management
- View Products: Browse the available products with pagination and related product suggestions.

- Product Details: View detailed information about each product.

### Cart Management
- Add to Cart: Add products to the cart from the product listing or detail page.

- View Cart: Check the cart contents.

- Update Cart: Update product quantities or remove items.


### Checkout
- Process Order: Complete the purchase using secure Paymob payment gateway.

### Admin Panel
- Product Management: Create, update, and delete products.

- Category Management: Create, update, and delete categories.

- Admin Authentication: Admins log in with a different authentication system for secure management.

## Contributing
Contributions are welcome!
Please open an issue or submit a pull request for any improvements or bug fixes.

## License
This project is open-source and available under the MIT License.

## Contact
If you have any questions or need further assistance, feel free to contact me at:
fathyabdelkader8@gmail.com
