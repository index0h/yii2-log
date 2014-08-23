VAGRANTFILE_API_VERSION = "2"

dir = File.dirname(File.expand_path(__FILE__))

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.hostname = "yii2-log-pro"

  config.vm.network "private_network", ip: "192.168.100.117"

  config.vm.synced_folder "./", "/home/vagrant/work"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision "shell", path: "provision/init.sh"
end
