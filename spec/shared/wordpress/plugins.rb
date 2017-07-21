shared_examples 'wordpress::plugins' do

  #
  # WordPress plugins
  #
  wp_paths = %w{
    /hgv_data/sites/hhvm
  }

  wp_plugins = %w{
    akismet
    debug-bar
    debug-objects
    debug-queries
    hello
    query-monitor
    user-switching
    rewrite-rules-inspector
    log-deprecated-notices
  }

  wp_paths.each do |path|
    wp_plugins.each do |plugin|
      describe command("wp --path=#{Shellwords.shellescape(path)} plugin status #{Shellwords.shellescape(plugin)}") do
        let(:disable_sudo) { true }
        its(:exit_status) { should eq 0 }
      end
    end
  end

end
