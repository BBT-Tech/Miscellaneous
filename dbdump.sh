#!/bin/sh
if [ $# == 0 ]
then
    echo 'dbdump - dump a database as sql file via `mysqldump` command'
    echo ''
    echo 'Usage: dbdump name'
    echo ''
    echo '    You will find the dumped file in `dbdumps/$name` directory'
    echo '    For example: `dbdump autumn_recruit_2018` => `dbdumps/autumn_recruit_2018/20181108115213.sql`'
    echo ''
    exit
fi

directory="dbdumps/$1"
mkdir -p "$directory"

# echo "$directory/$(date '+%Y%m%d%H%M%S').sql"
mysqldump -udumper -pyourpwd --add-drop-database --single-transaction --databases "$1" > "$directory/$(date '+%Y%m%d%H%M%S').sql"



# DB user create and permission grant:
# CREATE USER 'dumper'@'localhost' IDENTIFIED BY 'yourpwd';
# GRANT SELECT, LOCK TABLES ON *.* TO 'dumper'@'localhost';

# Note: the `LOCK TABLES` permission may still need if `--single-transaction`
# option for transactional tables like InnoDB does not work,
# for example, a MyISAM engine database
