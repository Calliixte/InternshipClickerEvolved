# Evolved version for class purposes
## New features (compared to last version (which is available [here](https://github.com/Calliixte/InternshipClicker) ))
 - Leaderboard
 - French translation
 - Quicker dark mode access
 - API (sqlite & php) to fetch possible upgrades & leaderboard entries
 - Title header
 - Contact/Credits footer

# English
## Install & Run


### Backend
#### Install
> php sqlite3 and php-sqlite3 are required
```bash
apt install php
apt install sqlite3
apt install php-sqlite3
```
#### Run
```bash
cd API
php -S localhost:8000 &
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
cd InternshipClickerFront
npm install
npm run dev
```

> //↑↑↓↓←→←→B A Enter 

# Français

## Installation & Execution


### Backend
#### Installation
> php, sqlite3 et php-sqlite3 sont nécéssaires
```bash
apt install php
apt install sqlite3
apt install php-sqlite3
```
#### Execution
```bash
cd API
php -S localhost:8000 &
```

### Base de données
Vous pouvez trouver le fichier SQL contenant les requêtes nécéssaires pour la création de la base dans :
```bash
BD/creation.sql
```
Reinitialisez (ou creez) la base de données avec :
```bash
cd BD
sqlite3 database.db < creation.sql
```
> Etape normalement non nécéssaire, le dépot git/rendu zip contenant déja la BD créée

### Frontend
> Le backend doit être démarré pour que le frontend fonctionne

> Dans le code du frontend se situe une variable prenant l'url de l'api qui est à localhost:8000 car c'est ce qui est indiqué sur ce README, si vous lancez le back à une autre url, il faudra changer cette constante dans le front que vous utilisez.
#### Version avec l'import Vue (Front/) (nécéssite internet)
```bash
cd Front
python3 -m http.server 3000
```

#### Version avec Vue en local (NewFront/) (requires npm)
> requirements : npm -> can be installed from https://github.com/npm/cli

```bash
cd NewFront
npm install
cd InternshipClickerFront
npm install
npm run dev
```

> //↑↑↓↓←→←→B A Entrée 