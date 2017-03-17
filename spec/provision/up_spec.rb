require 'spec_helper'
require 'serverspec'

describe package('ansible') do
  it { should be_installed }
end
