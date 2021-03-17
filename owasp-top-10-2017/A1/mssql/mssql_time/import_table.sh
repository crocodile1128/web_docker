#! /bin/sh

# wait for the SQL Server to come up
sleep 20s

/opt/mssql-tools/bin/sqlcmd -S localhost -U sa -P 'yourStrong(!)Password' -d master -i ./mssql_time.sql
