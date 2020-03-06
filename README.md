# milo-s3-browser
Heavily influenced by duplaja's aws-s3-bucket-browser plugin: https://github.com/duplaja/aws-s3-bucket-browser/tree/master/bucket-browser-for-aws-s3

## Functionality
This plugin allows for the browsing and downloading of files hosted on AWS' S3 Buckets. For the integration into the website as-is, this is primarily accomplished through functional implementation of WordPress and AWS PHP, though a separate ```MILO_Support``` class is included as well for a few specific operations.

## The ```MILO_Support``` Class
The ```MILO_Support``` class creates an object that uses data on the WordPress side to facilitate specific duties:
 - Getting bucket information
 - Getting file (object) information
 - Getting the post password necessary to view the web-side content.

### ```MILO_Support::get_buckets()```
This function returns an object that contains information on all hosted buckets under the client account.

### ```MILO_Support::get_file( $filename, $bucket )```
So long as you know the file's name and bucket name, this function facilitates getting an object with all of that file's relevant information.

### ```MILO_Support::get_password()```
This function returns the post password assigned to each page that obscures the content.
