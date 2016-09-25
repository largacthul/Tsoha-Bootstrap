-- Lisää INSERT INTO lauseet tähän tiedostoon
-- NoteOwner testidata
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('NoteMaster', 'Paavo Paavolainen', 'Muistiinpanojen harrastaja nr 1', 'password1');
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('Muistiinpanija', 'Aatu Askare', 'Satunnainen käyttäjä', 'salasana');
-- Note testidata
INSERT INTO Note (otsikko, kuvaus, deadline, valmis) VALUES ('Auton katsastus', 'Auto pitää muistaa viedä katsastettavaksi!', '2016-11-14 23:59:59', FALSE);
INSERT INTO Note (otsikko, kuvaus, deadline, valmis) VALUES ('Konsertti Tavastialla', 'Duuniporukan kanssa marraskuussa katsomaan Popedaa Tavastialle. Muista ostaa liput!', '2016-11-05 17:00:00', TRUE);
INSERT INTO Note (otsikko, kuvaus, deadline, valmis) VALUES ('Vessan lavuaari', 'Lavuaari vetää huonosti. Osta Kodin putkimiestä.', NULL, FALSE);
-- Label testidata
INSERT INTO Label (nimi, prioriteetti) VALUES ('Työ', 'Tärkeä');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Byrokratia', 'Kriittinen!');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Tapahtumat', 'Normaali');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Koti', 'Tärkeä');
