#MRTG#

Run the mrtconf file to install mrtg 
check mrtgconf, it runs with sudo
check readme.txt in et2536-reth15 folder. first install all the required packages to run the backend files.

The tool reads credentials from table `DEVICES` table and displays the bitrate for selected device and interface. 

Required permissions must be enabled. 

webserver should have read and write permissions to the et2536-reth15 directory and to the assignment1 folder.

Following components must be installed to run the assignment.

sudo apt-get update
sudo apt-get install apache2
sudo apt-get install snmp
sudo apt-get install snmpd
sudo apt-get install libdbi-perl
sudo apt-get install libpango1.0-dev 
sudo apt-get install  libxml2-dev
sudo apt-get install libsnmp-perl 
sudo apt-get install libsnmp-dev 
sudo apt-get install libnet-snmp-perl
sudo apt-get install rrdtool
sudo apt-get install rrdtool-dbg
sudo apt-get install php5-rrd
sudo apt-get install php5-snmp
sudo perl -MCPAN -e 'install Net::SNMP'
sudo perl -MCPAN -e 'install Net::SNMP::Interfaces'
sudo perl -MCPAN -e 'install RRD::Simple'


Instructions:

Run the mrtgconf file. Run with in sudo.

wait for 15 minutes to for values get updated.

open the assignment1 folder from the browser.

list of available interfaces for the devices are displayed.

click on the graphs to view the hourly,weekly and monthly graphs and to know the further information of the interface and devices.

Note :

Wrong detials might return errors and cause the programme to fail. 

If a device is removed from the database, it is not shown in the table but the graphs can be viewed by entering the right credentials.  

	

