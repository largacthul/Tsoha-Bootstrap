-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE NoteOwner (
  id SERIAL PRIMARY KEY,
  tunnus varchar(30) NOT NULL,
  nimi varchar(30) NOT NULL,
  kuvaus varchar(120),
  salasana varchar(30) NOT NULL,
  admin boolean DEFAULT FALSE
);

CREATE TYPE prio_type AS ENUM (
  'Kriittinen!',
  'Tärkeä',
  'Normaali',
  'Ei tärkeä'
);

CREATE TABLE Note (
  id SERIAL PRIMARY KEY,
  noteowner_id INTEGER REFERENCES NoteOwner(id),
  otsikko varchar(50) NOT NULL,
  kuvaus varchar(200),
  deadline timestamp,
  prioriteetti prio_type DEFAULT 'Normaali',
  valmis boolean DEFAULT FALSE,
  lisays_paiva timestamp DEFAULT now()
);

CREATE TABLE NoteViewer (
  noteowner_id INTEGER REFERENCES NoteOwner(id),
  note_id INTEGER REFERENCES Note(id)
);



CREATE TABLE Label (
  id SERIAL PRIMARY KEY,
  nimi varchar(30) NOT NULL
);

CREATE TABLE NoteLabel (
  note_id INTEGER REFERENCES Note(id),
  label_id INTEGER REFERENCES Label(id),
  UNIQUE (note_id, label_id)
);
