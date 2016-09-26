-- Lisää INSERT INTO lauseet tähän tiedostoon
-- NoteOwner testidata
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('NoteMaster', 'Paavo Paavolainen', 'Muistiinpanojen harrastaja nr 1', 'password1');
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('Muistiinpanija', 'Aatu Askare', 'Satunnainen käyttäjä', 'salasana');
-- Note testidata
INSERT INTO Note (otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('Auton katsastus', 'Auto pitää muistaa viedä katsastettavaksi!', '2016-11-14 23:59:59', FALSE, '2016-05-03 15:54:12');
INSERT INTO Note (otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('Konsertti Tavastialla', 'Duuniporukan kanssa marraskuussa katsomaan Popedaa Tavastialle. Muista ostaa liput!', '2016-11-05 17:00:00', TRUE, '2016-08-12 17:17:17');
INSERT INTO Note (otsikko, kuvaus, deadline, valmis, lisays_paiva) VALUES ('Vessan lavuaari', 'Lavuaari vetää huonosti. Osta Kodin putkimiestä.', NULL, FALSE, '2015-04-02 21:00:00');
-- Label testidata
INSERT INTO Label (nimi, prioriteetti) VALUES ('Työ', 'Tärkeä');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Byrokratia', 'Kriittinen!');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Tapahtumat', 'Normaali');
INSERT INTO Label (nimi, prioriteetti) VALUES ('Koti', 'Tärkeä');
