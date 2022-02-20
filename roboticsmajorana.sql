USE freetimeadvice;

CREATE TABLE IF NOT EXISTS project(
    idProject INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    PRIMARY KEY (idProject)
);

CREATE TABLE IF NOT EXISTS chapter(
    idChapter INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    idProject INT NOT NULL,
    PRIMARY KEY (idChapter),
    FOREIGN KEY (idProject)
        REFERENCES project(idProject) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS writer(
    idWriter INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    surname VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
	PRIMARY KEY (idWriter)
);

CREATE TABLE IF NOT EXISTS paragraph(
    idParagraph INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    idChapter INT NOT NULL,
    idWriter INT NOT NULL,
    PRIMARY KEY (idParagraph),
    FOREIGN KEY (idChapter) 
        REFERENCES chapter(idChapter) ON DELETE CASCADE,
    FOREIGN KEY (idWriter)
        REFERENCES writer(idWriter) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS picture(
    idPicture INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    alt VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    path VARCHAR(255) NOT NULL,
    PRIMARY KEY (idPicture)
);

CREATE TABLE IF NOT EXISTS file(
    idFile INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    path VARCHAR(255) NOT NULL,
    PRIMARY KEY (idFile)
);

CREATE TABLE IF NOT EXISTS section(
    idSection INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    text LONGTEXT NOT NULL,
    idParagraph INT NOT NULL,
    idPicture INT NOT NULL,
    PRIMARY KEY (idSection),
    FOREIGN KEY (idParagraph)
        REFERENCES paragraph(idParagraph) ON DELETE CASCADE,
    FOREIGN KEY (idPicture)
        REFERENCES picture(idPicture) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS sectionFile(
    idSF INT NOT NULL AUTO_INCREMENT,
    idSection INT NOT NULL,
    idFile INT NOT NULL,
    PRIMARY KEY (idSF),
    FOREIGN KEY (idSection)
        REFERENCES section(idSection) ON DELETE CASCADE,
    FOREIGN KEY (idFile)
        REFERENCES file(idFile) ON DELETE CASCADE
);