shared_examples 'services::init' do

  #
  # Services are enabled or runnning?
  #
  services = %w{
    nginx
    hhvm
    varnish
  }

  services.each do |service|
    describe service(service) do
      it { should be_enabled }
      it { should be_running }
    end
  end

  #
  # mysql service running
  # Because of service mysql status permissions denied on pid lock file and
  # 'status' doesn't return with 'running' string in the output,
  # do it this way
  #
  describe command('sudo service mysql status') do
    its(:stdout) { should match /Uptime:/ }
  end

  describe process("mysqld") do
    it { should be_running }
  end

end
