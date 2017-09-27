require 'hgv_helper'
require 'shellwords'


describe 'hgv' do
  include_examples 'hosts::init'
  include_examples 'hosts::apps'
  include_examples 'services::init'
  include_examples 'services::php56'
  include_examples 'services::php70'
  include_examples 'services::php71'
  include_examples 'wordpress::plugins'
end
