shared_examples 'services::php55' do

    describe package('php5-cli') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.5")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end

    describe package('php5-common') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.5")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end

    describe package('php5-curl') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.5")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end

    describe package('php5-dev') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.5")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end

    describe package('php5-memcached') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("2.1")) }
        its(:version) { is_expected.to have_attributes(:version => include("build1")) }
    end

    describe package('php5-mysql') do
        it { should be_installed }
        its(:version) { is_expected.to have_attributes(:version => a_string_starting_with("5.5")) }
        its(:version) { is_expected.to have_attributes(:version => include("ubuntu")) }
    end

end
