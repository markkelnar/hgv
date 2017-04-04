shared_examples 'services::php70' do

    describe package('php-common') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.0-common') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.0")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end
    describe package('php7.0-mysql') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.0")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end

end
