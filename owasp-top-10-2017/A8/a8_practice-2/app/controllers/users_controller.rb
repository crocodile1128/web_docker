class UsersController < ApplicationController
  def index
    @yaml = ''
    @yaml = params[:yaml] if !params[:yaml].nil?
    @yaml = YAML.load(@yaml)
    @varaibles = {:yaml => @yaml}
  end
end
