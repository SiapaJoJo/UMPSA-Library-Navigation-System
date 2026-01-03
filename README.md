# UMPSA Library Navigation System

A modern Laravel-based library navigation system for Universiti Malaysia Pahang Al-Sultan Abdullah (UMPSA) that integrates an AI Chatbot for assistance, immersive 360° panoramic views using Pano2VR, and interactive mapping powered by Mappedin to help students and visitors navigate the library efficiently.

## 🚀 Features

### Core Functionality
- **AI-Powered Chatbot**: Interactive chatbot using ChatGPT API to assist users with library navigation and information
- **360° Virtual Tours**: Immersive panoramic views of library spaces using Pano2VR
- **Interactive Library Map**: Dynamic mapping system powered by Mappedin for easy navigation
- **Floor Directory**: Comprehensive directory of facilities available on each floor
- **Image Gallery**: Visual gallery showcasing library spaces and facilities
- **Contact System**: Integrated contact form for user inquiries

### Modern UI/UX
- **Glassmorphism Design**: Modern glassmorphic UI elements with backdrop blur effects
- **Dark Theme Support**: Full dark mode support for both admin panel and guest views
- **Responsive Design**: Fully responsive layout for all device sizes
- **Animated Backgrounds**: Dynamic gradient backgrounds and floating orbs
- **Smooth Animations**: Enhanced hover effects and transitions throughout

### Admin Panel
- **Modern Dashboard**: Comprehensive admin dashboard with real-time statistics, activity timeline, engagement insights, smart alerts, progress rings, and content growth charts
- **Content Management**: Full CRUD operations for panoramas, maps, floors, and galleries
- **Contact Management**: View and manage user contact messages with status tracking
- **Profile Management**: User profile editing and password management
- **Theme Toggle**: Switch between light and dark themes with persistent preferences

### Guest Features
- **Modern Dashboard**: Animated hero section with library overview
- **Interactive Floor Directory**: Image carousel with swipe and keyboard navigation
- **Virtual Tour Gallery**: Browse and experience 360° panoramas
- **Library Map Navigation**: Interactive maps with floor selection
- **Image Gallery**: Category-filtered gallery with detailed views
- **Contact Form**: Validated contact form with modern styling
- **AI Chatbot**: Integrated chatbot for real-time assistance

## 🛠️ Tech Stack

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **AI Integration**: ChatGPT API
- **Panoramic Views**: Pano2VR
- **Mapping**: Mappedin
- **Charts**: Chart.js
- **Database**: MySQL/PostgreSQL

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Web server (Apache/Nginx)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/SiapaJoJo/UMPSA-Library-Navigation-System.git
   cd UMPSA-Library-Navigation-System
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   - Update `.env` file with your database credentials
   - Add ChatGPT API key to `.env`:
     ```
     OPENAI_API_KEY=your_api_key_here
     ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

9. **Start the server**
   ```bash
   php artisan serve
   ```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/    # Application controllers
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── public/
│   ├── images/              # Uploaded images
│   └── panos/              # Panorama files
├── resources/
│   ├── views/
│   │   ├── admin/          # Admin panel views
│   │   ├── guest/          # Guest/public views
│   │   └── layouts/        # Layout templates
│   └── js/                 # JavaScript files
└── routes/
    └── web.php             # Web routes
```

## 🎨 Key Features

### Guest Features
- Modern dashboard with animated backgrounds
- Interactive floor directory with image carousel
- Virtual tour gallery with fullscreen support
- Library map navigation with floor selection
- Image gallery with category filtering
- Contact form with validation
- AI chatbot integration with dark theme support
- Theme toggle (light/dark mode)

### Admin Features
- Modern glassmorphism design throughout
- Dark theme support with persistent preferences
- Real-time dashboard with database-driven statistics
- Content management for all resources
- Contact message management with status tracking
- User profile management
- File upload and management
- Dynamic logo switching based on theme

## 🔗 Links

- **GitHub**: [https://github.com/SiapaJoJo](https://github.com/SiapaJoJo)
- **Reddit**: [https://www.reddit.com/user/Immediate_Wing2236/](https://www.reddit.com/user/Immediate_Wing2236/)
- **LinkedIn**: [https://www.linkedin.com/in/muhammad-tajul-afiq-bin-tajul-aris-696517240](https://www.linkedin.com/in/muhammad-tajul-afiq-bin-tajul-aris-696517240)

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👤 Author

**Muhammad Tajul Afiq Bin Tajul Aris**

- GitHub: [@SiapaJoJo](https://github.com/SiapaJoJo)
- LinkedIn: [Muhammad Tajul Afiq Bin Tajul Aris](https://www.linkedin.com/in/muhammad-tajul-afiq-bin-tajul-aris-696517240)

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Alpine.js
- Pano2VR
- Mappedin
- OpenAI (ChatGPT API)
- Chart.js
