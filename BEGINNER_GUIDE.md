# E-Tech E-Commerce Website - Beginner Guide

## 📁 Project Structure

```
wt_project/
├── wt/                          # Main website folder
│   ├── index.php               # Homepage (main landing page)
│   ├── styles/                 # CSS files for styling
│   │   ├── styles.css         # Main styles
│   │   ├── cart.css           # Shopping cart styles
│   │   └── auth.css           # Login/register page styles
│   ├── scripts/               # JavaScript files
│   │   └── script.js          # Main interactive features
│   ├── pics/                  # Product images and logos
│   ├── pages/                 # Other website pages
│   │   ├── about.php          # About us page
│   │   ├── products.php       # All products page
│   │   ├── contact.php        # Contact page
│   │   ├── login.php          # User login
│   │   └── register.php       # User registration
│   └── parts/                 # Reusable page components
│       ├── navbar.php         # Navigation bar
│       └── footer.php         # Footer section
```

## 🚀 Technologies Used

### Languages:
- **PHP** - Server-side programming for dynamic content
- **HTML5** - Website structure and content
- **CSS3** - Styling and layout
- **JavaScript** - Interactive features (shopping cart)

### Libraries:
- **Boxicons** - Beautiful icons for UI elements
- **Google Fonts** - Poppins font for modern typography

## 📝 How It Works

### 1. Homepage (index.php)
- **Header**: Navigation menu with logo, links, search bar, cart, and user menu
- **Hero Section**: Welcome banner with call-to-action
- **Products**: Featured products with prices and "Add to Cart" buttons
- **Footer**: Company info, links, and contact details

### 2. PHP Features
```php
<?php
session_start();  // Tracks user login status across pages
?>
```
- Sessions keep users logged in while browsing
- Conditional display based on login status

### 3. User Experience
- **Guest Users**: Can browse products, see "Log in" option
- **Logged-in Users**: See their username, access profile/orders
- **Shopping Cart**: Add items, view total, checkout

## 🎨 Styling Approach

### CSS Classes Explained:
- `.container` - Centers content with max width
- `.navbar` - Top navigation styling
- `.product-card` - Individual product layout
- `.btn` - Button styling for consistent look
- `.cart-sidebar` - Side panel for shopping cart

### Icons:
- `bx bx-cart` - Shopping cart icon
- `bx bx-user` - User/profile icon
- `bx bx-search` - Search icon
- `bxs-star` - Filled star for ratings

## 🔧 Key Features

1. **Responsive Design** - Works on desktop and mobile
2. **Shopping Cart** - Add/remove items with JavaScript
3. **User Authentication** - Login/logout functionality
4. **Product Display** - Clean product cards with images and prices
5. **Navigation** - Easy menu system between pages

## 📚 Learning Points

### For Beginners:
1. **HTML Structure** - See how pages are organized with semantic elements
2. **CSS Styling** - Learn modern layouts and responsive design
3. **PHP Basics** - Understand sessions, includes, and conditional logic
4. **JavaScript** - Interactive features like shopping cart
5. **File Organization** - How to structure a web project

### Code Comments:
- Look for `<!-- SECTION NAME -->` for major page sections
- PHP code has explanatory comments
- CSS classes are named descriptively

## 🎯 Next Steps for Learning

1. **Study index.php** - Main page structure
2. **Explore styles.css** - CSS layouts and styling
3. **Check script.js** - JavaScript cart functionality
4. **Understand PHP sessions** - User login system
5. **Practice modifications** - Try changing colors, adding products

## 🛠️ How to Run

1. Use a local PHP server (XAMPP, WAMP, or built-in PHP server)
2. Place files in web server directory
3. Access through browser: `http://localhost/wt_project/wt/`

This project is perfect for learning modern web development with clean, commented code!
