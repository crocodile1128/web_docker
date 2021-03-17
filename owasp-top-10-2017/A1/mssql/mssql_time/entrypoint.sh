#! /bin/sh

/opt/mssql/bin/sqlservr & /import_table.sh & /bin/sh -c "while true; do echo hello world; sleep 1; done"
