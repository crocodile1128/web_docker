CREATE TABLE news (id integer, title VARCHAR2(1024), content VARCHAR2(3096));
CREATE TABLE flags (id integer, content VARCHAR2(255));

INSERT ALL
    INTO news (id, title, content) VALUES (1,'Character Set Migration','This chapter discusses character set conversion and character set migration. This chapter includes the following topics:')
    INTO news (id, title, content) VALUES (2,'Cards of Bootstrap provide a flexible and extensible content container with multiple variants and options','A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options.')
SELECT 1 FROM DUAL;

INSERT ALL
    INTO flags (id, content) VALUES (1,'Oops, not here')
    INTO flags (id, content) VALUES (2,'CTF{0r4cl3_61mm3_r4cl3}')
SELECT 1 FROM DUAL;
