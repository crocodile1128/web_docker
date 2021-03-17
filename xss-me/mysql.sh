#! /bin/bash
mysql -uroot<<EOF

create database xss;
use xss;
source /app/xss.sql;
UPDATE oc_module SET code=REPLACE(code,'http://xsser.me','http://localhost:8077')
EOF
echo "sql execution over!!!!"
