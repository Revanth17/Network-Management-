Check the configuration of traps in etc folder. follow the readme.txt file in et2536-reth15 folder.
sudo snmptrap -v 1 -c public 127.0.0.1:50162 .1.3.6.1.4.1.41717.10 10.2.3.4 6 247 '' .1.3.6.1.4.1.41717.10.1 s "" .1.3.6.1.4.1.41717.10.2 i 1
The above command is to send trap. Before sending the trap we should add the manager details through frontend.
Then you can check the trap status.

Required permissions must be enabled.

snmp and http permissions should be enabled on the device/server you are monitoring

In the folder /etc/snmp/ open the file "snmptrapd.conf". Add the following lines

							snmpTrapdAddr udp:50162
							disableAuthorization yes
							authCommunity log,execute,net public
							
							traphandle 1.3.6.1.4.1.41717.10.* /usr/bin/perl /path/to/et2536-reth15/assignment3/trapDaemon

This will enable listening on port 50162

In the line authCommunity, "public" is the community name of the device. Replace it with the respective community, Traps sent to this community will be executed.

Open the file snmpd in /etc/default/. Edit the line

						TRAPDRUN=no to TRAPDRUN=yes

Restart the snmp server by using 

					sudo service snmpd restart

To see the incoming traps on the manger of the mangers. Go to path
				/usr/local/share/snmp/

If the folder snmp does not exist in /usr/local/share, create a folder 
				sudo mkdir snmp			
	
Create a file snmptrapd.conf
Add the lines

					disableAuthorization yes
					snmpTrapdAddr udp:50162 #(The port number at which it listens)
					logOption f /var/log/trap.log

The following components must be installed.

sudo apt-get install libdbi-perl
sudo apt-get install libpango1.0-dev 
sudo apt-get install  libxml2-dev
sudo apt-get install libsnmp-perl 
sudo apt-get install libsnmp-dev 
sudo apt-get install libnet-snmp-perl
sudo apt-get install php5-rrd
perl -MCPAN -e 'install Net::SNMP'



Instructions:

Open the assignment3 folder from the browser.

Then add the manager details.

refresh the page to see the manager details.

next send the trap by using the command 

sudo snmptrap -v 1 -c public 127.0.0.1:50162 .1.3.6.1.4.1.41717.10 10.2.3.4 6 247 '' .1.3.6.1.4.1.41717.10.1 s "" .1.3.6.1.4.1.41717.10.2 i 1

Note :

Wrong detials might return errors and cause the programme to fail. 


