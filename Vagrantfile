# -*- mode: ruby -*-
# vi: set ft=ruby :

$script = <<SCRIPT

echo -e "\n--- Atualizando pacotes ---\n"
sudo apt-get -qq update

#Variáveis para o MySQL - Apenas para máquina de desenvolvimento
#Altere para os dados que achar relevante
DBHOST=localhost
DBNAME=investing
DBNAME_TEST=test
DBUSER=investing
DBPASSWD=investing

echo -e "\n--- Instalando e configurando MySQL ---\n"
debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASSWD"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASSWD"
sudo apt-get -y install mysql-server

mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'%' identified by '$DBPASSWD'"
mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME_TEST"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME_TEST.* to '$DBUSER'@'%' identified by '$DBPASSWD'"


systemctl enable mysql

sed -i "s/bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
sudo service mysql restart

echo -e "\n--- Instalando Apache 2 ---\n"
sudo apt-get install -y apache2
sudo a2enmod rewrite

echo -e "\n--- Definindo diretório da aplicação Laravel ---\n"
rm -rf /var/www/html
ln -s /vagrant /var/www/html
echo "cd /vagrant" >> /home/vagrant/.bashrc

sudo sed -i '/^/d' /etc/apache2/sites-available/000-default.conf
sudo echo '<VirtualHost *:80>' >> /etc/apache2/sites-available/000-default.conf
sudo echo '    DocumentRoot /var/www/html/public' >> /etc/apache2/sites-available/000-default.conf
sudo echo '    <Directory "/var/www/html/public">' >> /etc/apache2/sites-available/000-default.conf
sudo echo '        AllowOverride all' >> /etc/apache2/sites-available/000-default.conf
sudo echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf
sudo echo '    ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/sites-available/000-default.conf
sudo echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined' >> /etc/apache2/sites-available/000-default.conf
sudo echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

echo -e "\n--- Instalando o PHP 7.2 ---\n"
sudo apt-get -y install python-software-properties
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -qq update
sudo apt-get install -y php7.2 libapache2-mod-php7.2 php7.2-cli php7.2-common php7.2-mbstring php7.2-gd php7.2-intl php7.2-xml php7.2-mysql php7.2-zip php-xdebug php7.2-fpm

echo -e "\n--- Configurando PHP.ini ---\n"
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.2/apache2/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.2/apache2/php.ini
echo 'xdebug.remote_enable = 1' | sudo tee --append /etc/php/7.2/mods-available/xdebug.ini
echo 'xdebug.remote_autostart = 1' | sudo tee --append /etc/php/7.2/mods-available/xdebug.ini
echo 'xdebug.remote_port=9000' | sudo tee --append /etc/php/7.2/mods-available/xdebug.ini
echo 'xdebug.remote_connect_back=true' | sudo tee --append /etc/php/7.2/mods-available/xdebug.ini
netstat -rn | grep "^0.0.0.0 " | cut -d " " -f10 | awk -v x="xdebug.remote_host=" '{print x $1}' | sudo tee --append /etc/php/7.2/mods-available/xdebug.ini
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