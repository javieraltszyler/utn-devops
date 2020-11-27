Vagrant.configure("2") do |config|  
  config.vm.define :web do |web|
    web.vm.provider :virtualbox do |vb|
      vb.name = "web"
      vb.memory = 1024
      vb.cpus = 1
    end
    web.vm.box = "ubuntu/bionic64"
    web.disksize.size = "10GB"
    web.vm.hostname = "web"
    web.vm.network :private_network, ip: "10.0.0.14"
    web.vm.network "forwarded_port", guest: 8080, host: 8080
    #web.vm.provision :docker
    web.vm.provision :shell, privileged: true, inline: $bootstrap
    #web.vm.provision :docker_compose, yml: "/vagrant/docker-compose.yml", rebuild: true, run: "always"
    end
end
$bootstrap = <<-SCRIPT
#INSTALL DOCKER AND DOCKER compose
sudo apt install -y apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"
sudo apt update -y
sudo apt install -y docker-ce 
sudo systemctl start docker
sudo chkconfig enable docker
sudo curl -L "https://github.com/docker/compose/releases/download/1.24.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
#COPY FILES AND RUN DOCKER-COMPOSE
cp /vagrant/Dockerfile .
docker build . -t php-apache-mysql
cp /vagrant/index.php .
cp /vagrant/docker-compose.yml .
sudo docker-compose up
SCRIPT