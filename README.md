#AirwatchRESTWebServicesClientLib

a library composed of ...
... a set of classes to access VMWare Airwatch REST webservices
this project is of essence for other projects I am working on which are (but not limited to) :  

* AirwatchCommandLine
* AirwatchReports
* AirwatchAutomation

This being said below is how the class is "Design" for now :  

- Airwatch 
	 - AirwatchServicesSearch 
		- AirwatchMDM....Search  
		- AirwatchMAM....Search  
		- AirwatchSystem....Search  
     
Airwatch : this one is the head doing REST Calls 
AirwatchServicesSearch : Almost all the Retrieve/GetDetail/Search have this in common, it implements the Search method.
Airwatch[MDM|MAM|System] : are final classes you can call to invoke AW Webservices easily.

There is an Excel file `20180201_ImplementedMethods.xlsx` in Documentations folder showing all the method that are implemented so far.

