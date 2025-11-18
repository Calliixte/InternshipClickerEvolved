# Evolved version for class purposes
## New features (compared to last version (which is available [here](https://github.com/Calliixte/InternshipClicker) ))
 - Leaderboard
 - French translation
 - Quicker dark mode access
 - API (sqlite & php) to fetch possible upgrades & leaderboard entries
 - Title header
 - Contact/Credits footer
 
# Install & Run


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

### Database
You can find the database creation file in 
```bash
BD/creation.sql
```
Reset (or create) the DB with
```bash
cd BD
sqlite3 database.db < creation.sql
```

### Frontend
> Backend must be started in order for the frontend to work
#### Vue import version (Front/) (requires internet)
```bash
cd Front
python3 -m http.server 3000
```

#### Vue local version (NewFront/) (requires npm)
> requirements : npm -> can be installed from https://github.com/npm/cli

```bash
cd NewFront
npm install
npm run dev
```

> //↑↑↓↓←→←→B A Enter 