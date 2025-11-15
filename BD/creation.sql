DROP TABLE IF EXISTS upgrade;
DROP TABLE IF EXISTS leaderboard;
DROP TABLE IF EXISTS user;


CREATE TABLE upgrade
(
    id_upgrade INT PRIMARY KEY,
    title VARCHAR(50),
    subtitle VARCHAR(500),
    effect_description VARCHAR(100), -- considerer ajouter des colonnes en français pour le texte
    called_method VARCHAR(50),
    cost INT,
    baseCost INT,
    amountBought INT
);

CREATE TABLE user
(
    id_user INT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE leaderboard
(
    id_lb INT PRIMARY KEY,
    id_user INT,
    score INT,
    FOREIGN KEY(id_user) REFERENCES user(id_user)
);

INSERT INTO upgrade (id_upgrade, title, subtitle, effect_description, called_method, cost, baseCost, amountBought) VALUES
(0, 'Send a job application', 'Who knows you may end up getting something', '+1 click power', 'upgradeClickPower', 10, 10, 0),

(1, 'Filter your job search', 'Maybe applying to every possible job isnt the most efficient way of doing things', '+10 click power', 'upgradeTenClickPower', -1, 20, 0),

(2, 'Apply in person', 'At least you wont recieve an automated email this time', 'x2 click power', 'timesTwoClickPower', -1, 100, 0),

(3, 'Add something to your portfolio', 'It''s looking pretty bad right now, have you ever done something in your life ?', '+5 passive Cv', 'passiveUpTest', -1, 50, 0),

(4, 'Add an info to your linkedin', 'Only HR managers care, good thing they are the only ones using this thing', '+1 passive Cv', 'passiveUpTest', -1, 10, 0),

(5, 'Add a work experience to your resume', 'You have only been applying since you were here, do you really want to do this ?', '+20 passive Cv', 'passiveUpTest', -1, 500, 0),

(6, 'Bake cookies', 'wait you need to get rejected by companies to have cookies ? This game designer is weird', 'Does nothing, you can still actually go bake cookies', 'initUpgrade', -1, 1, 0);


INSERT INTO user VALUES
(0,'Bronze'),
(1,'Silver'),
(2,'Gold');

INSERT INTO leaderboard VALUES
(0,0,500),
(1,1,5000),
(2,2,10000);