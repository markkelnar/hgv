shared_examples 'services::php56' do

    describe package('php5.6-common') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-cli') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-curl') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-dev') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-fpm') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-gd') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-json') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-opcache') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php5.6-mysql') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.6")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php-memcached') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("3.0")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php-xdebug') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("2")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

end
