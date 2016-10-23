-- Lisää INSERT INTO lauseet tähän tiedostoon
-- NoteOwner testidata
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('NoteMaster', 'Paavo Paavolainen', 'Muistiinpanojen harrastaja nr 1', 'password1');
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('Muistiinpanija', 'Aatu Askare', 'Satunnainen käyttäjä', 'salasana');
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('tester', 'Testaaja', 'Rikkoo kaiken', 'testingonetwo');
-- Note testidata
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('3', 'Auton katsastus', 'Auto pitää muistaa viedä katsastettavaksi!', '2016-11-14 23:59:59', FALSE, '2016-05-03 15:54:12');
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('2', 'Konsertti Tavastialla', 'Duuniporukan kanssa marraskuussa katsomaan Popedaa Tavastialle. Muista ostaa liput!', '2016-11-05 17:00:00', TRUE, '2016-08-12 17:17:17');
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('1', 'Vessan lavuaari', 'Lavuaari vetää huonosti. Osta Kodin putkimiestä.', NULL, FALSE, '2015-04-02 21:00:00');
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('3', 'Tsoha palautus', 'Koitas nyt sälli saada se työ valmiiksi, ei jouda odottamaan.', '2016-10-21 23:59:59', FALSE, '2016-10-24');
-- Label testidata
INSERT INTO Label (nimi, prioriteetti) VALUES ('Työ', 'Tärkeä');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Byrokratia', 'Kriittinen!');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Tapahtumat', 'Normaali');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Koti', 'Tärkeä');
