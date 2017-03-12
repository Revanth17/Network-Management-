Introduction:


1. Each of the lab assignments are organized in individual folders and are independent of each other.
2. Please follow the readme file here and in the assignment folders for exact working of the solution.
3. It may be required to enable read and write permission to the rrd folders in assignment 1 and 2


Enter the Credentials of db.conf:

1. In the db.conf file enter the credentials between the double quotes. 
   
$hostname="localhost";   #name of the host 
$port="3306";            #port being used by the mysql database
$database="lab";         #Name of the database where all tables are being created.
$username="root";        #Username of the database
$password="ubuntu";           #Password of the database

	After entering the credentails save the file.


Instructions for Installation of required softwares:

Before installing any software, please do update and upgrade  
		
		sudo apt-get update  
                sudo apt-get upgrade 

1. Installing Apache web server:

		sudo apt-get install apache2 

2.Installing PHP Softwares:

		
		1) sudo apt-get install php5 libapache2-mod-php5
		2) sudo apt-get install php5-cli php5-dev
		3) sudo apt-get install mysql-server
		4) sudo apt-get install php5-mysql
		5) sudo apt-get install php5-snmp
		6) sudo apt-get install sqlite php5-sqlite

After installation of the required softwares, restart the apache server using the command 

		sudo service apache2 restart

3.Installing MySQL Server

		sudo apt-get install mysql-server

During the installation process, the user will be prompted to enter the password for the MySQL root user.

Once the installation is complete, restart MySQL using the following command 

		sudo service mysql restart 


Additional packages installation:

Install the package php5-mysql using the command 
		
		sudo apt-get install php5-mysql



4.Installing RRD Tool
		
		sudo apt-get install rrdtool 
		sudo apt-get install php5-rrd

5.Installing SNMP and related packages
	
		sudo apt-get install snmp snmpd

6.Installing PERL modules

		sudo cpan 

This command opens the cpan shell through which a few installations have to be made.

In the shell, enter 
		
		upgrade
 
   After upgrading exit the shell.
Install the Perl DBI module 
	 	
		sudo perl -MCPAN -e "install DBI"

Install the Perl RRDs module 

	 	sudo apt-get install librrds-perl 

Installing packages required for SNMP and Perl
 sudo apt-get install libnet-snmp-perl libperl-dev libsnmp-dev

Install the Perl RRD::Editor module 
	 	
		sudo perl -MCPAN -e "install RRD::Editor"

Install the Perl Net::SNMP module 
	 	
		sudo perl -MCPAN -e "install Net::SNMP"

Install the Perl LWP::Simple module 
	 	
		sudo perl -MCPAN -e "install LWP::Simple"


Net-SNMP
********
To install net-snmp follow the instructions: 
open the terminal and type the following commands
1)wget http://sourceforge.net/projects/net-snmp/files/net-snmp/5.4.4/net-snmp-5.4.4.tar.gz
2)tar -xvzf net-snmp-5.4.4.tar.gz
3)sudo apt-get install libperl-dev
4)cd net-snmp-5.4.4
5)./configure
6) make
7)sudo make install
8)> echo export LD_LIBRARY_PATH=/usr/local/lib >> .bashrc
9)cd perl
10)perl Makefile.PL 
11)make
12)sudo make install

