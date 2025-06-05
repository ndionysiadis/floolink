![FlooLink](http://floo.link/images/floolink.jpg)

# 🌐 FlooLink — Your Links in Disguise

🚀 **FlooLink** is a secure URL encryption tool that **teleports your links** through the magic of encryption. Using **AES-256**, it transforms URLs into protected links, ensuring privacy, security, and expiration-based sharing.

---

[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-42b883?logo=vue.js)](https://vuejs.org/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-ff2d20?logo=laravel)](https://laravel.com)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-2.x-654ff0?logo=inertia)](https://inertiajs.com/)
[![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-4.x-38b2ac?logo=tailwind-css)](https://tailwindcss.com/)
[![Maintained](https://img.shields.io/maintenance/yes/2025?logo=github)](https://github.com/ndionysiadis/floolink)
[![License](https://img.shields.io/github/license/ndionysiadis/floolink?logo=open-source-initiative)](LICENSE)
[![GitHub Repo stars](https://img.shields.io/github/stars/ndionysiadis/floolink?style=social&logo=github)](https://github.com/ndionysiadis/floolink)

## ✨ Features

- 🔒 **AES-256 Encryption** – Securely encrypts links before sharing.
- ⏳ **Expiration Settings** – Set expiration based on:
    - ⏺ Default (expires after first click)
    - ❌ Never expire
    - ⏱ Custom time (minutes, hours, days)
- 🎭 **Masked Links** – Hide the original URL.
- 📈 **Rate Limiting** – Limits link generation to 30 attempts per IP.
- 🗑 **Auto-Delete Expired Links** – Privacy-focused link sharing.
- 🧹 **Scheduled Cleanup** – Hourly command removes expired links automatically.
- 🏗 **Built with VILT Stack** – Vue.js, Inertia.js, Laravel, Tailwind CSS.
- 🧙 **Inspired by Magic** – Themed after the **Floo Network** from Harry Potter.

---

## 🛠 Tech Stack

| ⚙️ Technology        | 📝 Description                                    |
|----------------------|----------------------------------------------|
| 🟢 **Vue.js**        | Reactive UI with Composition API           |
| 🟣 **Inertia.js**    | Smooth Laravel + Vue integration           |
| 🔴 **Laravel**       | Backend framework handling API & encryption |
| 🔵 **Tailwind CSS**  | Modern styling with utility classes       |
| 🟡 **VueUse & Headless UI** | Enhanced Vue utilities & accessible UI components |
| 🔷 **Phosphor Icons** | Beautiful, lightweight icons |

---

## 📦 Installation

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/yourusername/floolink.git
cd floolink
```

### 2️⃣ Install Dependencies
```sh
composer install
npm install
```

### 3️⃣ Configure Environment
Create a `.env` file (copy `.env.example` if present) and update your database and mail settings.

Generate the application key:
```sh
php artisan key:generate
```

### 4️⃣ Set Up the Database
```sh
php artisan migrate
```

### 5️⃣ Run the Application
For backend:
```sh
php artisan serve
```
For frontend (Vite):
```sh
npm run dev
```
### 6. Test the Application
Run the test suite with:
```sh
composer test
```

---

## ⚡ Usage

1. 🔗 **Paste** a URL in the input field.
2. ⏳ **Select Expiration** – Default, Never, or Custom.
3. ✨ Click **"Make Magic"** to generate an encrypted FlooLink.
4. 📩 **Copy & Share** your encrypted URL safely.

---

## 📜 License

This project is **MIT Licensed**. Feel free to use and modify.

---

Created with ❤️ by **[Nicolas Dionysiadis](https://github.com/ndionysiadis)**.

