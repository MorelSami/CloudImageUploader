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

# install root certificate for `localhost`` domain in a specific directory
mkcert -key-file ~/certs/localhost-key.pem -cert-file ~/certs/localhost-cert.pem localhost