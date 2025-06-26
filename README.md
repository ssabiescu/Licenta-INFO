# SmileTrack – Aplicație web pentru clinici stomatologice

**SmileTrack** este o aplicație web full-stack, dezvoltată ca proiect de licență, destinată gestionării activității unei clinici stomatologice. Aceasta permite gestionarea programărilor, recenziilor, și a utilizatorilor (pacienți, medici și administratori), oferind o interfață modernă și intuitivă.

## Adresa repository-ului

[Github : SmileTrack](https://github.com/ssabiescu/Licenta-INFO)

## 👨‍🔧 Tehnologii utilizate

- Frontend: HTML, CSS, Bootstrap
- Backend: PHP (procedural)
- Bază de date: MySQL (prin phpMyAdmin)
- Server local: WAMP (Windows, Apache, MySQL, PHP)
- API-uri externe: Mailgun (email), FullCalendar (calendar programări), Google Maps Embed API (localizare clinică)

## 🔧 Cum rulezi proiectul local

### 1. Instalează WAMP
Descarcă și instalează [WAMP](https://www.wampserver.com/en/) pentru a rula serverul local (Apache + MySQL).

### 2. Clonează repository-ul
```bash
git clone https://github.com/ssabiescu/Licenta-INFO.git
```

### 3. Mută proiectul în directorul WAMP
Copiază folderul `SmileTrack` în:
```
C:\wamp64\www\
```

### 4. Importează baza de date
1. Deschide `http://localhost/phpmyadmin` în browser.
2. Creează o bază de date nouă numită `smiletrack`.
3. Importă fișierul `smiletrack.sql` din proiect (`/SmileTrack/smiletrack.sql`).

### 5. Configurare fișier conexiune DB
Verifică fișierul `config/db.php` și asigură-te că ai următoarele valori:
```php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'smiletrack';
```

### 6. Pornește serverul
1. Lansează WAMP.
2. Asigură-te că serviciile Apache și MySQL sunt pe verde.
3. Accesează aplicația la:
```
http://localhost/SmileTrack/
```

## 🔮 Funcționalități cheie

- Înregistrare și autentificare utilizatori
- Programări online, cu notificări prin email
- Calendar interactiv pentru medici
- Recenzii și rating pentru medici
- Panou de administrare cu gestiunea utilizatorilor
- Design responsive și modern cu Bootstrap

## 📦 Structura proiectului

```
SmileTrack/
├── api/                     # Endpoint-uri backend/API
├── assets/                 
│   ├── css/                # Stiluri personalizate
│   ├── images/             # Imagini
│   └── js/                 # Scripturi JS
├── auth/                   # Login, register, logout
├── config/                 # Conexiune baza de date
├── dashboard/              
│   ├── admin/              # Interfață admin
│   ├── medic/              # Interfață medic
│   └── pacient/            # Interfață pacient
├── includes/               # Headere, footere, navbar
├── pages/                  # Pagini statice și publice
├── .env.php                # Setări sensibile (ex: API keys)
├── .gitignore              # Fișiere excluse din Git
├── .htaccess               # Reguli Apache
├── 404.php                 # Pagină de eroare
└── index.php               # Pagina principală
```

