Required permissions must be enabled.


First run the mrtgconf file in assignment1 folder and then run the backend.sh of assignment2 folder and then compare the results.

Webserver should have read and write permissions to the et2536-reth15 folder and to the assignment2 folder.

In the folder /etc/apache2/ open the file apache2.conf. Add the following lines

							<Location /server-status>
									SetHandler server-status
									Order deny,allow
									Deny from none
									Allow from all
							</Location>	

The above enables listening from any device on the server. if only a particualar device should be allowed then enter that device' ip address in 'Allow from <IP address>'

The http server must be restarted after making the changes to enable them

						sudo service apache2 restart

The following packages must be installed

sudo apt-get install libdbi-perl
sudo apt-get install libpango1.0-dev 
sudo apt-get install  libxml2-dev
sudo apt-get install libsnmp-perl 
sudo apt-get install libsnmp-dev 
sudo apt-get install libnet-snmp-perl
sudo apt-get install rrdtool
sudo apt-get install rrdtool-dbg
sudo apt-get install php5-rrd
sudo apt-get install liblwp-useragent-determined-perl
perl -MCPAN -e 'install Net::SNMP'
perl -MCPAN -e 'install Net::SNMP::Interfaces'
perl -MCPAN -e 'install RRD::Simple'	


Instructions:

Run the backend.sh file in the terminal

Open the assignment2 folder from the browser you will find to add devices and servers. 

By adding, you can see the interfaces and then you can select the required interface.

you can also select the required interfaces to plot the graphs in 'Select Devices/servers to plot' and then you can compare by suing plot button. 

wait for atleast 5 minutes for values to get updated.

you can also add the duration of the graph to be plotted while comparing.

Note :

Wrong detials might return errors and cause the programme to fail. 
