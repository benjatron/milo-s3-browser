# milo-s3-browser
Influenced by duplaja's aws-s3-bucket-browser plugin: https://github.com/duplaja/aws-s3-bucket-browser/tree/master/bucket-browser-for-aws-s3

## Functionality
This plugin allows for the browsing and downloading of files hosted on AWS' S3 Buckets. For the integration into the website as-is, this is primarily accomplished through functional implementation of WordPress and AWS PHP, though a separate ```MILO_Support``` class is included as well for a few specific operations.

## The ```MILO_Support``` Class
The ```MILO_Support``` class creates an object that uses data on the WordPress side to facilitate specific duties:
 - Getting bucket information
 - Listing bucket objects
 - Getting file (object) information
 - Getting the post password necessary to view the web-side content.

### ```MILO_Support::get_buckets()```
This method returns an object that contains information on all hosted buckets under the client account.

### ```MILO_Support::get_objects( $bucket )```
This method lists all of the objects in a given bucket

### ```MILO_Support::get_file( $filename, $bucket )```
So long as you know the file's name and bucket name, this function facilitates getting an object with all of that file's relevant information.

### ```MILO_Support::get_password()```
This method returns the post password assigned to each page that obscures the content.

## Landing Pages
There are template files included that allow a query to be affected on an instance of the ```MILO_Support``` class. These are referenced in the front-end example below.

---

## Front-End Example
We can get an idea of how to use the ```MILO_Support``` class by how it is implemented on the front-end. For our purposes, we will assume the relevant templates are set at ```domain.com/app/functions/get_xxx```. Utilizing each of the methods we can find the values required for each of the other pages.

### ```domain.com/app/functions/get_password```
Unlike the other methods, getting the post password doesn't really help outside of navigating a site using the plugin. To see this password, simply navigate to ```domain.com/app/functions/get_password```. The only text that displays should be the relevant post password.

### ```domain.com/app/functions/get_buckets```
The ```get_buckets``` method is the last one we have that does not require any query variables. Navigating to ```domain.com/app/functions/get_buckets``` will show us an array with all of the buckets we can use.

### ```domain.com/app/functions/get_objects```
If we navigate to ```domain.com/app/functions/get_objects``` without properly-formed query, you'll note the following message is returned: "You must use a valid bucket name". If we update the URL with a "bucket" variable provided by the previous section, we instead get an array with all of the object keys for the AWS bucket. The format for this URL is ```domain.com/app/functions/get_buckets/?bucket=xxx```.

### ```domain.com/app/functions/get_file```
Similarly to the ```get_objects``` example, if we navigate to ```domain.com/app/functions/get_file``` without the proper query variables set we get an error. However, if we provide a ```bucket=xxx``` variable statement things still don't work. We'll need not only a valid bucket name, retrieved via ```get_buckets```, but also a valid path, retrieved through ```get_objects```. With both of these together in the form of ```domain.com/app/functions/get_file/?bucket=xxx&path=yyy``` we see that the returned value is a string. This string can be placed in your navigation bar to immediately download the file identified by the ```path``` and ```bucket``` variables.
