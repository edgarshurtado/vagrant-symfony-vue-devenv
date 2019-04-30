
# -*- mode: ruby -*-
# vi: set ft=ruby :

# configuration version 2
Vagrant.configure("2") do |config|
  # boxes at https://atlas.hashicorp.com/search.
  # config.vm.box = "dev.box"
  config.vm.box = "bento/ubuntu-18.04"
  config.vm.hostname = "vagrant-symfony-vue-devenv-host"

  config.vm.box_check_update = false

  config.ssh.forward_agent = true

  config.vm.network :private_network, ip: "10.10.10.61"

  config.vm.network "forwarded_port", guest: 80, host: 80
  config.vm.network "forwarded_port", guest: 8080, host: 8080
  config.vm.network "forwarded_port", guest: 5000, host: 5000
  config.vm.network "forwarded_port", guest: 3306, host: 3306

  config.vm.synced_folder "./", "/home/vagrant/vagrant-symfony-vue-devenv"

  config.vm.provider "virtualbox" do |vb|
     vb.name = "vagrant-symfony-vue-devenv_dev_ubu_1804"
     vb.customize ["modifyvm", :id, "--nictype1", "virtio"]
     vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
     vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
     vb.customize ["modifyvm", :id, "--ioapic", "on"]
     vb.customize ["modifyvm", :id, "--vram", "128"]
     vb.customize ['modifyvm', :id, '--clipboard', 'bidirectional']
     # Customize the amount of memory on the VM:
     vb.memory = "4096"
  end

  config.vm.provision "shell", path: "./bootstrap.sh" 
  config.vm.provision "shell", path: "./bootstrap_vagrant.sh", privileged: false

end
