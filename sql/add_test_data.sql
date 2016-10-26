-- Lisää INSERT INTO lauseet tähän tiedostoon
-- NoteOwner testidata
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana, admin) VALUES ('NoteMaster', 'Paavo Paavolainen', 'Muistiinpanojen harrastaja nr 1', 'password1', FALSE);
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana, admin) VALUES ('Muistiinpanija', 'Aatu Askare', 'Satunnainen käyttäjä', 'salasana', FALSE);
INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana, admin) VALUES ('tester', 'Testaaja', 'Rikkoo kaiken', 'testingonetwo', TRUE);
-- Note testidata
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, prioriteetti, valmis, lisays_paiva) VALUES ('3', 'Auton katsastus', 'Auto pitää muistaa viedä katsastettavaksi!', '2016-11-14 23:59:59', 'Tärkeä', FALSE, '2016-05-03 15:54:12');
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, prioriteetti, valmis, lisays_paiva) VALUES ('2', 'Konsertti Tavastialla', 'Duuniporukan kanssa marraskuussa katsomaan Popedaa Tavastialle. Muista ostaa liput!', '2016-11-05 17:00:00', 'Normaali', TRUE, '2016-08-12 17:17:17');
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, prioriteetti, valmis, lisays_paiva) VALUES ('1', 'Vessan lavuaari', 'Lavuaari vetää huonosti. Osta Kodin putkimiestä.', NULL, 'Normaali', FALSE, '2015-04-02 21:00:00');
INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, prioriteetti, valmis, lisays_paiva) VALUES ('3', 'Tsoha palautus', 'Koitas nyt sälli saada se työ valmiiksi, ei jouda odottamaan.', '2016-10-21 23:59:59', 'Kriittinen!', FALSE, '2016-10-24');
-- Label testidata
INSERT INTO Label (nimi) VALUES ('Työ');
INSERT INTO Label (nimi) VALUES ('Byrokratia');
INSERT INTO Label (nimi) VALUES ('Tapahtumat');
INSERT INTO Label (nimi) VALUES ('Koti');
INSERT INTO Label (nimi) VALUES ('Koulu');
--- NoteLabel testidata
INSERT INTO NoteLabel (note_id, label_id) VALUES (1, 2);
INSERT INTO NoteLabel (note_id, label_id) VALUES (1, 4);
INSERT INTO NoteLabel (note_id, label_id) VALUES (2, 1);
INSERT INTO NoteLabel (note_id, label_id) VALUES (2, 3);
INSERT INTO NoteLabel (note_id, label_id) VALUES (3, 4);
INSERT INTO NoteLabel (note_id, label_id) VALUES (4, 5);
