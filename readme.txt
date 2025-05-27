===========
README.txt
===========

Progetto Laravel: Band Finder

-------------------------
REQUISITI
-------------------------
- PHP >= 8.1
- Composer
- Node.js + npm
- MySQL o simile
- Laravel CLI
- Laravel Breeze (auth)

-------------------------
INSTALLAZIONE
-------------------------
1. Clona repo + entra nella cartella
2. composer install
3. npm install
4. cp .env.example .env
5. Configura DB e credenziali Spotify nel .env
6. php artisan key:generate
7. php artisan migrate
8. php artisan db:seed (opzionale)
9. npm run dev
10. php artisan serve

Apri: http://127.0.0.1:8000

-------------------------
PACCHETTI FRONTEND USATI
-------------------------
- tailwindcss@3.4.17
- bootstrap@5.3.6
- alpinejs@3.14.9
- axios@1.9.0
- vite@6.3.5
- postcss, autoprefixer
- laravel-vite-plugin
- @tailwindcss/forms / vite

-------------------------
API DISPONIBILI
-------------------------
GET /api/instruments  
→ lista strumenti

GET /api/bands/requests/{instrument}  
→ band che cercano quello strumento

-------------------------
ALTRE NOTE
-------------------------
Per dipendenze:
- PHP: composer show
- JS: npm list --depth=0

Autore: [David Fiorilli]  
Email: [davidfiorilli06@gmail.com]