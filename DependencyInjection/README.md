## Dependency Injection example
This directory contains couple of file which demonstrate how to use **Dependency Injection** in **static API** design. <br />
First of all, designing API, we don't wan't to use it's instance and be changeable via constructor.<br />
Instead, it has some public methods that allows the Application/Module/Plugin to interact with outer world, without using other classes.<br />
All the dependency mechanism is basically inside **ApplicationAPI::getUser()** which loads specific **User** implementation, <br />
depending on choosed namespace (which can be changed via **ApplicationAPI::changeNamespace()** method).<br />
All the **User** functionality is described by **User** interface.<br />
List of files + description:<br />
 * [ApplicationAPI.php](ApplicationAPI.php) - API through which application communicates with the outer world.
 * [User.php](User.php) - Interface which describes every User implementation
 * [version1/UserClass.php](version1/UserClass.php) - first implementation of the User interface
 * [version2/UserClass.php](version2/UserClass.php) - second implementation of the User interface
 * [example.php](example.php) - boostrap file which containts autoloader + working example of how it works
