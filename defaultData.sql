use roboticsmajorana;

INSERT INTO role (name) VALUES ('Administrator'), ('Writer');
INSERT INTO user (name, surname, username, email, password, approvated, role, referent) VALUES ('Mario', 'Rossi', 'marione', 'mariorossi@mail.it', 'asd', 1, 1, 1);
INSERT INTO status (name, color) VALUES ('Public', '#0F0'), ('Private', '#F00');