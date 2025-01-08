# Image Uploader Application (Cloud)

<pre>
   An image uploader application that allows a user to upload any image from their pc/laptop to the server.
   User will also have the ability to view the uploaded image from the server.
   <strong>Note: Advisable to only run this project in a local environment  </strong>
</pre>

<img src="./rukbe_uploader.png" alt="Rukbe Image Uploader"/>

### Install requirements w/ <a href='https://github.com/FiloSottile/mkcert#installing-the-ca-on-other-systems' target='blank'>`mkcert`</a> __(A locally-trusted development certificate generator tool)__

1. Ensure you have **git** & **docker** installed in your system.
2. Clone project repo <b>https://github.com/MorelSami/CloudImageUploader.git</b> to your workspace.
3. In `config/ssl-certificate-install.sh` file, update `{path/to/cloned-project-repository}` with `actual path of the project repository`. __**(Please first check the file to have a brief understanding of what it does)**__
4. Run the command `sh config/ssl-certificate-install.sh`. __**(Please skip this step if you decide not to install a local CA using `mkcert`)**__

### Execution

5. If you skipped `step 4` above, then proceed with the following steps below, else skip to `step 6`: (*These steps should allow you to run the application using an unsecured protocol(HTTP)*)
  - Comment out `line 13-14` in the root directory `Dockerfile` file for the backend server.
  - Run the command `sh run-http.sh` from the root directory.
6. Run the command `sh run-https.sh` from the root directory. __**(Only proceed with this step if you skipped `step 5` above)**__

Enjoy!!
