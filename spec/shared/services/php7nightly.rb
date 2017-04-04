shared_examples 'services::php7nightly' do

    describe package('php7-nightly') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => include("160131")) }
    end

    describe command('/usr/local/php7/bin/php --version') do
        its(:exit_status) { should eq 0 }
        its(:stdout) { should match /PHP 7.0.4-dev/ }
    end

end
