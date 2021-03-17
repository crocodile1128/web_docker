class UsersController < ApplicationController

  def index
    pclass = params[:class] || 'TString'
    klass = pclass.constantize
    pbody = params[:body] || 'admin'
    @body = klass.new(pbody)
    @varaibles = {:class => pclass, :body => pbody, :render => params['render']}
    render params[:render] || 'index'
  end

  def reset_password
    unless params[:token].nil?
      @user = User.find_by_token(params[:token])
      # @user.reset_password!
      render :json => 'Success'
      return
    end
    render :json => 'Failed'
  end
end

class TString < String
  def initialize(name)
    @name = name
  end
  def hello
    append = "Hello "
    "#{append}#{@name}"
  end
end

class F14gggggggggggggggg
  def initialize(flag)
    @flag = ENV['FLAG'] || ''
  end
  def hello
    append = "Flag: "
    "#{append}#{@flag}"
  end
end
