shared_examples 'services::php71' do

    describe package('php7.1-common') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-cli') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-curl') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-dev') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-fpm') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-gd') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-json') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-opcache') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("sury")) }
    end

    describe package('php7.1-mysql') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("7.1")) }
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
