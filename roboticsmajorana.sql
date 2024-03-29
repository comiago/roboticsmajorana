USE roboticsmajorana;

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
    project INT NOT NULL,
    PRIMARY KEY (idChapter),
    FOREIGN KEY (project)
        REFERENCES project(idProject) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS role(
    idRole INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20),
    description VARCHAR(255),
    PRIMARY KEY (idRole)
);

CREATE TABLE IF NOT EXISTS writer(
    idWriter INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    surname VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    role int NOT NULL,
    approvatedBy INT NOT NULL,
	PRIMARY KEY (idWriter),
    FOREIGN KEY (role)
        REFERENCES role(idRole) ON DELETE CASCADE,
    FOREIGN KEY (approvatedBy)
        REFERENCES writer(idWriter) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS paragraph(
    idParagraph INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    chapter INT NOT NULL,
    PRIMARY KEY (idParagraph),
    FOREIGN KEY (chapter) 
        REFERENCES chapter(idChapter) ON DELETE CASCADE
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
    paragraph INT NOT NULL,
    picture INT,
    createdBy INT NOT NULL,
    PRIMARY KEY (idSection),
    FOREIGN KEY (paragraph)
        REFERENCES paragraph(idParagraph) ON DELETE CASCADE,
    FOREIGN KEY (picture)
        REFERENCES picture(idPicture) ON DELETE CASCADE,
    FOREIGN KEY (createdBy)
        REFERENCES writer(idWriter) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS modifier(
    idModifier INT NOT NULL AUTO_INCREMENT,
    date DATETIME NOT NULL,
    section INT NOT NULL,
    modifier INT NOT NULL,
    PRIMARY KEY (idModifier),
    FOREIGN KEY (section)
        REFERENCES section(idSection) ON DELETE CASCADE,
    FOREIGN KEY (modifier)
        REFERENCES writer(idWriter) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS sectionFile(
    idSF INT NOT NULL AUTO_INCREMENT,
    section INT NOT NULL,
    file INT NOT NULL,
    PRIMARY KEY (idSF),
    FOREIGN KEY (section)
        REFERENCES section(idSection) ON DELETE CASCADE,
    FOREIGN KEY (file)
        REFERENCES file(idFile) ON DELETE CASCADE
);