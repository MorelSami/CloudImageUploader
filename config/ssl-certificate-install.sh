#Basically helps you create a trusted SSL certificate locally using the `mkcert` tool

# install libnss3-tools
sudo apt install libnss3-tools

# install go
sudo apt-get install golang-go -y

# download mkcert
mkdir mkcert
cd mkcert
git clone https://github.com/FiloSottile/mkcert .

# build mkcert
go build -ldflags "-X main.Version=$(git describe --tags)"

# link mkcert to /usr/bin
sudo ln -s $PWD/mkcert /usr/bin/mkcert

# install mkcert root certificate
mkcert -install

# Generate a trusted SSL certificate for the listed domains
# You can add or update the existing domain names to any of your choice 
# but those domain names are to be added to /etc/hosts config file
mkcert localhost rukbe-front.local rukbe-api.local 127.0.0.1

# copy SSL certificates w/ key to the `config` and `cert` folder in the project repository
cp ~/localhost* config/     #back-end repo
cp ~/localhost* rukbe/cert/ #front-end repo