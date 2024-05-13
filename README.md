# Rukbe Coding Challenge

<pre>
   An image uploader application that allows a user to upload any image from their pc/laptop to the server.
   User will also have the ability to view the previously uploaded images from the server.
   <strong>Note: Advisable to only run this project in a local environment  </strong>
</pre>

<img src="./rukbe_uploader.png" alt="Rukbe Image Uploader"/>

# Install requirements w/ <a href='https://github.com/FiloSottile/mkcert#installing-the-ca-on-other-systems' _target='blank'>`mkcert`</a> ( A locally-trusted development certificate generator tool)

<pre>
   - git clone https://github.com/MorelSami/RukbeChallenge.git
   - Inside the project repository run `sh config/ssl-certificate-install.sh`. (Please first check the file to have a brief understanding of what it does)
   - create an environment variable file `.env` in both the root directory and <i>rukbe</i> directory (front-end) using `.env.sample` as reference(using the same content should be fine).
   - Run `composer install` in the root directory.
   - Run `npm install` in the <i>rukbe</i> (front-end) directory.
   - In the root directory open `run.sh` and update `{path/to/cloned-project-repository}` with `{actual path}` of the project repository. 
</pre>

# Execution

<pre>
   - In the root directory, run the command > ` sh run.sh` and the application should be up and running. 
</pre>

Enjoy!!
