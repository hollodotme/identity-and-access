VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # box-config
  config.vm.box = "devops007"
  config.vm.box_url = "http://box.3wolt.de/devops007/"
  config.vm.box_check_update = true
  config.vm.box_version = "~> 1.1.0"

  # network-config
  config.vm.network "public_network", type: "dhcp"
  config.vm.boot_timeout = 600

  # SSH-config
  config.ssh.username = "root"
  config.ssh.insert_key = true

  # hostname
  config.vm.hostname = "IdentityAndAccess"

  # provisioners
  # ------------

  # nginx configs, copy and link
  config.vm.provision "file", source: "env/nginx/dist.conf", destination: "/etc/nginx/sites-available/dist"
  config.vm.provision "file", source: "env/nginx/pma.conf", destination: "/etc/nginx/sites-available/pma"
  config.vm.provision "file", source: "env/nginx/readis.conf", destination: "/etc/nginx/sites-available/readis"
  config.vm.provision "file", source: "env/vgrt/id_rsa", destination: "/root/.ssh/id_rsa"
  config.vm.provision "file", source: "env/vgrt/ssh_config", destination: "/root/.ssh/config"
  config.vm.provision "shell", path: "env/vgrt/bootstrap.sh"

end
