# -*- mode: ruby -*-
# vi: set ft=ruby :

$script = <<SCRIPT

echo -e "\n--- Atualizando pacotes ---\n"
sudo apt-get -qq update

#Variáveis para o MySQL - Apenas para máquina de desenvolvimento
#Altere para os dados que achar relevante
DBHOST=localhost
DBNAME=dbname
DBUSER=dbuser
DBPASSWD=dbpass

echo -e "\n--- Instalando e configurando MySQL ---\n"
debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASSWD"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASSWD"
sudo apt-get -y install mysql-server

mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'%' identified by '$DBPASSWD'"

systemctl enable mysql

sed -i "s/bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
sudo service mysql restart

echo -e "\n--- Instalando Apache 2 ---\n"
sudo apt-get install -y apache2

echo -e "\n--- Definindo diretório da aplicação Laravel ---\n"
rm -rf /var/www/*
ln -fs /vagrant /var/www
echo "cd /vagrant" >> /home/vagrant/.bashrc

echo -e "\n--- Instalando o PHP 7.2 ---\n"
sudo apt-get -y install python-software-properties
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -qq update
sudo apt-get install -y php7.2 libapache2-mod-php7.2 php7.2-cli php7.2-common php7.2-mbstring php7.2-gd php7.2-intl php7.2-xml php7.2-mysql php7.2-zip

echo -e "\n--- Configurando PHP.ini ---\n"
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.2/apache2/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.2/apache2/php.ini
sudo service apache2 restart

echo -e "\n--- Instalando composer ---\n"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer

echo -e "\n--- Tudo pronto, hora do show! ---\n"
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.network "forwarded_port", guest: 80, host: 8000 #apache
  config.vm.network "forwarded_port", guest: 3306, host: 3306 #mysql
  config.vm.provision "shell", inline: $script
end