-- Lisää INSERT INTO lauseet tähän tiedostoon
-- NoteOwner testidata
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('NoteMaster', 'Paavo Paavolainen', 'Muistiinpanojen harrastaja nr 1', 'password1');
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana) VALUES ('Muistiinpanija', 'Aatu Askare', 'Satunnainen käyttäjä', 'salasana');
-- Note testidata
INSERT INTO Note (otsikko, kuvaus) VALUES ('Auton katsastus', 'Auto pitää muistaa viedä katsastettavaksi!');
INSERT INTO Note (otsikko, kuvaus) VALUES ('Konsertti Tavastialla', 'Duuniporukan kanssa marraskuussa katsomaan Popedaa Tavastialle. Muista ostaa liput!');
INSERT INTO Note (otsikko, kuvaus) VALUES ('Vessan lavuaari', 'Lavuaari vetää huonosti. Osta Kodin putkimiestä.');
-- Label testidata
INSERT INTO Label (nimi) VALUES ('Työ');
INSERT INTO Label (nimi) VALUES ('Byrokratia');
INSERT INTO Label (nimi) VALUES ('Tapahtumat');
INSERT INTO Label (nimi) VALUES ('Koti');
-- Priority testidata
INSERT INTO Priority (prioriteetti) VALUES ('Kriittinen!');
INSERT INTO Priority (prioriteetti) VALUES ('Tärkeä');
