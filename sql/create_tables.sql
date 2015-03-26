CREATE TABLE Asiakas(
  tunnus varchar(50) NOT NULL UNIQUE PRIMARY KEY,
  salasana varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  osoite varchar(120) NOT NULL,
  sposti varchar(80) NOT NULL,
  puhelin varchar(20)
);

CREATE TABLE Meklari(
  tunnus varchar(50) NOT NULL UNIQUE PRIMARY KEY,
  salasana varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  sposti varchar(80) NOT NULL,
  puhelin varchar(20) NOT NULL,
  admin boolean NOT NULL   
);

CREATE TABLE Tuote(
  id SERIAL PRIMARY KEY,
  nimi varchar(80) NOT NULL,
  kuvaus varchar(500),
  lisaysaika timestamp NOT NULL,
  kaupanAlku timestamp NOT NULL,
  kaupanLoppu timestamp NOT NULL,
  minimihinta decimal,
  meklari varchar(50) REFERENCES Meklari(tunnus)
);

CREATE TABLE Tarjous(
  id SERIAL PRIMARY KEY,
  maara decimal NOT NULL,
  aika timestamp NOT NULL,
  tuote integer NOT NULL REFERENCES Tuote(id),
  asiakas varchar(50) NOT NULL REFERENCES Asiakas(tunnus)
);

CREATE TABLE Kategoria(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  kuvaus varchar(300)    
);

CREATE TABLE Tuotekategoria(
  id SERIAL PRIMARY KEY,
  kategoria integer REFERENCES Kategoria(id),
  tuote integer REFERENCES Tuote(id) 
);


