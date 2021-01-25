CREATE TABLE Računi
(
ID INTEGER PRIMARY KEY, 
Kupac TEXT FOREIGN KEY REFERENCES Kupac('Ime i prezime') NOT NULL, 
Proizvod VARCHAR FOREIGN KEY REFERENCES Proizvod('Ime proizvoda') NOT NULL,
'Jedinična cijena' INTEGER FOREIGN KEY REFERENCES Proizvod('Jedinična cijena') NOT NULL,
Količina INTEGER NOT NULL,
Datum DATETIME NOT NULL, 
Zaposlenik TEXT FOREIGN KEY REFERENCES Zaposlenik('Ime i prezime') NOT NULL
)









