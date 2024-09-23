# Project Title

CSV_TO_DB

## Description

The purpose of this project is to upload csv file to oracle dababase.
The following steps are maintiaed on this automated system:
1. Download the csv file from a FTP server
2. Create the control file for sql loader
3. Truncate previous data form the table
4. Run the sql loader progmatically to upload the csv data to the database
5. Delete the control file

## Getting Started

### Dependencies

* league/flysystem-ftp: ^3.0
* league/flysystem-sftp-v3: ^3.0
* yajra/laravel-oci8: ^10.4

### Installing

* Prepare the .env file with additional env varialbe with corresponding information
  ORACLE_DB_HOST=
  ORACLE_DB_PORT=
  ORACLE_DB_DATABASE=
  ORACLE_DB_USERNAME=
  ORACLE_DB_PASSWORD=
  ORACLE_DB_SERVICE_NAME=
* composer install
Now the projectg is ready to run.


## License

This project is licensed under the [NAME HERE] License - see the LICENSE.md file for details

