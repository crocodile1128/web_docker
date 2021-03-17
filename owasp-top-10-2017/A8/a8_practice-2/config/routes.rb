Demo::Application.routes.draw do
  resources :users do
    collection do
      get :index
    end
  end
end
