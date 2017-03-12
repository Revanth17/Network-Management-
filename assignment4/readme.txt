first check the database which you have connected through db.conf file which is in et2536-reth15 file.
Next run the backend file which is written in perl script

Required permissions must be enabled.

webserver should have read and write permissions to the directory et2536-reth15 and to assignment4 folder.


The following components must be installed.

sudo apt-get install libdbi-perl
sudo apt-get install libpango1.0-dev 
sudo apt-get install  libxml2-dev
sudo apt-get install libsnmp-perl 
sudo apt-get install libsnmp-dev 
sudo apt-get install libnet-snmp-perl
perl -MCPAN -e 'install Net::SNMP'
	

Instructions

Run the backend in the terminal

the script is written to update for every 30 seconds. wait for 30 seconds for the values to get updated.

open the assignment4 folder from your browsr.

list of devices whicha are moniterd is displayed.

click on the ip address of the device to see further details.

device status is colour coded with red. Shades of red represting missed request based on nnumber of missed requests. Complete red colour will be displayed if there is 30 missed requests are represented.
