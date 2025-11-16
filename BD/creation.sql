DROP TABLE IF EXISTS upgrade;
DROP TABLE IF EXISTS leaderboard;
DROP TABLE IF EXISTS user;


CREATE TABLE upgrade
(
    id_upgrade INT PRIMARY KEY,
    title_en VARCHAR(50),
    subtitle_en VARCHAR(500),
    effect_description_en VARCHAR(100),
    title_fr VARCHAR(50),
    subtitle_fr VARCHAR(500),
    effect_description_fr VARCHAR(100),
    called_method VARCHAR(50),
    cost INT,
    baseCost INT,
    amountBought INT
);

CREATE TABLE leaderboard
(
    id_lb INTEGER PRIMARY KEY AUTOINCREMENT,
    user_name VARCHAR(50),
    score REAL --les nombres insérés depuis javascript peuvent être très grands
);

INSERT INTO upgrade (
    id_upgrade, 
    title_en, 
    subtitle_en, 
    effect_description_en, 
    title_fr, 
    subtitle_fr, 
    effect_description_fr, 
    called_method, 
    cost, 
    baseCost, 
    amountBought
) VALUES
(0, 'Send a job application', 'Who knows you may end up getting something', '+1 click power', 'Postuler quelque part', 'Qui sait ? Vous finirez peut-être par trouver quelque chose', '+1 CV par clic', 'upgradeClickPower', 10, 10, 0),
(1, 'Filter your job search', 'Maybe applying to every possible job isnt the most efficient way of doing things', '+10 click power', 'Filtrer votre recherche', 'Postuler à toutes les annonces disponibles n''était peut-être pas la meilleure stratégie...', '+10 CV par clic', 'upgradeTenClickPower', -1, 20, 0),
(2, 'Apply in person', 'At least you wont recieve an automated email this time', 'x2 click power', 'Posulter en personne', 'Au moins vous ne recevrez pas un mail automatique cette fois', 'x2 puissance de clic', 'timesTwoClickPower', -1, 100, 0),
(3, 'Add something to your portfolio', 'It''s looking pretty bad right now, have you ever done something in your life?', '+5 passive Cv', 'Ajouter un élément à votre portfolio', 'Il n''y a pas grand choses dedans, avez vous déja fait quelque chose dans votre vie ?', '+5 CV déposés passivement', 'passiveUpTest', -1, 50, 0),
(4, 'Add an info to your linkedin', 'Only HR managers care, good thing they are the only ones using this thing', '+1 passive Cv', 'Ajouter un élément à votre profil linkedin', 'Seuls les RH en ont quelque chose à faire... ça tombe bien ils sont aussi les seuls à regarder', '+1 CV déposé passivement', 'passiveUpTest', -1, 10, 0),
(5, 'Add a work experience to your resume', 'You have only been applying since you were here, do you really want to do this?', '+20 passive Cv', 'Ajouter une expérience professionnelle à votre CV', 'Vous avez fait que postuler depuis votre arrivée ici, vous êtes sur de votre coup ?', '+20 CV déposés passivement', 'passiveUpTest', -1, 500, 0),
(6, 'Bake cookies', 'wait you need to get rejected by companies to have cookies? This game designer is weird', 'Does nothing, you can still actually go bake cookies', 'Faire des cookies', 'attends attends il faut se faire refuser des candidatures pour avoir des cookies ? Chelou le game designer', 'Ne fait rien mais vous pouvez tout de même aller faire des cookies pour de vrai', 'initUpgrade', -1, 1, 0);



INSERT INTO leaderboard VALUES
(0,'Bronze',500),
(1,'Silver',5000),
(2,'Gold',10000),
(3,'↑↑↓↓←→←→BA↵',100000000000000000000000000000000000000000000000000);