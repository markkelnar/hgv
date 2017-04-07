shared_examples 'hosts::init' do

  #
  # Hosts are resolvable? or reachable?
  #
  hosts = %w{
    hhvm.hgv.test
    php.hgv.test
    cache.hhvm.hgv.test
    cache.php.hgv.test
    admin.hgv.test
    xhprof.hgv.test
    mail.hgv.test
  }

  hosts.each do |host|
    describe host(host) do
      it { should be_resolvable }
      it { should be_reachable.with( :port => 80, :proto => 'tcp' ) }
    end
  end

end
