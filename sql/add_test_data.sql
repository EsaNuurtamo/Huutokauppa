INSERT INTO Asiakas (tunnus, salasana, nimi, osoite, sposti) VALUES ('Olli', 'Olli123', 'Olli Olio', 'Komppikatu 3 A 1', 'olli@hotmail.com');
INSERT INTO Asiakas (tunnus, salasana, nimi, osoite, sposti) VALUES ('Antti', 'Antti123', 'Antti Annonen', 'Kimppakatu 3 A 1', 'antti@hotmail.com');
INSERT INTO Asiakas (tunnus, salasana, nimi, osoite, sposti) VALUES ('Kimmo', 'Kimmo123', 'Kimmo Komaa', 'Keminkatu 3 A 1', 'komaa@hotmail.com');

INSERT INTO Meklari (tunnus, salasana, nimi, sposti, puhelin) VALUES ('Kalle', 'Kalle123', 'Kalle Kolho', 'kalle@yahoo.com', '0503336537');
INSERT INTO Meklari (tunnus, salasana, nimi, sposti, puhelin) VALUES ('Topi', 'Topi123', 'Topi Tolonen', 'tolonen@yahoo.com', '0501111111');

INSERT INTO Tuote (nimi, kuvaus, lisaysaika, kaupanAlku, kaupanLoppu, minimihinta, meklari) VALUES ('Uuni', 'Hyväkuntoinen uuni.', NOW(), '2015-6-6 08:00', '2015-6-8 08:00', 56.5, 'Kalle');
INSERT INTO Tuote (nimi, kuvaus, lisaysaika, kaupanAlku, kaupanLoppu, minimihinta, meklari) VALUES ('Kaappi', 'Antiikkinen kaappi.', '2015-6-6 08:00', '2015-6-6 08:00', '2015-6-8 08:00', 100.5, 'Kalle');

INSERT INTO Tarjous (maara, aika, tuote, asiakas) VALUES (100.4, '2015-1-1 07:00', 1, 'Olli');
INSERT INTO Tarjous (maara, aika, tuote, asiakas) VALUES (105.4, '2015-1-1 09:00', 1, 'Antti');
INSERT INTO Tarjous (maara, aika, tuote, asiakas) VALUES (60.4, '2015-1-1 09:00', 2, 'Kimmo');
INSERT INTO Tarjous (maara, aika, tuote, asiakas) VALUES (68.8, '2015-1-1 12:00', 2, 'Olli');

INSERT INTO Kategoria (nimi, kuvaus) VALUES('Kodinkoneet', 'Erilaisia kodinkoneita.');
INSERT INTO Kategoria (nimi, kuvaus) VALUES('1800-luvun antiikki', 'Antiikkituotteita 1800-luvulta.');
INSERT INTO Kategoria (nimi, kuvaus) VALUES('Käytetyt', 'kaikki käytetyt tuottet.');

INSERT INTO Tuotekategoria (kategoria, tuote) VALUES(1,1);
INSERT INTO Tuotekategoria (kategoria, tuote) VALUES(1,3);
INSERT INTO Tuotekategoria (kategoria, tuote) VALUES(2,2);
INSERT INTO Tuotekategoria (kategoria, tuote) VALUES(2,3);
