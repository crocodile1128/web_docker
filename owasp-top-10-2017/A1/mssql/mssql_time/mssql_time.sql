CREATE DATABASE mssql_time;
GO
USE mssql_time;
GO
CREATE TABLE News (ID int, Title nvarchar(max), Content nvarchar(max));
GO
CREATE TABLE Flags (ID int, Content nvarchar(max));
GO
INSERT INTO News VALUES (1,'Hack me if you can','Hack me if you can :)'), (2,'PHP PDO : Charset=UTF8 : An invalid keyword charset was specified in the dsn string','You need to apply the attribute after connecting!');
GO
INSERT INTO Flags VALUES (1,'Oops, not here'),(2,'CTF{a}');
GO
