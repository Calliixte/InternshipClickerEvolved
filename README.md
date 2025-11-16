# Evolved version for class purposes
## New features (compared to last version (which is available [here](https://github.com/Calliixte/InternshipClicker) ))
 - Leaderboard
 - French translation
 - Quicker dark mode access
 - API (sqlite & php) to fetch possible upgrades & leaderboard entries
 - Title header
 - Contact/Credits footer
 
# Install & Run

> requirements : Internet 

```bash
apt install php
apt install sqlite3
apt install php-sqlite3
```

### Backend
```bash
cd API
php -S localhost:8000
```

### Frontend
```bash
cd Front
python3 -m http.server 3000
```

> //↑↑↓↓←→←→B A Enter 