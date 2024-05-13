# Rukbe Coding Challenge

<pre>
   An image uploader application that allows a user to upload any image from their pc/laptop to the server.
   User will also have the ability to view the previously uploaded images from the server.
   <strong>Note: Advisable to only run this project in a local environment  </strong>
</pre>

<img src="./rukbe_uploader.png" alt="Rukbe Image Uploader"/>

### Install requirements w/ <a href='https://github.com/FiloSottile/mkcert#installing-the-ca-on-other-systems' target='blank'>`mkcert`</a> __(A locally-trusted development certificate generator tool)__

>Warning: The _cert-key.pem & _cert.pem files in the __cert__ folder are just tmp files to keep the application running if you decide not to proceed with the *mkcert root CA installation* in your local. In this case, the https sites will not be recognized by any browser but will still function if acknowledged by you.

- git clone <b>https://github.com/MorelSami/RukbeChallenge.git</b>
- Inside the project repository run `sh config/ssl-certificate-install.sh`. *(Please first check the file to have a brief understanding of what it does)*
- Create an environment variable file `.env` in both the root directory and `rukbe` directory (front-end) using `.env.sample` as reference (__using the same content should be fine__).
- Run `composer install` in the root directory.
- Run `npm install` in the `rukbe` (front-end) directory.
- In the root directory open `run.sh` and update `{path/to/cloned-project-repository}` with `actual path of the project repository`. 

### Execution

- sh run.sh 

Enjoy!!
